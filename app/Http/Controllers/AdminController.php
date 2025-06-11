<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!Auth::check() && !$request->session()->has('admin_logged_in')) {
            return redirect()->route('login')->with('error', 'Please log in as an admin.');
        }

        if (!$request->session()->has('admin_logged_in')) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_email', 'admin@gmail.com');
        }

        try {
            $doctors = Doctor::paginate(10); // Changed from Doctor::all() to paginate(10)
            $categories = Category::all();
            $services = Service::with('category')->get(); // Added with('category') for consistency
            Log::info('Doctors fetched for admin dashboard:', ['count' => $doctors->total()]);

            return view('dashboards.admin', compact('doctors', 'categories', 'services'));
        } catch (\Exception $e) {
            Log::error('Error fetching admin dashboard data: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to load dashboard: ' . $e->getMessage()]);
        }
    }
}