<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleAlumnoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pertenece a Servicios académicos
        if(Auth::User()->id_user_type == 4)
        {
            return $next($request);

        } else {

            return abort(403);
        }

    }
}
