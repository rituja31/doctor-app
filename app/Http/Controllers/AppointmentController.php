<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    // Page 1: Show the appointment form
    public function showAppointmentPage()
    {
        $categories = DB::table('categories')->get();
        $services = DB::table('services')->get();
        $employees = DB::table('employees')->get();
        $today = now()->format('Y-m-d'); // Current date for the date input

        return view('appointment', compact('categories', 'services', 'employees', 'today')); // Updated
    }

    // Page 1: Store appointment data
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|exists:categories,id',
            'service' => 'required|integer|exists:services,id',
            'employee' => 'required|integer|exists:employees,id',
            'appointment_type' => 'required|in:online,offline',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // Fetch service fees
        $service = DB::table('services')->where('id', $request->service)->first();

        // Store in session
        session([
            'appointment.category_id' => $request->category,
            'appointment.service_id' => $request->service,
            'appointment.employee_id' => $request->employee,
            'appointment.appointment_type' => $request->appointment_type,
            'appointment.appointment_date' => $request->date,
            'appointment.service_fees' => $service->fees,
        ]);

        return redirect()->route('appointment.time');
    }

    // Page 2: Show the time selection form
    public function showTimePage()
    {
        // Fetch session data for display
        $appointment = session('appointment');
        $service = DB::table('services')->where('id', $appointment['service_id'])->first();
        $employee = DB::table('employees')->where('id', $appointment['employee_id'])->first();

        // Generate time slots dynamically (for simplicity, using a fixed list; you can make this more dynamic)
        $timeSlots = [
            '08:00 AM - 08:35 AM', '09:05 AM - 09:40 AM', '10:10 AM - 10:45 AM',
            '11:15 AM - 11:50 AM', '12:30 PM - 01:05 PM', '01:35 PM - 02:10 PM',
            '02:40 PM - 03:15 PM', '03:45 PM - 04:20 PM', '04:50 PM - 05:25 PM',
        ];

        return view('time', compact('service', 'employee', 'timeSlots', 'appointment')); // Updated
    }

    // Page 2: Store time selection data
    public function storeTime(Request $request)
    {
        $request->validate([
            'appointment_time' => 'required|string',
        ]);

        // Add to session
        session(['appointment.appointment_time' => $request->appointment_time]);

        return redirect()->route('appointment.details');
    }

    // Page 3: Show the details form
    public function showDetailsPage()
    {
        $appointment = session('appointment');
        $service = DB::table('services')->where('id', $appointment['service_id'])->first();
        $employee = DB::table('employees')->where('id', $appointment['employee_id'])->first();

        return view('details', compact('appointment', 'service', 'employee')); // Updated
    }

    // Page 3: Store details data
    public function storeDetails(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        // Add to session
        session([
            'appointment.first_name' => $request->first_name,
            'appointment.last_name' => $request->last_name,
            'appointment.phone' => $request->phone,
            'appointment.email' => $request->email,
            'appointment.details' => $request->details,
        ]);

        return redirect()->route('appointment.billing');
    }

    // Page 4: Show the billing form
    public function showBillingPage()
    {
        return view('billing'); // Updated
    }

    // Page 4: Store billing data
    public function storeBilling(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Add to session
        session(['appointment.payment_method' => $request->payment_method]);

        return redirect()->route('appointment.complete.show');
    }

    // Page 5: Show the complete page
    public function showCompletePage()
    {
        $appointment = session('appointment');
        $category = DB::table('categories')->where('id', $appointment['category_id'])->first();
        $service = DB::table('services')->where('id', $appointment['service_id'])->first();
        $employee = DB::table('employees')->where('id', $appointment['employee_id'])->first();

        return view('complete', compact('appointment', 'category', 'service', 'employee')); // Updated
    }

    // Page 5: Finalize the appointment (save to database)
    public function finalize(Request $request)
    {
        $appointmentData = session('appointment');

        // Insert into appointments table
        DB::table('appointments')->insert([
            'category_id' => $appointmentData['category_id'],
            'service_id' => $appointmentData['service_id'],
            'employee_id' => $appointmentData['employee_id'],
            'appointment_type' => $appointmentData['appointment_type'],
            'appointment_date' => $appointmentData['appointment_date'],
            'appointment_time' => $appointmentData['appointment_time'],
            'first_name' => $appointmentData['first_name'],
            'last_name' => $appointmentData['last_name'],
            'phone' => $appointmentData['phone'],
            'email' => $appointmentData['email'],
            'details' => $appointmentData['details'] ?? null,
            'payment_method' => $appointmentData['payment_method'],
            'service_fees' => $appointmentData['service_fees'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Store in session for the final page (since we clear 'appointment' session)
        $finalData = [
            'category_name' => DB::table('categories')->where('id', $appointmentData['category_id'])->value('name'),
            'service_name' => DB::table('services')->where('id', $appointmentData['service_id'])->value('name'),
            'service_fees' => $appointmentData['service_fees'],
            'employee_name' => DB::table('employees')->where('id', $appointmentData['employee_id'])->value('name'),
            'appointment_date' => $appointmentData['appointment_date'],
            'appointment_time' => $appointmentData['appointment_time'],
            'email' => $appointmentData['email'],
        ];
        session(['final_appointment' => $finalData]);

        // Clear appointment session data
        $request->session()->forget('appointment');

        return redirect()->route('appointment.finalize.show');
    }

    // Page 6: Show the finalize page
    public function showFinalizePage()
    {
        $finalData = session('final_appointment');
        return view('finalize', compact('finalData')); // Updated
    }
}