<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Log;
use Mockery\CountValidator\Exception;
use Validator;

class BolsaController extends Controller
{
    
    
    //-------CONTROL DE CASAS CORREDORAS-----//


    public function NuevaCasa()
    {


        $organizacion = new Organizacion;
        return View('bves.Casas.RegistroCasas')->with('organizacion',$organizacion);
    }


    //REGISTRAR NUEVA CASA

    public function store(Request $request)
    {

        try
        {
            $validator =  Validator::make($request->all(),[
                'nombre' => 'required',
                'correo' => 'required|email',
                'direccion' => 'required',
                'telefono' => 'required',
                'codigo' => 'required',
            ]);
            if(!$validator->fails()){
            $date = Carbon::now();
            $path = $this->Upload($request);
            if($path != 'error'){
            $organizacion = new Organizacion();
            $organizacion->nombre              = $request->input('nombre');
            $organizacion->logo                = $path;
            $organizacion->correo              = $request->input('correo');
            $organizacion->direccion           = $request->input('direccion');
            $organizacion->telefono            = $request->input('telefono');
            $organizacion->codigo              = $request->input('codigo');
            $organizacion->idTipoOrganizacion  = 1;
            $organizacion->save();

                return response()->json(['error'=>'0']);
            }
            else {

                return response()->json(['error'=>'1']);

                }
            }
            else {

                return response()->json(['error'=>'2']);
            }
       // Flash::success('Casa registrada con éxito');

        }
        catch (Exception $e){

            return response()->json(['error'=>'1', 'error'=>$e]);


        }
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
    

    //UPLOAD IMAGE
    public function Upload($request) {

        try {
            //upload an image to the /img/tmp directory and return the filepath.
            $date = Carbon::now();
            $file = $request->file('file');
            $tmpFilePath = '/imgTemp/';
            $tmpFileName = $date->timestamp;
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFileName;
            return $path;
        }
        catch (Exception $e){

            return 'error';

        }
        }





}
