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
            if ($rol->Autorizador(Auth::user())) {
                return redirect()->route('SolicitudAfiliacion.index');
            } else if ($rol->AgenteCorredor(Auth::user())) {
                return redirect()->route('Ordenes.index');
            }
            return redirect('/NoPermitido');
        }
        return $next($request);

    }
}
