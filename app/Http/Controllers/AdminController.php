<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Category; // Add Category model
use App\Models\Service;  // Add Service model (if applicable)

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctors = Doctor::all();    // Fetch all doctors
        $categories = Category::all(); // Fetch all categories
        $services = Service::all();    // Fetch all services (if needed)

        return view('dashboards.admin', compact('doctors', 'categories', 'services'));
    }
}