<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BolsaController extends Controller
{
    
    
    //-------CONTROL DE CASAS CORREDORAS-----//
    public function NuevaCasa()
    {
        return View('bves.Casas.RegistroCasas');
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
