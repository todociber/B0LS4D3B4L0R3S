<?php

namespace App\Http\Middleware;

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

        $RolesUsuarioAutenticado = Auth::user()->UsuarioRoles;
        $AdministradorCasa = 0;
        foreach ($RolesUsuarioAutenticado as $rol) {

            if ($rol->idRol == 2) {
                $AdministradorCasa = 1;
            }

        }

        if (Auth::user()->idOrganizacion == null) {
            $AdministradorCasa = 0;
        }
        if (Auth::user()->idOrganizacion == 1) {
            $AdministradorCasa = 0;
        }

        if ($AdministradorCasa == 0) {
            return redirect('/home');
        }
        return $next($request);

    }
}
