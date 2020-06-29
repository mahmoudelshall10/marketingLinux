<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InstructorAutenticated {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {
        // if ($guard == "instructor" && Auth::guard($guard)->check())
        // {
        //    return $next($request);
        // }
        // return redirect(url('instructor/login'));
            if ($guard == "instructor" && Auth::guard($guard)->check()) 
            {
                return redirect('/instructor');
            }
            return $next($request);

	}
}
