<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        if ($request->session()->has('admin_logged_in')) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Please log in as an admin.');
    }
}
