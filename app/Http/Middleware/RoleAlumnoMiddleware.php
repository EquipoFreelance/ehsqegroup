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
        if(Auth::User()->cod_role == 5)
        {
            return $next($request);

        } else {

            return abort(403);
        }

    }
}
