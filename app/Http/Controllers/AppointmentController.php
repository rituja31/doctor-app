<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmed;

class AppointmentController extends Controller
{
    public function showAppointmentPage()
    {
        $categories = Category::all();
        $services = Service::with('category')->get();
        $doctors = Doctor::where('status', 'Active')->get();
        $today = now()->format('Y-m-d');
        return view('appointment', compact('categories', 'services', 'doctors', 'today'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|exists:categories,id',
            'service' => 'required|exists:services,id',
            'doctor' => 'required|exists:doctors,id',
            'appointment_type' => 'required|in:online,offline',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $request->session()->put('appointment', $validated);
        return redirect()->route('appointment.time');
    }

    public function showTimeForm(Request $request)
    {
        $appointment = $request->session()->get('appointment');
        if (!$appointment) {
            Log::error('Appointment session data missing in showTimeForm');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        $service = Service::findOrFail($appointment['service']);
        $doctor = Doctor::findOrFail($appointment['doctor']);
        $timeSlots = $this->generateTimeSlots();
        return view('time', compact('service', 'doctor', 'timeSlots'));
    }

    public function storeTime(Request $request)
    {
        $validated = $request->validate([
            'appointment_time' => 'required',
        ]);

        $appointment = $request->session()->get('appointment');
        if (!$appointment) {
            Log::error('Appointment session data missing in storeTime');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        $appointment['appointment_time'] = $validated['appointment_time'];
        $request->session()->put('appointment', $appointment);
        return redirect()->route('appointment.details');
    }

    public function showDetailsForm(Request $request)
    {
        $appointment = $request->session()->get('appointment');
        if (!$appointment) {
            Log::error('Appointment session data missing in showDetailsForm');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        if (!isset($appointment['appointment_time'])) {
            Log::warning('Appointment time missing in showDetailsForm', $appointment);
            return redirect()->route('appointment.time')->with('error', 'Please select a time slot.');
        }

        $service = Service::findOrFail($appointment['service']);
        return view('detail', compact('appointment', 'service'));
    }

    public function storeDetails(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'details' => 'nullable|string',
        ]);

        $appointment = $request->session()->get('appointment');
        if (!$appointment) {
            Log::error('Appointment session data missing in storeDetails');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        $appointment = array_merge($appointment, $validated);
        $request->session()->put('appointment', $appointment);
        return redirect()->route('appointment.billing');
    }

    public function showBillingForm(Request $request)
    {
        $appointment = $request->session()->get('appointment');
        if (!$appointment) {
            Log::error('Appointment session data missing in showBillingForm');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        return view('billing');
    }

    public function storeBilling(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:stripe,razorpay,razorpay2,pay_later',
        ]);

        $appointmentData = $request->session()->get('appointment');
        if (!$appointmentData) {
            Log::error('Appointment session data missing in storeBilling');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        $service = Service::findOrFail($appointmentData['service']);
        $doctor = Doctor::findOrFail($appointmentData['doctor']);
        $category = Category::findOrFail($appointmentData['category']);

        $appointmentData['payment_method'] = $validated['payment_method'];
        $request->session()->put('appointment', $appointmentData);

        $finalData = [
            'category_name' => $category->name,
            'service_name' => $service->name,
            'service_fees' => $service->fees,
            'doctor_name' => $doctor->first_name . ' ' . $doctor->last_name,
            'appointment_date' => $appointmentData['date'],
            'appointment_time' => $appointmentData['appointment_time'],
            'email' => $appointmentData['email'],
        ];

        return view('complete', compact('finalData'));
    }

    public function complete(Request $request)
    {
        $appointmentData = $request->session()->get('appointment');
        if (!$appointmentData) {
            Log::error('Appointment session data missing in complete');
            return redirect()->route('appointment.page')->with('error', 'Session expired. Please start over.');
        }

        $service = Service::findOrFail($appointmentData['service']);
        $doctor = Doctor::findOrFail($appointmentData['doctor']);
        $category = Category::findOrFail($appointmentData['category']);

        $appointment = Appointment::create([
            'category_id' => $appointmentData['category'],
            'service_id' => $appointmentData['service'],
            'doctor_id' => $appointmentData['doctor'],
            'appointment_type' => $appointmentData['appointment_type'],
            'appointment_date' => $appointmentData['date'],
            'appointment_time' => $appointmentData['appointment_time'],
            'first_name' => $appointmentData['first_name'],
            'last_name' => $appointmentData['last_name'],
            'phone' => $appointmentData['phone'],
            'email' => $appointmentData['email'],
            'details' => $appointmentData['details'] ?? null,
            'payment_method' => $appointmentData['payment_method'],
            'service_fees' => $service->fees,
        ]);

        $finalData = [
            'category_name' => $category->name,
            'service_name' => $service->name,
            'service_fees' => $appointment->service_fees,
            'doctor_name' => $doctor->first_name . ' ' . $doctor->last_name,
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' => $appointment->appointment_time,
            'email' => $appointment->email,
            'name' => $appointment->first_name . ' ' . $appointment->last_name,
        ];

        // ✅ Send confirmation email
        Mail::to($appointment->email)->send(new BookingConfirmed($finalData));

        $request->session()->forget('appointment');
        return view('finalize', compact('finalData'));
    }

    private function generateTimeSlots()
    {
        return ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];
    }
}
