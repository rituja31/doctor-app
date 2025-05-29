<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:doctors,email',
            'phone'       => 'required|string|max:20',
            'specialties' => 'required|string',
            'status'      => 'required|in:Active,On Leave,Retired',
        ]);

        // Save the new doctor to database
        // Assuming you have a Doctor model
        \App\Models\Doctor::create([
            'first_name'  => $validated['first_name'],
            'last_name'   => $validated['last_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'specialties' => $validated['specialties'],
            'status'      => $validated['status'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Doctor added successfully!');
    }
}
