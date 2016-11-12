<?php

namespace App\Http\Middleware;

use App\Utilities\RolIdentificador;
use Closure;

class AutorizadorAgente
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

        $rol = new RolIdentificador();
        if (!($rol->Autorizador(\Auth::user()) || $rol->AgenteCorredor(\Auth::user()))) {
            return redirect('/NoPermitido');
        }
        return $next($request);
    }
}
