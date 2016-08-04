<?php

namespace App\Http\Controllers;

use App\Models\RolUsuario;
use App\Models\Usuario;
use App\Utilities\Action;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
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
                        'idOrganizacion' => 17,
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
        try{
            $message ='';
            $state = '';
            if($id!=Auth::user()->id){
                Usuario::destroy($id);
                $message = 'Estado cambiado con éxito';
                $state = 'success';
            }
            else {

                $message = 'No puede modificar el estado de este usuario';
                $state = 'info';
            }


        }
        catch (Exception $e){
            $message = 'Ocurrio un problema para cambiar el estado';
            $state = 'danger';


        }
        flash($message, $state);
        return redirect()->route('catalogoUsuarios');
    }

    public function resetPassword($id){
        try{
            $action = new Action();
            $message ='';
            $state = '';
            if($id!=Auth::user()->id){
                $user =Usuario::withTrashed()->where('id','=',$id)->first();

                $pass = $action->makePassword($user->id);
                $user->password = Hash::make($pass);
                $user->save();
                //Usuario::destroy($id);
                $message = 'Contraseña reiniciada con éxito';
                $state = 'success';
            }
            else {

                $message = 'No puede reiniciar la contraseña  de este usuario';
                $state = 'info';
            }


        }
        catch (Exception $e){
            $message = 'Ocurrio un problema para reiniciar la contraseña';
            $state = 'danger';


        }
        flash($message, $state);
        return redirect()->route('catalogoUsuarios');

    }

    public function RestaurarUsuario($id)
    {
        try{
            $usuario = Usuario::withTrashed()->where('id','=',$id)->first();
            $usuario->restore();
            flash('Estado cambiado con éxito', 'success');
        }
        catch (Exception $e){
            flash('Ocurrio un problema para cambiar el estado', 'danger');

        }
        return redirect()->route('catalogoUsuarios');
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
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'Estado' => 'required|Numeric',
        ]);


        try{
            $emailUser = DB::table('usuarios')->where('usuarios.email', '=', $request['email'])->where('usuarios.idOrganizacion', '=',17)->where('usuarios.id', '!=',$id)->count();
            if ($emailUser == 0) {
                $usuario = Usuario::withTrashed()->where('id',$id)->first();
                $activo = ($request['Estado'] == 0) ? 'test' : null;
                $usuario->fill(
                    [
                        'nombre' => $request['nombre'],
                        'apellido' => $request['apellido'],
                        'email' => $request['email'],
                    ]
                );
                $usuario->save();
                if ($activo != null) {
                    $usuario->delete();

                } else {
                    $usuario->restore();

                }
                flash('Usuario modificado con éxito', 'success');
                return redirect()->route('catalogoUsuarios');
            }
            else{
                flash('Ya existe un usuario registrado con ese correo', 'info');

                return redirect()->route('modificarusuario',$id);
            }

        }
        catch (Exception $e){
            flash('Ocurrio un problema al modificar el usuario', 'danger');
            return redirect()->route('modificarusuario',$id);

        }
    }

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



    //---CONTROL DE USUARIOS---//

    public function ListadoUsuario()
    {

        $usuarios = Usuario::withTrashed()->where('idOrganizacion',17)->where('id','!=', Auth::user()->id)->get();
        return View('bves.Usuarios.ListadoUsuarios',['usuarios'=>$usuarios]);
    }

    public function NuevoUsuario()
    {

        return View('bves.Usuarios.NuevoUsuario');
    }

    //PARA CREAR ROLES
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

    //---CONTROL DE USUARIOS---//

    //Mi perfil
    public function MiPerfil()
    {
        return View('bves.Perfil.MiPerfil', ['user'=> Auth::user()]);
    }

    public function EditarPerfil()
    {
        return View('bves.Perfil.MiPerfil', ['user'=> Auth::user()]);
    }




}
