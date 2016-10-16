<?php

namespace App\Http\Middleware;

use App\Utilities\RolIdentificador;
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
        $rol = new RolIdentificador;

        if (!$rol->Autorizador(Auth::user())) {
            if ($rol->Administrador(Auth::user())) {
                return redirect()->route('UsuarioCasaCorredora.index');
            } else if ($rol->AgenteCorredor(Auth::user())) {
                return redirect()->route('Ordenes.index');
            }
            return redirect('/login');


        }
        return $next($request);
    }
}
