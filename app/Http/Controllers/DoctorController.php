<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('dashboards.admin', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'specialties' => 'required|string',
            'status' => 'required|in:Active,On Leave,Retired',
        ]);

        Doctor::create($validated);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'specialties' => 'required|string',
            'status' => 'required|in:Active,On Leave,Retired',
        ]);

        $doctor->update($validated);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('view', compact('doctor'));
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}