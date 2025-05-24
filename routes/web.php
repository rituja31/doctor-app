<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppointmentController;

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

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboards.admin'))->name('admin.dashboard');
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/patient/dashboard', fn() => view('dashboards.patient'))->name('patient.dashboard');

    Route::get('/doctor/calendar', fn() => view('calendar'))->name('doctor.calendar');

});
Route::get('/appointment', function () {
    return view('appointment');
})->name('appointment.page');

// Time slot selection page
Route::get('/appointment/time', function () {
    return view('time');
})->name('appointment.time');

// Form submission handlers
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
Route::post('/appointment/time', [AppointmentController::class, 'storeTime'])->name('appointment.store-time');

Route::get('/appointment/details', function () {
    return view('details');
})->name('appointment.details');

Route::post('/appointment/billing', function () {
    return redirect()->route('appointment.billing');
})->name('appointment.billing');

Route::get('/appointment/details', function () {
    return view('details');
})->name('appointment.details');

Route::get('/appointment/billing', function () {
    return view('billing');
})->name('appointment.billing');

Route::post('/appointment/complete', function () {
    return redirect()->route('appointment.done');
})->name('appointment.complete');

// In web.php
Route::post('/appointment/complete', function () {
    // Process the appointment
    return redirect()->route('appointment.complete ');
})->name('appointment.complete');

Route::get('/doctor/calendar', fn() => view('calendar'))->name('doctor.calendar');