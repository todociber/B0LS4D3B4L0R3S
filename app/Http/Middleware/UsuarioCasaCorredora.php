<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UsuarioCasaCorredora
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (Auth::user()->idOrganizacion == null && Auth::user()->idOrganizacion != 1) {
            return redirect('/NoPermitido');
        }
        return $next($request);
    }
}
