<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Auth;


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


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/dashboard', function () {
    if (!session('admin_logged_in')) {
        return redirect()->route('login')->withErrors(['email' => 'Unauthorized']);
    }
    return view('dashboards.admin');
})->name('admin.dashboard');


Route::middleware('auth')->group(function () {

    
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/patient/dashboard', fn() => view('dashboards.patient'))->name('patient.dashboard');

    
    Route::get('/doctor/calendar', fn() => view('calendar'))->name('doctor.calendar');

    
    Route::get('/appointment', fn() => view('appointment'))->name('appointment.page');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

    Route::get('/appointment/time', fn() => view('time'))->name('appointment.time');
    Route::post('/appointment/time', [AppointmentController::class, 'storeTime'])->name('appointment.store-time');

    Route::get('/appointment/details', fn() => view('details'))->name('appointment.details');

    Route::get('/appointment/billing', fn() => view('billing'))->name('appointment.billing');
    Route::post('/appointment/billing', fn() => redirect()->route('appointment.billing'))->name('appointment.billing.post');

    Route::post('/appointment/complete', fn() => redirect()->route('appointment.complete.show'))->name('appointment.complete');

    Route::get('/appointment/finalize', fn() => view('finalize'))->name('appointment.finalize');
    Route::post('/appointment/finalize', fn() => redirect()->route('appointment.complete.show'))->name('appointment.finalize.post');

    Route::get('/appointment/complete', fn() => view('complete'))->name('appointment.complete.show');

    Route::get('/appointments/calendar', function () {
    return view('appointmentcalender'); 
    })->name('appointments.calendar');

    Route::get('/patient/medical-history', function () {
    return view('medicalhistory');
    })->name('medical.history');

    Route::get('/patient/settings', function () {
    return view('settings');
    })->name('patient.settings');



});
