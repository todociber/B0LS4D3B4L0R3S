<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class BitacoraCasaCorredora extends Controller
{
    public function index()
    {

        $bitacoras = DB::table("bitacora")
            ->join("usuarios", "bitacora.idUsuario", "=", "usuarios.id")
            ->where("bitacora.idOrganizacion", "=", Auth::user()->idOrganizacion)
            ->orderBy("bitacora.created_at", "DESC")
            ->select("usuarios.nombre", "usuarios.id", "bitacora.*")
            ->get();
        return view('CasaCorredora.Bitacora.MostrarBitacota', compact("bitacoras", $bitacoras));

    }

    public function HistoricoUsuario()
    {
        $roles = DB::table('rol_usuarios')->join('usuarios', 'rol_usuarios.idUsuario', '=', 'usuarios.id')
            ->join('roles', 'roles.id', '=', 'rol_usuarios.idRol')
            ->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->select('usuarios.nombre as NombreUsuario', 'usuarios.email', 'usuarios.deleted_at as UsuarioBorrado', 'usuarios.apellido as ApellidoUsuarios', 'roles.nombre as nombreRol', 'rol_usuarios.*')
            ->get();

        return view('CasaCorredora.Bitacora.HistorialUsuario', compact("roles", $roles));
    }
}
