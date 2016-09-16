<?php

namespace App\Http\Middleware;

use App\Utilities\RolIdentificador;
use Auth;
use Closure;

class UsuarioAdministradorCasaCorredoraAuth
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
        if (!$rol->Administrador(Auth::user())) {
            return redirect('/login');
        }
        return $next($request);

    }
}
