<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

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

        $doctors = Doctor::all();
        $categories = Category::all();
        $services = Service::all();

        return view('dashboards.admin', compact('doctors', 'categories', 'services'));
    }
}
