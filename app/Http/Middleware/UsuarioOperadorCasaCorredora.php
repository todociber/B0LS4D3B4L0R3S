<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UsuarioOperadorCasaCorredora
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

            if ($rol->idRol == 3) {
                $AdministradorCasa = 1;
            }
        }
        if (Auth::user()->idOrganizacion == null) {
            $AdministradorCasa = 0;
        }
        if (Auth::user()->idOrganizacion == 4) {
            $AdministradorCasa = 0;
        }

        if ($AdministradorCasa == 0) {
            return redirect('/login');
        }
        return $next($request);
    }
}
