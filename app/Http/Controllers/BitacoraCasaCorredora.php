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
}
