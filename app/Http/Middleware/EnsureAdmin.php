<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->email === 'admin@gmail.com') {
            return $next($request);
        }

        // If authenticated but not admin, redirect to customer dashboard
        if (Auth::check()) {
            return redirect()->route('customer.profile')->with('error', 'Akses ditolak. Anda tidak memiliki izin Administrator.');
        }

        return redirect()->route('login');
    }
}
