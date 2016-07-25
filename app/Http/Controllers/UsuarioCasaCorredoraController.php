<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Departamento;
use App\Models\Role;
use App\Models\Usuario;
use Chumper\Datatable\Datatable;
use Illuminate\Http\Request;


//use App\Http\Controllers\Datatable;

class UsuarioCasaCorredoraController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/




    public function index()
    {


        $id = 6;
        $information = Departamento::ofid($id)->get();


        return view('CasaCorredora.Usuarios.MostrarUsuarios', ['information' => $information]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =Role::orderBy('nombre','asc')->where('id','!=','5')->lists('nombre', 'id');


        return view('CasaCorredora.Usuarios.NuevoUsuario',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\RequestUsuarioCasaCorredora|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\RequestUsuarioCasaCorredora $request)
    {


        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
        $numerodeletras=8; //numero de letras para generar el texto
        $cadena = ""; //variable para almacenar la cadena generada
        for($i=0;$i<$numerodeletras;$i++)
        {
            $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1);
        }
        Usuario::create([
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'correo'=>$request['correo'],
            'password'=>bcrypt($cadena),
        ]);
         return redirect('/UsuarioCasaCorredora')->with('message','El cliente se registro exitosamente')->with('tipo','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = Usuario::find($id);
        $roles =Role::orderBy('nombre','asc')->where('id','!=','5')->lists('nombre', 'id');
        return view('CasaCorredora.Usuarios.EditarUsuario', ['usuarios' => $usuarios,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        $usuario->fill(
            [
                'nombre'=>$request['nombre'],
                'apellido'=>$request['apellido'],
                'correo'=>$request['correo']
            ]
        );
        $usuario->save();
        return redirect('/UsuarioCasaCorredora')->with('message','El cliente se edito exitosamente')->with('tipo','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
