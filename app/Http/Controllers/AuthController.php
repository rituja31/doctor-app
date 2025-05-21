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
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,doctor,patient',
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

   public function login(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        switch ($request->role) {
    case 'admin':
        return redirect()->route('admin.dashboard');
    case 'doctor':
        return redirect()->route('doctor.dashboard');
    case 'patient':
        return redirect()->route('patient.dashboard');
}

    }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
}

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
