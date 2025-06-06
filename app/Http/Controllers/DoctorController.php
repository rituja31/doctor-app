<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    // Show doctor login form
    public function showLoginForm()
    {
        return view('Auth.login'); // Render Auth/login.blade.php
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

    // Doctor dashboard - protected page
    public function dashboard()
    {
        $doctor = Auth::guard('doctor')->user();
        return view('dashboards.doctor');
    }

    // List all doctors (Admin view)
    public function index()
    {
        $doctors = Doctor::all();
        $categories = Category::all();
        $services = Service::with('category')->get();
        return view('dashboards.admin', compact('doctors', 'categories', 'services'));
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
            return redirect()->route('doctors.index')->with('success', 'Doctor added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error saving doctor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to save: ' . $e->getMessage()])->withInput();
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
                'specialties' => 'nullable|string|max:255', // Make specialties optional
            ]);

            $workingDays = is_array($request->working_days)
                ? (in_array('All Days', $request->working_days)
                    ? 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'
                    : implode(',', array_diff($request->working_days, ['All Days'])))
                : explode(',', $request->working_days); // Handle string input

            // Derive specialties from category and service if not provided
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
                'working_days' => is_array($workingDays) ? implode(',', $workingDays) : $workingDays,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $doctor->update($updateData);
            Log::info('Doctor updated:', $doctor->toArray());

            // Redirect based on user type
            if (Session::get('admin_logged_in')) {
                return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
            }
            return redirect()->route('doctor.docprofile')->with('success', 'Profile updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating doctor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update: ' . $e->getMessage()])->withInput();
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
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }

    // Show doctor profile
    public function showProfile()
    {
        $doctor = Auth::guard('doctor')->user();
        return view('docprofile', compact('doctor'));
    }
}