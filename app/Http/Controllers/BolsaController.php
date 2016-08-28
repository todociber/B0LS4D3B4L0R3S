<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Organizacion;
use App\Models\RolUsuario;
use App\Models\Usuario;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\CountValidator\Exception;

class BolsaController extends Controller
{


    //-------CONTROL DE CASAS CORREDORAS-----//


    public function NuevaCasa()
    {

        return View('bves.Casas.RegistroCasas');
    }

    public function index()
    {


        $organizacion = new Organizacion;
        return View('bves.Casas.RegistroCasas');
    }


    //REGISTRAR NUEVA CASA

    public function store(Request $request)
    {


    }

    public function Upload($request)
    {

        try {
            //upload an image to the /img/tmp directory and return the filepath.
            $date = Carbon::now();
            $file = $request->file('file');
            $tmpFilePath = '/imgTemp/';
            $tmpFileName = $date->timestamp;
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName . '.png');
            $path = $tmpFileName;
            return $path;
        } catch (Exception $e) {

            return 'error';

        }
    }

    public function makeUser($codigo, $organizacion, $correo)
    {
        $date = Carbon::now();
        $usuario = new Usuario();

        $hash = Hash::make($date->timestamp . $codigo);
        $pass = str_limit($hash, 5);
        //MAKING USER
        $usuario->fill(
            [
                'nombre' => 'admin',
                'apellido' => 'admin',
                'email' => $correo,
                'idOrganizacion' => $organizacion->id,
                'password' => Hash::make($pass),
            ]
        );
        $usuario->save();
        //MAKING ROLE
        $rolUsuario = new RolUsuario();
        $rolUsuario->fill(
            [
                'idUsuario' => $usuario->id,
                'idRol' => 2,

            ]
        );
        $rolUsuario->save();

    }

    public function eliminarCasa($id)
    {


    }

    public function RestoreCasa($id)
    {


    }

    public function editarCasa($id)
    {
        //'id'=>'my-dropzone','class' => 'dropzone',

        $organizacion = DB::table('organizacion')->where('organizacion.id', '=', $id)->first();
        // $organizacion = Organizacion::find($id);

        return view('bves.Casas.ModificarCasa', ['organizacion' => $organizacion]);

    }

    //-------CONTROL DE CASAS CORREDORAS-----//


    //UPLOAD IMAGE

    public function update(Request $request, $id)
    {


    }


    //MAKEUSER

    public function ListadoCasas()
    {


        return View('bves.Casas.ListaCasas');
    }

}
