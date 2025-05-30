<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;

// Home Redirection Based on Role
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'patient' => redirect()->route('patient.dashboard'),
            default => redirect()->route('login'),
        };
    } elseif (session('admin_logged_in')) {
        return redirect()->route('admin.dashboard');
    }

    return view('Auth.home');
})->name('home');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard (session-based)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Doctor Routes
Route::get('/admin', [DoctorController::class, 'index'])->name('doctors.index');
Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('edit.page');
Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/patient/dashboard', fn() => view('dashboards.patient'))->name('patient.dashboard');

    Route::prefix('doctor')->group(function () {
        Route::get('/calendar', fn() => view('calendar'))->name('doctor.calendar');
        Route::get('/analytics', fn() => view('analytics'))->name('doctor.analytics');
        Route::get('/docprofile', fn() => view('docprofile'))->name('doctor.docprofile');
    });

    Route::get('/appointment', fn() => view('appointment'))->name('appointment.page');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/time', fn() => view('time'))->name('appointment.time');
    Route::post('/appointment/time', [AppointmentController::class, 'storeTime'])->name('appointment.store-time');
    Route::get('/appointment/details', fn() => view('details'))->name('appointment.details');
    Route::get('/appointment/billing', fn() => view('billing'))->name('appointment.billing');
    Route::post('/appointment/billing', fn() => redirect()->route('appointment.billing'))->name('appointment.billing.post');
    Route::get('/appointment/finalize', fn() => view('finalize'))->name('appointment.finalize');
    Route::post('/appointment/finalize', fn() => redirect()->route('appointment.complete.show'))->name('appointment.finalize.post');
    Route::post('/appointment/complete', fn() => redirect()->route('appointment.complete.show'))->name('appointment.complete');
    Route::get('/appointment/complete', fn() => view('complete'))->name('appointment.complete.show');
    Route::get('/appointments/calendar', fn() => view('appointmentcalender'))->name('appointments.calendar');
    Route::get('/patient/medical-history', fn() => view('medicalhistory'))->name('medical.history');
    Route::get('/patient/settings', fn() => view('settings'))->name('patient.settings');
});