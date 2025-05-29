<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctors = Doctor::all(); // Fetch all doctors
        return view('dashboards.admin', compact('doctors')); // points to dashboards/admin.blade.php
    }
}
