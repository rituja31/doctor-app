<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ContactController;
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
    return view('auth.home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Admin routes group
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('edit.page');
    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
});

// Category & Service routes
Route::resource('categories', CategoryController::class);
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


// Doctor authentication routes (login/logout/dashboard)
Route::prefix('doctor')->group(function () {
    Route::get('/login', [DoctorController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('/login', [DoctorController::class, 'login'])->name('doctor.login.post');
    Route::post('/logout', [DoctorController::class, 'logout'])->name('doctor.logout');

    Route::middleware('auth:doctor')->group(function () {
        Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
       Route::get('/calendar', [DoctorController::class, 'calendar'])->name('doctor.calendar');
       Route::get('/analytics', [DoctorController::class, 'analytics'])->name('doctor.analytics');
        Route::get('/docprofile', fn() => view('docprofile'))->name('doctor.docprofile');
        Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update')->middleware('auth:doctor');
        Route::get('/doctor/profile', [DoctorController::class, 'showProfile'])->name('doctor.docprofile')->middleware('auth:doctor');
        Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update')->middleware('auth:doctor');
    });
});

// Routes requiring general auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/patient', [PatientController::class, 'dashboard'])->name('patient.dashboard');

    Route::get('/appointment', [AppointmentController::class, 'showAppointmentPage'])->name('appointment.page');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/time', [AppointmentController::class, 'showTimeForm'])->name('appointment.time');
    Route::post('/appointment/time', [AppointmentController::class, 'storeTime'])->name('appointment.store-time');
    Route::get('/appointment/details', [AppointmentController::class, 'showDetailsForm'])->name('appointment.details');
    Route::post('/appointment/details', [AppointmentController::class, 'storeDetails'])->name('appointment.details.post');
    Route::get('/appointment/billing', [AppointmentController::class, 'showBillingForm'])->name('appointment.billing');
    Route::post('/appointment/billing', [AppointmentController::class, 'storeBilling'])->name('appointment.billing.post');
    Route::post('/appointment/complete', [AppointmentController::class, 'complete'])->name('appointment.complete');
    Route::get('/appointments/calendar', fn() => view('appointmentcalender'))->name('appointments.calendar');

    Route::get('/medical/history', fn() => view('medicalhistory'))->name('medical.history');

    Route::get('/patient/settings', [PatientController::class, 'edit'])->name('patient.settings');
    Route::post('/patient/settings', [PatientController::class, 'update'])->name('patient.settings.update');
});
