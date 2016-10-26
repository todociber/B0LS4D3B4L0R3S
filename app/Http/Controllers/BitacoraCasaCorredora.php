<?php

namespace App\Http\Controllers;

use App\Models\BitacoraUsuario;
use Auth;

class BitacoraCasaCorredora extends Controller
{
    public function index()
    {
        $bitacora = BitacoraUsuario::where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
        return view('CasaCorredora.Bitacora.MostrarBitacota', compact("bitacora", $bitacora));

    }
}
