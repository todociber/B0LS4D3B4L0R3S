<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Role;
use App\Models\RolUsuario;
use App\Models\Usuario;
use Auth;
use DB;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\Exception;
use Redirect;


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


        $Usuarios = Usuario::with('UsuarioRoles')->withTrashed()->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();


        return view('CasaCorredora.Usuarios.MostrarUsuarios', ['Usuarios' => $Usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/UsuarioCasaCorredora/crear');
    }

    public function crear()
    {
        $roles = Role::orderBy('nombre', 'asc')->where('id', '!=', '5')->where('id', '!=', '1')->get();
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

        foreach ($request['rolUsuario'] as $roles) {
            if ($roles > 1 && $roles < 5) {

            } else {
                return Redirect::back()->withInput()->withErrors(['Error en roles']);
            }
        }


        $correoUsuario = $request['email'];
        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
        $numerodeletras=8; //numero de letras para generar el texto
        $cadena = ""; //variable para almacenar la cadena generada
        for($i=0;$i<$numerodeletras;$i++)
        {
            $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1);
        }

//COTNRASEÑA DE  PRUEBA RECORDAR QUITARLA

        $cadena = 'todociber';


//COTNRASEÑA DE  PRUEBA RECORDAR QUITARLA
        $Usuario = new Usuario(
            [
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'email' => $request['email'],
                'password' => bcrypt($cadena),
                'idOrganizacion' => Auth::user()->idOrganizacion,
            ]
        );

        $Usuario->save();

        foreach ($request['rolUsuario'] as $roles) {
            $RolUsuario = new RolUsuario([
                'idUsuario' => $Usuario->id,
                'idRol' => $roles,
            ]);
            $RolUsuario->save();
        }

        flash('El usuario  se registro exitosamente', 'success');
        return redirect('/UsuarioCasaCorredora');
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
        /*$usuarios = Usuario::find($id);
        $roles =Role::orderBy('nombre','asc')->where('id','!=','5')->lists('nombre', 'id');
        return view('CasaCorredora.Usuarios.EditarUsuario', ['usuarios' => $usuarios,'roles'=>$roles]);
   */

        return redirect('/UsuarioCasaCorredora/' . $id . '/editar');
    }

    public function editar($id)
    {


        $usuarios = Usuario::find($id);
        try {
            $usuarios->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }


        if ($usuarios->idOrganizacion != Auth::user()->idOrganizacion) {
            return redirect('/home');
        } else {
            $roles = Role::orderBy('nombre', 'asc')->where('id', '!=', '5')->where('id', '!=', '1')->get();
            $rolesSeleccionados = RolUsuario::where('idUsuario', '=', $id)->get();
            return view('CasaCorredora.Usuarios.EditarUsuario', ['usuarios' => $usuarios, 'roles' => $roles, 'rolSeleccionados' => $rolesSeleccionados]);
        }

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

        $rules = array(
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|unique:usuarios,email,' . $id,
            'rolUsuario' => 'required|exists:roles,id'

        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {

            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput($request->all());
        }
        foreach ($request['rolUsuario'] as $roles) {
            if ($roles > 1 && $roles < 5) {

            } else {
                return Redirect::back()->withInput()->withErrors(['Error en roles']);
            }
        }


        $usuario = Usuario::find($id);

        if ($usuario->idOrganizacion != Auth::user()->idOrganizacion) {
            return redirect('/home');
        } else {

            $usuario->fill(
                [
                    'nombre' => $request['nombre'],
                    'apellido' => $request['apellido'],
                    'email' => $request['email'],
                    'idOrganizacion' => Auth::user()->idOrganizacion,
                ]
            );
            $usuario->save();

            $rolesDisponibles = Role::all();

            foreach ($rolesDisponibles as $rolDisponible) {

                $existe = 0;
                $idRolDisponible = $rolDisponible->id;
                $NRolesActivosByUser = DB::table('rol_usuarios')
                    ->select(DB::raw('count(*) as N'))
                    ->where('idUsuario', $id)
                    ->where('idRol', $idRolDisponible)
                    ->where('deleted_at', null)
                    ->get();
                if ($NRolesActivosByUser[0]->N > 0) {
                    $existeId = 0;
                    foreach ($request['rolUsuario'] as $role2) {


                        if ($role2 == $idRolDisponible) {
                            $existeId = 1;
                        }


                    }

                    if ($existeId == 0) {


                        if (Auth::user()->id == $id && $idRolDisponible == 2) {

                        } else {
                            $RolUsuarioABorrar = RolUsuario::where('idUsuario', $id)
                                ->where('idRol', $idRolDisponible)->first();

                            $RolUsuarioABorrar->delete();
                        }


                    }


                }
            }


            foreach ($request['rolUsuario'] as $roles) {
                $NRolesActivos = DB::table('rol_usuarios')
                    ->select(DB::raw('count(*) as N'))
                    ->where('idUsuario', $id)
                    ->where('idRol', $roles)
                    ->where('deleted_at', null)
                    ->get();

                if ($NRolesActivos[0]->N == 0) {
                    $RolUsuario = new RolUsuario([
                        'idUsuario' => $usuario->id,
                        'idRol' => $roles,
                    ]);
                    $RolUsuario->save();
                }

            }
            flash('El usuario se edito exitosamente', 'success');
            return redirect('/UsuarioCasaCorredora');
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


        $Usuario = Usuario::find($id);


        try {
            $Usuario->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }


        if ($Usuario->idOrganizacion != Auth::user()->idOrganizacion) {
            return redirect('/home');
        } elseif ($id == Auth::user()->id) {
            return redirect('/home');
        } else {


            foreach ($Usuario->UsuarioAsignado as $solicitudes) {

                if ($solicitudes->idEstadoSolicitud == 4) {
                    $solicitudes->fill([
                        'idUsuario' => NULL,
                        'idEstadoSolicitud' => '1'
                    ]);
                    $solicitudes->save();
                }

            }
            $Usuario->delete();
            flash('El usuario se desactivo exitosamente', 'danger');
            return redirect('/UsuarioCasaCorredora');
        }

    }

    public function restaurar($id)
    {


        $Usuario = Usuario::withTrashed()->find($id);


        try {
            $Usuario->id;
        } catch (ErrorException $i) {

            return redirect('/home');
        } catch (Exception $e) {

            return redirect('/home');
        }
        if ($Usuario->idOrganizacion != Auth::user()->idOrganizacion) {

            return redirect('/home');
        } elseif ($id == Auth::user()->id) {


            return redirect('/home');
        } else {

            $Usuario->restore();
            flash('El usuario se activo exitosamente', 'warning');
            return redirect('/UsuarioCasaCorredora');
        }
    }

    public function resetar($id)
    {
        $Usuario = Usuario::find($id);


        $Usuario->restore();


        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
        $numerodeletras = 8; //numero de letras para generar el texto
        $cadena = ""; //variable para almacenar la cadena generada
        for ($i = 0; $i < $numerodeletras; $i++) {
            $cadena .= substr($caracteres, rand(0, strlen($caracteres)), 1);
        }

//COTNRASEÑA DE  PRUEBA RECORDAR QUITARLA

        $cadena = 'todociber';


//COTNRASEÑA DE  PRUEBA RECORDAR QUITARLA
        $Usuario->fill(
            [
                'password' => bcrypt($cadena),
            ]
        );
        $Usuario->save();

        flash('Se envio una nueva contraseña al correo del usuario', 'info');
        return redirect('/UsuarioCasaCorredora');


    }
}
