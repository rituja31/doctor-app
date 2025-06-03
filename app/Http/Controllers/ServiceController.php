<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->get();
        $categories = Category::all();
        return view('services', compact('services', 'categories'));
    }

    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info('Service store request data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'fees' => 'required|numeric|min:0',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'fees' => $request->fees,
        ]);

        // Log the created service
        Log::info('Service created:', $service->toArray());

        return redirect()->route('services')->with('success', 'Service added successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services')->with('success', 'Service deleted successfully.');
    }

    public function show($id)
{
    $service = Service::with('category')->findOrFail($id);
    return view('services_show', compact('service'));
}
}


