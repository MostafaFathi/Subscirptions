<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CommonFunctions;
use Closure;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $screen_no,$operations,$permission_level)
    {
        $operations = [$operations];
        if(!CommonFunctions::has_permissions($screen_no,$operations,$permission_level)){
            return redirect('home');
        }
        return $next($request);
    }
}
