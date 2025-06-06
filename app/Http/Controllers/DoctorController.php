<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Category;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DoctorController extends Controller
{
    // Show doctor login form
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // Handle doctor login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('doctor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('doctor.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

    // Doctor logout
    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('doctor.login');
    }

    // Doctor dashboard
    public function dashboard()
    {
        $doctor = Auth::guard('doctor')->user();
        
        // Fetch appointments for the logged-in doctor
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->select('id', 'appointment_type', 'appointment_date', 'appointment_time', 'first_name', 'last_name', 'details')
            ->get()
            ->map(function ($appointment) {
                $startDateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
                $endDateTime = $startDateTime->copy()->addMinutes(30);
                
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->first_name . ' ' . $appointment->last_name . ' - Appointment',
                    'start' => $startDateTime->toIso8601String(),
                    'end' => $endDateTime->toIso8601String(),
                    'className' => $appointment->appointment_type === 'online' ? 'fc-event-online' : 'fc-event-offline',
                    'extendedProps' => [
                        'type' => $appointment->appointment_type,
                        'patientName' => $appointment->first_name . ' ' . $appointment->last_name,
                        'notes' => $appointment->details ?? 'No notes provided.',
                    ],
                ];
            });

        // Graph data for online/offline appointments
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $appointmentCounts = Appointment::where('doctor_id', $doctor->id)
            ->whereBetween('appointment_date', [$startOfWeek, $endOfWeek])
            ->groupBy('appointment_type', 'appointment_date')
            ->selectRaw('appointment_type, appointment_date, COUNT(*) as count')
            ->get();

        $days = [];
        $onlineData = [];
        $offlineData = [];
        
        for ($date = $startOfWeek->copy(); $date->lte($endOfWeek); $date->addDay()) {
            $days[] = $date->format('D');
            $onlineData[] = 0;
            $offlineData[] = 0;
            
            foreach ($appointmentCounts as $count) {
                if ($count->appointment_date == $date->format('Y-m-d')) {
                    if ($count->appointment_type === 'online') {
                        $onlineData[array_key_last($onlineData)] = $count->count;
                    } elseif ($count->appointment_type === 'offline') {
                        $offlineData[array_key_last($offlineData)] = $count->count;
                    }
                }
            }
        }

        return view('dashboards.doctor', compact('doctor', 'appointments', 'days', 'onlineData', 'offlineData'));
    }

    // Calendar view
    public function calendar()
    {
        $doctor = Auth::guard('doctor')->user();
        
        // Fetch appointments for the logged-in doctor
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->select('id', 'appointment_type', 'appointment_date', 'appointment_time', 'first_name', 'last_name', 'details')
            ->get()
            ->map(function ($appointment) {
                $startDateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
                $endDateTime = $startDateTime->copy()->addMinutes(30);
                
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->first_name . ' ' . $appointment->last_name . ' - Appointment',
                    'start' => $startDateTime->toIso8601String(),
                    'end' => $endDateTime->toIso8601String(),
                    'className' => $appointment->appointment_type === 'online' ? 'fc-event-online' : 'fc-event-offline',
                    'extendedProps' => [
                        'type' => $appointment->appointment_type,
                        'patientName' => $appointment->first_name . ' ' . $appointment->last_name,
                        'notes' => $appointment->details ?? 'No notes provided.',
                    ],
                ];
            });

        return view('calendar', compact('doctor', 'appointments'));
    }

    // Analytics view
    public function analytics()
    {
        $doctor = Auth::guard('doctor')->user();
        $startDate = Carbon::now()->subDays(365); // Last year for trend
        $startOfWeek = Carbon::now()->startOfWeek(); // For peak hours

        // Trend data (monthly counts for online/offline)
        $monthlyAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', '>=', $startDate)
            ->groupBy('appointment_type', \DB::raw('DATE_FORMAT(appointment_date, "%Y-%m")'))
            ->selectRaw('appointment_type, DATE_FORMAT(appointment_date, "%Y-%m") as month, COUNT(*) as count')
            ->get();

        $months = [];
        $onlineTrend = [];
        $offlineTrend = [];
        $currentMonth = $startDate->copy();
        while ($currentMonth->lte(Carbon::now())) {
            $monthKey = $currentMonth->format('Y-m');
            $months[] = $currentMonth->format('M Y');
            $onlineTrend[$monthKey] = 0;
            $offlineTrend[$monthKey] = 0;
            $currentMonth->addMonth();
        }

        foreach ($monthlyAppointments as $appt) {
            if ($appt->appointment_type === 'online') {
                $onlineTrend[$appt->month] = $appt->count;
            } elseif ($appt->appointment_type === 'offline') {
                $offlineTrend[$appt->month] = $appt->count;
            }
        }

        $trendData = [
            'labels' => $months,
            'online' => array_values($onlineTrend),
            'offline' => array_values($offlineTrend),
        ];

        // Appointment types (online vs offline percentages)
        $typeCounts = Appointment::where('doctor_id', $doctor->id)
            ->groupBy('appointment_type')
            ->selectRaw('appointment_type, COUNT(*) as count')
            ->pluck('count', 'appointment_type');

        $totalTypes = ($typeCounts->get('online', 0) + $typeCounts->get('offline', 0)) ?: 1;
        $typeData = [
            'online' => round(($typeCounts->get('online', 0) / $totalTypes) * 100, 1),
            'offline' => round(($typeCounts->get('offline', 0) / $totalTypes) * 100, 1),
        ];

        // Weekly peak hours (this week)
        $peakHours = Appointment::where('doctor_id', $doctor->id)
            ->whereBetween('appointment_date', [$startOfWeek, Carbon::now()->endOfWeek()])
            ->selectRaw('HOUR(appointment_time) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->pluck('count', 'hour');

        $hours = [];
        $peakData = [];
        for ($i = 8; $i <= 17; $i++) { // 8 AM to 5 PM
            $hourLabel = $i < 12 ? "$i AM" : ($i == 12 ? "12 PM" : ($i - 12) . " PM");
            $hours[] = $hourLabel;
            $peakData[] = $peakHours->get($i, 0);
        }

        // Recent appointments (last 6)
        $recentAppointments = Appointment::where('doctor_id', $doctor->id)
            ->select('id', 'first_name', 'last_name', 'appointment_type', 'appointment_date', 'appointment_time', 'details')
            ->latest('appointment_date')
            ->take(6)
            ->get()
            ->map(function ($appointment) {
                $dateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
                return [
                    'id' => $appointment->id,
                    'patient_name' => $appointment->first_name . ' ' . $appointment->last_name,
                    'type' => $appointment->appointment_type,
                    'date_time' => $dateTime,
                    'time_formatted' => $dateTime->format('h:i A'),
                    'day' => $dateTime->isToday() ? 'Today' : ($dateTime->isYesterday() ? 'Yesterday' : $dateTime->format('M d')),
                    'details' => $appointment->details ?? 'No details provided',
                ];
            });

        Log::info('Analytics accessed', ['doctor_id' => $doctor->id, 'appointments_count' => $recentAppointments->count()]);

        return view('analytics', compact(
            'doctor',
            'trendData',
            'typeData',
            'peakHours',
            'hours',
            'peakData',
            'recentAppointments'
        ));
    }

    // List all doctors (Admin view)
    public function index()
    {
        $doctors = Doctor::all();
        $categories = Category::all();
        $services = Service::with('category')->get();
        return view('doctors.index', compact('doctors', 'categories', 'services'));
    }

    // Store new doctor
    public function store(Request $request)
    {
        Log::info('Doctor store request:', $request->all());
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:doctors,email',
                'phone' => 'required|string|max:20',
                'category_id' => 'required|integer|exists:categories,id',
                'service_id' => 'required|integer|exists:services,id',
                'status' => 'required|in:Active,On Leave,Retired',
                'password' => 'required|string|min:4',
                'working_days' => 'required|array|min:1',
                'working_days.*' => 'string|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,All Days',
            ]);

            $workingDays = in_array('All Days', $request->working_days)
                ? 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'
                : implode(',', array_diff($request->working_days, ['All Days']));

            $category = Category::findOrFail($request->category_id);
            $service = Service::findOrFail($request->service_id);
            $specialties = $category->name . ',' . $service->name;

            $doctor = Doctor::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'category_id' => (int) $request->category_id,
                'service_id' => (int) $request->service_id,
                'specialties' => $specialties,
                'status' => $request->status,
                'password' => bcrypt($request->password),
                'working_days' => $workingDays,
            ]);

            Log::info('Doctor created:', $doctor->toArray());
            return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error saving doctor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create doctor: ' . $e->getMessage()])->withInput();
        }
    }

    // Show form to edit doctor
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $categories = Category::all();
        $services = Service::with('category')->get();
        return view('edit', compact('doctor', 'categories', 'services'));
    }

    // Update doctor info
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        Log::info('Doctor update request:', $request->all());
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:doctors,email,' . $doctor->id,
                'phone' => 'required|string|max:20',
                'category_id' => 'required|integer|exists:categories,id',
                'service_id' => 'required|integer|exists:services,id',
                'status' => 'required|in:Active,On Leave,Retired',
                'password' => 'nullable|string|min:4',
                'password_confirmation' => 'nullable|same:password',
                'working_days' => 'required|array|min:1',
                'working_days.*' => 'string|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,All Days',
                'specialties' => 'nullable|string|max:255',
            ]);

            $workingDays = in_array('All Days', $request->working_days)
                ? 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'
                : implode(',', array_diff($request->working_days, ['All Days']));

            $specialties = $request->filled('specialties')
                ? $request->specialties
                : Category::findOrFail($request->category_id)->name . ',' . Service::findOrFail($request->service_id)->name;

            $updateData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'category_id' => (int) $request->category_id,
                'service_id' => (int) $request->service_id,
                'specialties' => $specialties,
                'status' => $request->status,
                'working_days' => $workingDays,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $doctor->update($updateData);
            Log::info('Doctor updated:', $doctor->toArray());

            if (Session::get('admin_logged_in')) {
                return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
            }
            return redirect()->route('doctor.docprofile')->with('success', 'Profile updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating doctor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update doctor: ' . $e->getMessage()])->withInput();
        }
    }

    // Show single doctor details
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('view', compact('doctor'));
    }

    // Delete doctor
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->back()->with('success', 'Doctor deleted successfully.');
    }

    // Show doctor profile
    public function showProfile()
    {
        $doctor = Auth::guard('doctor')->user();
        return view('docprofile', compact('doctor'));
    }
}
