<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BitacoraUsuario;
use App\Models\LatchModel;
use App\Models\Ordene;
use App\Models\Role;
use App\Models\RolUsuario;
use App\Models\token;
use App\Models\Usuario;
use App\Utilities\Action;
use App\Utilities\GenerarToken;
use App\Utilities\RolIdentificador;
use Auth;
use DB;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Latch;
use Log;
use Mockery\CountValidator\Exception;
use Redirect;
use Snowfire\Beautymail\Beautymail;


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


        $Usuarios = Usuario::with('UsuarioRoles')->withTrashed()->where('id', '!=', Auth::user()->id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();


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
        $numerodeletras = 8; //numero de letras para generar el texto
        $cadena = ""; //variable para almacenar la cadena generada
        for ($i = 0; $i < $numerodeletras; $i++) {
            $cadena .= substr($caracteres, rand(0, strlen($caracteres)), 1);
        }


        $cadena = 'todociber';



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
        $tokenActivos = token::where('idUsuario', '=', $Usuario->id)->get();
        foreach ($tokenActivos as $tokens) {
            $tokens->delete();
        }
        $token = new token();
        $gentoken = new GenerarToken();
        $tokenDeUsuario = $gentoken->tokengenerador();

        $data = array(
            'tokenDeUsuario' => $tokenDeUsuario,
            'objetoToken' => $token
        );
        $token->fill([
                'token' => $tokenDeUsuario,
                'idUsuario' => $Usuario->id
            ]
        );
        $token->save();

        $beautymail = app()->make(Beautymail::class);

        $beautymail->send('emails.ActivacionCliente', $data, function ($message) use ($Usuario) {

            $message->from('todociber100@gmail.com', 'Activacion de cuenta');

            $message->to($Usuario->email)->subject('Activar cuenta de sistema de Ordenes ');

        });


        $bitacora = new BitacoraUsuario();

        $bitacora->fill(
            [
                'tipoCambio' => 'Creación',
                'idUsuario' => Auth::user()->id,
                'idOrganizacion' => Auth::user()->idOrganizacion,
                'descripcion' => 'Creacion de usuario Casa Corredora' . $Usuario->nombre . ' ' . $Usuario->apellido . ' id: ' . $Usuario->id,

            ]
        );
        $bitacora->save();
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
            'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
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
            flash('Error en la consulta', 'danger');
            return redirect('/UsuarioCasaCorredora');
        } else {
            $ordenesVigentes = 0;
            foreach ($usuario->OrdenesUsuario as $ordenes) {
                if ($ordenes->idEstadoOrden == 2) {
                    $ordenesVigentes = 1;
                } elseif ($ordenes->idEstadoOrden == 5) {
                    $ordenesVigentes = 1;
                }
            }


            if ($usuario->email != $request['email']) {
                if ($ordenesVigentes == 1) {
                    $usuario = Usuario::ofid($id)->get();
                    $ordenes = Ordene::where('idCorredor', '=', $id)
                        ->where('idEstadoOrden', '=', 2)
                        ->orWhere('idEstadoOrden', '=', 5)
                        ->get();
                    \Session::set('UsuarioEliminar', $id);
                    \Session::set('EditarUsuario', $id);


                    return redirect('Ordenes/Reasignacion');
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

                    $tokenActivos = token::where('idUsuario', '=', $usuario->id)->get();
                    foreach ($tokenActivos as $tokens) {
                        $tokens->delete();
                    }
                    $token = new token();
                    $gentoken = new GenerarToken();
                    $tokenDeUsuario = $gentoken->tokengenerador();

                    $data = array(
                        'tokenDeUsuario' => $tokenDeUsuario,
                        'objetoToken' => $token
                    );
                    $token->fill([
                            'token' => $tokenDeUsuario,
                            'idUsuario' => $usuario->id
                        ]
                    );
                    $token->save();

                    $beautymail = app()->make(Beautymail::class);

                    $beautymail->send('emails.ActivacionCliente', $data, function ($message) use ($usuario) {

                        $message->from('bolsadevalores@bves.com', 'Activacion de cuenta');

                        $message->to($usuario->email)->subject('Activar cuenta de sistema de Ordenes ');

                    });

                    $action = new Action();
                    $action->killSession($usuario->id);
                }
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
            }



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


                            if ($ordenesVigentes == 1) {


                                if ($RolUsuarioABorrar->idRol == 4) {

                                    $rolLogueado = new RolIdentificador();
                                    if ($rolLogueado->Autorizador(Auth::user())) {
                                        $usuario = Usuario::ofid($id)->get();
                                        $ordenes = Ordene::where('idCorredor', '=', $id)
                                            ->where('idEstadoOrden', '=', 2)
                                            ->orWhere('idEstadoOrden', '=', 5)
                                            ->get();
                                        \Session::set('UsuarioEliminar', $id);
                                        \Session::set('EditarUsuario', $id);


                                        return redirect('Ordenes/Reasignacion');
                                    } else {
                                        flash("El usuario tiene Ordenes en Proceso", "warning");
                                        return redirect('/UsuarioCasaCorredora');
                                    }


                                } else if ($RolUsuarioABorrar->idRol == 2) {


                                    $RolUsuarioABorrar->delete();

                                } else {
                                    $RolUsuarioABorrar->delete();

                                }
                            } else {
                                \Session::remove('EditarUsuario');
                                $RolUsuarioABorrar->delete();
                            }

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

            $bitacora = new BitacoraUsuario();

            $bitacora->fill(
                [
                    'tipoCambio' => 'Edicion',
                    'idUsuario' => Auth::user()->id,
                    'idOrganizacion' => Auth::user()->idOrganizacion,
                    'descripcion' => 'Edicion de usuario Casa Corredora' . $usuario->nombre . ' ' . $usuario->apellido . ' id: ' . $usuario->id,

                ]
            );
            $bitacora->save();
            $action = new Action();
            $action->killSession($usuario->id);
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
    public function desactivarUsuario(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',

        ]);

        $id = $request["id"];
        $Usuario = Usuario::find($id);


        try {
            $Usuario->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }
        $ordenesVigentes = 0;
        foreach ($Usuario->OrdenesUsuario as $ordenes) {
            if ($ordenes->idEstadoOrden == 2) {
                $ordenesVigentes = 1;
            } elseif ($ordenes->idEstadoOrden == 5) {
                $ordenesVigentes = 1;
            }
        }

        if ($ordenesVigentes == 0) {
            if ($Usuario->idOrganizacion != Auth::user()->idOrganizacion) {
                flash('Error en consulta', 'danger');
                return redirect('/UsuarioCasaCorredora');
            } elseif ($id == Auth::user()->id) {
                flash('Error en consulta', 'danger');
                return redirect('/UsuarioCasaCorredora');
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


                $bitacora = new BitacoraUsuario();
                $bitacora->fill(
                    [
                        'tipoCambio' => 'Desactivacion',
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->idOrganizacion,
                        'descripcion' => 'Desactivacion de usuario Casa Corredora' . $Usuario->nombre . ' ' . $Usuario->apellido . ' id: ' . $Usuario->id,

                    ]
                );
                $bitacora->save();
                $action = new Action();
                $action->killSession($Usuario->id);
                $Usuario->delete();
                if (\Session::has('UsuarioEliminar')) {
                    \Session::remove('UsuarioEliminar');
                }

                flash('El usuario se desactivo exitosamente', 'danger');
                return redirect('/UsuarioCasaCorredora');
            }
        } else {
            $rol = new RolIdentificador();
            if ($rol->Autorizador(Auth::user())) {
                \Session::set('UsuarioEliminar', $id);
                return redirect('/Ordenes/Reasignacion');
            } else {
                flash('El usuario tiene Ordenes en proceso', 'danger');
                return redirect('/UsuarioCasaCorredora');
            }

        }

    }

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
        $ordenesVigentes = 0;
        foreach ($Usuario->OrdenesUsuario as $ordenes) {
            if ($ordenes->idEstadoOrden == 2) {
                $ordenesVigentes = 1;
            } elseif ($ordenes->idEstadoOrden == 5) {
                $ordenesVigentes = 1;
            }
        }

        if ($ordenesVigentes == 0) {
            if ($Usuario->idOrganizacion != Auth::user()->idOrganizacion) {
                flash('Error en consulta', 'danger');
                return redirect('/UsuarioCasaCorredora');
            } elseif ($id == Auth::user()->id) {
                flash('Error en consulta', 'danger');
                return redirect('/UsuarioCasaCorredora');
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

                $LatchTokenExiste = LatchModel::where('idUsuario', '=', $Usuario->id)->count();
                if ($LatchTokenExiste > 0) {
                    $accountId = LatchModel::where('idUsuario', '=', $Usuario->id)->first();
                    if (Latch::unpair($accountId->tokenLatch)) {
                        $accountId->delete();
                    }
                }
                $bitacora = new BitacoraUsuario();
                $bitacora->fill(
                    [
                        'tipoCambio' => 'Desactivacion',
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->idOrganizacion,
                        'descripcion' => 'Desactivacion de usuario Casa Corredora' . $Usuario->nombre . ' ' . $Usuario->apellido . ' id: ' . $Usuario->id,

                    ]
                );
                $bitacora->save();
                $action = new Action();
                $action->killSession($Usuario->id);
                $Usuario->delete();
                if (\Session::has('UsuarioEliminar')) {
                    \Session::remove('UsuarioEliminar');
                }
                flash('El usuario se desactivo exitosamente', 'danger');
                return redirect('/UsuarioCasaCorredora');
            }
        } else {

            \Session::set('UsuarioEliminar', $id);
            return redirect('/Ordenes/Reasignacion');
        }


    }

    public function restaurar(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',

        ]);

        $id = $request["id"];
        

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

            $bitacora = new BitacoraUsuario();
            $bitacora->fill(
                [
                    'tipoCambio' => 'ReActivacion',
                    'idUsuario' => Auth::user()->id,
                    'idOrganizacion' => Auth::user()->idOrganizacion,
                    'descripcion' => 'ReActivacion de usuario Casa Corredora' . $Usuario->nombre . ' ' . $Usuario->apellido . ' id: ' . $Usuario->id,

                ]
            );
            $bitacora->save();
            flash('El usuario se activo exitosamente', 'warning');
            return redirect('/UsuarioCasaCorredora');
        }
    }

    public function resetar($id)
    {
        $Usuario = Usuario::find($id);


        $Usuario->restore();

        $tokenActivos = token::where('idUsuario', '=', $Usuario->id)->get();
        foreach ($tokenActivos as $tokens) {
            $tokens->delete();
        }
        $token = new token();
        $gentoken = new GenerarToken();
        $tokenDeUsuario = $gentoken->tokengenerador();

        $data = array(
            'tokenDeUsuario' => $tokenDeUsuario,
            'objetoToken' => $token
        );
        $token->fill([
                'token' => $tokenDeUsuario,
                'idUsuario' => $Usuario->id
            ]
        );
        $token->save();


        $beautymail = app()->make(Beautymail::class);

        $beautymail->send('emails.NuevoPasswordCasa', $data, function ($message) use ($Usuario) {

            $message->from('todociber100@gmail.com', 'Restauracion de password');

            $message->to($Usuario->email)->subject('Restauracion de password');

        });


        $Usuario->restore();
        $action = new Action();
        $action->killSession($Usuario->id);
        $bitacora = new BitacoraUsuario();
        $bitacora->fill(
            [
                'tipoCambio' => 'Reseteo',
                'idUsuario' => Auth::user()->id,
                'idOrganizacion' => Auth::user()->idOrganizacion,
                'descripcion' => 'Reseteo de contrseña  de usuario Casa Corredora' . $Usuario->nombre . ' ' . $Usuario->apellido . ' id: ' . $Usuario->id,

            ]
        );
        $bitacora->save();
        flash('Contraseña restaurada exitosamente ', 'info');
        return redirect('/UsuarioCasaCorredora');


    }

    public function perfil()
    {
        Log::info("ENTRO A PERFIL ");
        return View('CasaCorredora.Usuarios.Perfil', ['user' => Auth::user()]);
    }


}
