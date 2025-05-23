<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;


Route::get('/', function () {
    if (session('is_admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (Auth::check()) {
        $role = Auth::user()->role;
        return match ($role) {
            'doctor' => redirect()->route('doctor.dashboard'),
            'patient' => redirect()->route('patient.dashboard'),
            default => redirect()->route('login'),
        };
    }

    return view('auth.home');
})->name('home');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/dashboard', function () {
    if (!session('is_admin')) {
        return redirect()->route('login');
    }
    return view('dashboards.admin');
})->name('admin.dashboard');


Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [AuthController::class, 'doctorDashboard'])->name('doctor.dashboard');
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('patient.appointments.create');
});
