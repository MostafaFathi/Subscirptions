<?php

namespace App\Http\Middleware;

use App\Center_permissions_tb;
use App\Center_permissions_users_tb;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            return redirect('/home');
        }

        return $next($request);
    }

}
