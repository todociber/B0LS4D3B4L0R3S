<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\RolUsuario;
use App\Models\Usuario;
use App\Utilities\Action;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\CountValidator\Exception;

class UsuariosBolsaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = new Action();

        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'Estado' => 'required|Numeric',
        ]);
        try{
            $emailUser = DB::table('usuarios')->where('usuarios.email', '=', $request['email'])->where('usuarios.idOrganizacion', '=',17)->count();
            if ($emailUser == 0) {
                $usuario = new Usuario();
                $activo = ($request['Estado'] == 0) ? 'test' : null;
                $usuario->fill(
                    [
                        'idOrganizacion' => 1,
                        'nombre' => $request['nombre'],
                        'apellido' => $request['apellido'],
                        'email' => $request['email'],
                        'password' => Hash::make($action->makePassword($request['email'])),
                    ]
                );
                $usuario->save();
                $this->assignRole($usuario->id);
                if ($activo != null) {
                    $usuario->delete();

                } else {
                    $usuario->restore();

                }
                flash('Usuario guardado con éxito', 'success');
                return redirect()->route('catalogoUsuarios');
            }
            else{
                flash('Ya existe un usuario registrado con ese correo', 'info');

                return redirect()->route('nuevoUsuario');
            }

        }
        catch (Exception $e){
            flash('Ocurrio un problema al crear el usuario', 'danger');
            return redirect()->route('nuevoUsuario');

        }

    }

    public function assignRole($idUsuario)
    {
        $rolUsuario = new RolUsuario();
        $rolUsuario->fill(
            [
                'idUsuario' => $idUsuario,
                'idRol' => 1,

            ]
        );
        $rolUsuario->save();

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

    public function ModificarUsuario($id)
    {
        $usuario = DB::table('usuarios')->where('usuarios.id', '=', $id)->where('usuarios.id', '!=', Auth::user()->id)->first();
        if(count($usuario) > 0){
            return view('bves.Usuarios.EditarUsuarioBolsa', ['usuario' => $usuario]);
        }
        else {
            return redirect()->route('catalogoUsuarios');

        }

      //  return response()->json(['error' => $usuario]);
    }

    public function EliminarUsuario($id)
    {

    }

    public function resetPassword($id){


    }

    public function RestaurarUsuario($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }



    //---CONTROL DE USUARIOS---//

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ListadoUsuario()
    {


        return View('bves.Usuarios.ListadoUsuarios');
    }

    //PARA CREAR ROLES

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

    public function EditarPerfil()
    {
        return View('bves.Perfil.MiPerfil', ['user'=> Auth::user()]);
    }




}
