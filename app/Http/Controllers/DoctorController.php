<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        $categories = Category::all();
        $services = Service::with('category')->get();
        return view('dashboards.admin', compact('doctors', 'categories', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'category_id' => 'required|exists:categories,id',
            'service_id' => 'required|exists:services,id',
            'status' => 'required|in:Active,On Leave,Retired',
        ]);

        // Fetch category and service names for specialties
        $category = Category::findOrFail($request->category_id);
        $service = Service::findOrFail($request->service_id);
        $specialties = $category->name . ',' . $service->name;

        Doctor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category_id' => $request->category_id,
            'service_id' => $request->service_id,
            'specialties' => $specialties,
            'status' => $request->status,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $categories = Category::all();
        $services = Service::with('category')->get();
        return view('edit', compact('doctor', 'categories', 'services'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
            'category_id' => 'required|exists:categories,id',
            'service_id' => 'required|exists:services,id',
            'status' => 'required|in:Active,On Leave,Retired',
        ]);

        // Fetch category and service names for specialties
        $category = Category::findOrFail($request->category_id);
        $service = Service::findOrFail($request->service_id);
        $specialties = $category->name . ',' . $service->name;

        $doctor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'category_id' => $request->category_id,
            'service_id' => $request->service_id,
            'specialties' => $specialties,
            'status' => $request->status,
        ]);

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