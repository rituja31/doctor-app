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
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function showAppointmentPage()
    {
        $categories = Category::all();
        $services = Service::with('category')->get();
        $doctors = Doctor::where('status', 'Active')->get();
        $today = now()->format('Y-m-d');
        $patientEmail = Auth::user()->email; // Get the logged-in user's email
        $patientName = Auth::user()->name; // Get the logged-in user's name
        return view('appointment', compact('categories', 'services', 'doctors', 'today', 'patientEmail', 'patientName'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'doctor' => 'required|exists:doctors,id',
                'appointment_type' => 'required|in:online,offline',
                'date' => 'required|date|after_or_equal:today',
                'appointment_time' => 'required|string',
                'payment_method' => 'required|in:razorpay',
                'category_ids' => 'required|string',
                'service_ids' => 'required|string',
                'specialties' => 'required|string',
            ]);

            $doctor = Doctor::findOrFail($validated['doctor']);
            $categoryId = explode(',', $validated['category_ids'])[0];
            $serviceId = explode(',', $validated['service_ids'])[0];
            $category = Category::findOrFail($categoryId);
            $service = Service::findOrFail($serviceId);

            $user = Auth::user();

            $appointmentTime = $validated['appointment_time'];
            if (strlen($appointmentTime) === 5) { // HH:MM format
                $appointmentTime .= ':00'; // Convert to HH:MM:SS
            }

            $appointment = Appointment::create([
                'category_id' => $categoryId,
                'service_id' => $serviceId,
                'doctor_id' => $validated['doctor'],
                'appointment_type' => $validated['appointment_type'],
                'appointment_date' => $validated['date'],
                'appointment_time' => $appointmentTime,
                'first_name' => $user->name ?? 'N/A', // Use the single name field
                'last_name' => 'N/A', // Since there's no last_name, set to N/A
                'phone' => $user->phone ?? 'N/A',
                'email' => $user->email,
                'details' => null,
                'payment_method' => $validated['payment_method'],
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
                'name' => $appointment->first_name, // Use the single name field
            ];

            Mail::to($appointment->email)->send(new BookingConfirmed($finalData));

            return response()->json(['success' => true, 'message' => 'Appointment booked successfully']);
        } catch (\Exception $e) {
            Log::error('Error booking appointment: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to book appointment: ' . $e->getMessage()], 500);
        }
    }

    private function generateTimeSlots()
    {
        return ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];
    }
}