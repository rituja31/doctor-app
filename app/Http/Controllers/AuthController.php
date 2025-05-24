<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function showRegister() {
        return view('auth.register');
    }

   
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4', 
            'role' => 'required|in:admin,doctor',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function showLogin(){
        return view('auth.login');
    }

   
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'patient' => redirect()->route('patient.dashboard'),
            default => redirect()->route('home'),
        };
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ])->withInput();
}

    
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
