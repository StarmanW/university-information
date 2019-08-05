<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectFacultyAdmin
{
    /**
     * Handle an incoming request.
     * 
     * Author: CHong Jia Herng
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Faculty Admin') {
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
}
