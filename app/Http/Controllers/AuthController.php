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
            'role' => 'required|in:doctor,patient',
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
            'password' => 'required|min:4', 
            'role' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

       
        if ($role === 'admin') {
            if ($email === 'admin@gmail.com' && $password === 'admin1234') {
                
                $request->session()->put('admin_logged_in', true);
                $request->session()->put('admin_email', $email);
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors(['email' => 'Invalid admin credentials.'])->onlyInput('email');
            }
        }

        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role !== $role) {
                Auth::logout();
                return back()->withErrors(['email' => 'Incorrect role selected.'])->onlyInput('email');
            }

            $request->session()->regenerate();

            switch ($role) {
                case 'doctor':
                    return redirect()->route('doctor.dashboard');
                case 'patient':
                    return redirect()->route('patient.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function logout(Request $request) {
        
        $request->session()->forget('admin_logged_in');

        Auth::logout();
        return redirect()->route('login');
    }
}