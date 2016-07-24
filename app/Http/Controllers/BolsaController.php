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
        return View('bves.Casas.RegistroCasas')->with('organizacion',$organizacion)->with('title','Crear casa');
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
            $codCasa = Organizacion::where('codigo', $request['codigo'])->get();
                if(!$codCasa->isEmpty()){
                    
                    
               
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

                //errir 0 todo bien, error 1, no se guardo la imagen, error 3 ya existe una casa con ese codigo
                return response()->json(['error'=>'0']);
                 }
                else {

                   return response()->json(['error'=>'1']);

                 }
              } else {
    
                return response()->json(['error'=>'2']);
                  }
            } else {

                return response()->json(['error'=>'3']);
            }
       // Flash::success('Casa registrada con éxito');

        }
        catch (Exception $e){

            return response()->json(['error'=>'1', 'error'=>$e]);


        }
    }

    public function edit($id){
        
        $organizacion = Organizacion::find($id);
        return view('bves.Casas.ModificarCasa',['organizacion'=>$organizacion,'title'=>'modificar']);
        
    }

    public function editarCasa($id){
        //'id'=>'my-dropzone','class' => 'dropzone',
        $organizacion = Organizacion::find($id);
      //  var_dump(json_encode($organizacion));
        return view('bves.Casas.ModificarCasa',['organizacion'=>$organizacion]);

    }

    public function update(Request $request,$id)
    {

        try{

        $validator =  Validator::make($request->all(),[
            'nombre' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'telefono' => 'required',
            'codigo' => 'required',
        ]);
        if(!$validator->fails()) {

            $organizacion = Organizacion::find($id);
            $path = $this->Upload($request);
            if ($path != 'error') {
                $organizacion->fill(
                    [
                        'nombre' => $request['nombre'],
                        'logo' => $organizacion,
                        'correo' => $request['correo'],
                        'direccion' => $request['direccion'],
                        'telefono' => $request['telefono'],
                        'codigo' => $request['codigo'],
                    ]
                );
                $organizacion->save();
                return response()->json(['error'=>'0']);
            } else {

                return response()->json(['error' => '1']);

            }
        }
        else {

            return response()->json(['error'=>'2']);
        }
        }
        catch(Exception $e){

            return response()->json(['error'=>'1', 'error'=>$e]);

        }
    }
    
    
    public function ListadoCasas()
    {
        $organizaciones = Organizacion::withTrashed()->get();


        return View('bves.Casas.ListaCasas',['organizaciones'=>$organizaciones]);
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
