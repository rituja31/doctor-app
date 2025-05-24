<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// 👇 Public homepage
Route::get('/', fn() => view('Auth.home'))->name('home');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboards.admin'))->name('admin.dashboard');
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/patient/dashboard', fn() => view('dashboards.patient'))->name('patient.dashboard');

    // Calendar page route for doctor
    Route::get('/doctor/calendar', fn() => view('calendar'))->name('doctor.calendar');
});
