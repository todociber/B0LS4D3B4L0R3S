<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\View\View;

class BolsaController extends Controller
{
    
    
    //-------CONTROL DE CASAS CORREDORAS-----//


    public function NuevaCasa()
    {
        $organizacion = new Organizacion();

        return View('bves.Casas.RegistroCasas')->with('casa',$organizacion);
    }


    //REGISTRAR NUEVA CASA

    public function RegistrarNuevaCasa(Request $request)
    {

        $organizacion = new Organizacion();


        return View('');
    }


    public function ListadoCasas()
    {
        return View('bves.Casas.ListaCasas');
    }

    //-------CONTROL DE CASAS CORREDORAS-----//
    
    
    //---CONTROL DE USUARIOS---//

    public function ListadoUsuario()
    {
        return View('bves.Usuarios.ListadoUsuarios');
    }

    public function NuevoUsuario()
    {
        return View('bves.Usuarios.NuevoUsuario');
    }
    //---CONTROL DE USUARIOS---//
    
    //Mi perfil
    public function MiPerfil()
    {
        return View('bves.Perfil.MiPerfil');
    }
    
    
}
