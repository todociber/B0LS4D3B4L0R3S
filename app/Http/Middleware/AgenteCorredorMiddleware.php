<?php

namespace App\Http\Middleware;

use App\Utilities\RolIdentificador;
use Closure;
use Illuminate\Support\Facades\Auth;

class AgenteCorredorMiddleware
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
        $AgenteCorredor = $rol->AgenteCorredor(Auth::user());
        if (!$AgenteCorredor) {
            if ($rol->Autorizador(Auth::user())) {
                return redirect()->route('Ordenes.index');
            } else if ($rol->Administrador(Auth::user())) {
                return redirect()->route('UsuarioCasaCorredora.index');
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
