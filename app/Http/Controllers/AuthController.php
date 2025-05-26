<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
            'role' => 'required|in:doctor,patient', 
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
            'role'     => 'required|in:admin,doctor,patient'
        ]);

        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        
        if ($role === 'admin') {
            if ($email === 'admin@gmail.com' && $password === 'admin1234') {
                $request->session()->put('admin_logged_in', true);
                $request->session()->put('admin_email', $email);
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors(['email' => 'Invalid admin credentials.'])->withInput();
            }
        }

        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            
            if ($user->role !== $role) {
                Auth::logout();
                return back()->withErrors(['email' => 'Incorrect role selected.'])->withInput();
            }

            $request->session()->regenerate();

            if ($role === 'doctor') {
                return redirect()->route('doctor.dashboard');
            } elseif ($role === 'patient') {
                return redirect()->route('patient.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        
        $request->session()->forget(['admin_logged_in', 'admin_email']);

        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    
}
