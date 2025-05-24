<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppointmentController;

// Home route with role-based redirect
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'patient' => redirect()->route('patient.dashboard'),
            default => redirect()->route('login'),
        };
    }
    return view('Auth.home'); 
})->name('home');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (requires login)
Route::middleware('auth')->group(function () {

    // Dashboards
    Route::get('/admin/dashboard', fn() => view('dashboards.admin'))->name('admin.dashboard');
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/patient/dashboard', fn() => view('dashboards.patient'))->name('patient.dashboard');

    // Doctor calendar
    Route::get('/doctor/calendar', fn() => view('calendar'))->name('doctor.calendar');

    // Appointment process routes
    Route::get('/appointment', fn() => view('appointment'))->name('appointment.page');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

    Route::get('/appointment/time', fn() => view('time'))->name('appointment.time');
    Route::post('/appointment/time', [AppointmentController::class, 'storeTime'])->name('appointment.store-time');

    Route::get('/appointment/details', fn() => view('details'))->name('appointment.details');

    // Billing page
    Route::get('/appointment/billing', fn() => view('billing'))->name('appointment.billing');
    Route::post('/appointment/billing', function () {
        return redirect()->route('appointment.billing');
    })->name('appointment.billing.post');

    // Complete appointment routes
    // POST route to process appointment completion form submission
    Route::post('/appointment/complete', function () {
        // Process appointment logic here if needed

        // Redirect to confirmation page after completion
        return redirect()->route('appointment.complete.show');
    })->name('appointment.complete');

    // Show the finalize appointment page (GET)
    Route::get('/appointment/finalize', function () {
        return view('finalize'); // loads finalize.blade.php
    })->name('appointment.finalize');

    // Process finalize appointment form (POST)
    Route::post('/appointment/finalize', function () {
        // TODO: Add your appointment finalization logic here
        // For example, save the final appointment, send confirmation emails, etc.

        // Redirect to the completion confirmation page
        return redirect()->route('appointment.complete.show');
    })->name('appointment.finalize.post');

    // GET route to show confirmation page after completion
    Route::get('/appointment/complete', fn() => view('complete'))->name('appointment.complete.show');
});
