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


        if (Auth::user()->idOrganizacion == null) {
            return redirect('/NoPermitido');
        }
        return $next($request);
    }
}
