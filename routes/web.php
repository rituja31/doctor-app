<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboards.admin'))->name('admin.dashboard');
    Route::get('/doctor/dashboard', fn() => view('dashboards.doctor'))->name('doctor.dashboard');
    Route::get('/patient/dashboard', fn() => view('dashboards.patient'))->name('patient.dashboard');
});
