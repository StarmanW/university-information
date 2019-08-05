<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
            if (Auth::check() && Auth::user()->role === 'Admin') {
                return redirect('/admin/home');
            } elseif (Auth::check() && Auth::user()->role === 'FacultyAdmin') {
                return redirect('/faculty_admin');
            } elseif (Auth::check() && Auth::user()->role === 'Staff') {
                return redirect('/faculty_staff/programme');
            } 
            
            return redirect('/home');
        }

        return $next($request);
    }

}
