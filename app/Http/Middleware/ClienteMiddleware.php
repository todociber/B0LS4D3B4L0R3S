<?php

namespace App\Http\Middleware;

use App\Utilities\RolIdentificador;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClienteMiddleware
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
        $role = new RolIdentificador();
        $cliente = $role->Cliente(Auth::user());
        if (!$cliente) {
            return redirect()->route('nopermitido');
        }
        return $next($request);

    }
}
