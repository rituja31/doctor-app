<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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


Route::middleware('auth')->group(function () {
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/home', fn() => view('auth.home'))->name('patient.dashboard');
});
