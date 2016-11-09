<?php

namespace App\Http\Controllers;

use App\Models\BitacoraUsuario;
use App\Models\RolUsuario;
use App\Models\token;
use App\Models\Usuario;
use App\Utilities\Action;
use App\Utilities\GenerarToken;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\CountValidator\Exception;
use Snowfire\Beautymail\Beautymail;

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
            'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'email' => 'required|email',
            'Estado' => 'required|numeric',
        ]);
        try{
            $emailUser = DB::table('usuarios')->where('usuarios.email', '=', $request['email'])->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)->count();
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

                $tokenActivos = token::where('idUsuario', '=', $usuario->id)->get();
                foreach ($tokenActivos as $tokens) {
                    $tokens->delete();
                }
                $token = new token();
                $gentoken = new GenerarToken();
                $tokenDeUsuario = $gentoken->tokengenerador();


                $data = [
                    'tokenDeUsuario' => $tokenDeUsuario,
                    'objetoToken' => $token,
                    'titulo' => 'Activación de cuenta',
                    'nombre' => 'Activación de cuenta, para: ' . $usuario->nombre,
                    'usuario' => $usuario->email,
                    'ruta' => 'Token.Activacion',
                    'subtitulo' => 'Ingresa al siguiente enlace par activar tu usuario'
                ];
                $token->fill([
                    'token' => $tokenDeUsuario,
                    'idUsuario' => $usuario->id
                ]);
                $token->save();

                $beautymail = app()->make(Beautymail::class);

                $beautymail->send('emails.ResetPasswordBolsa', $data, function ($message) use ($usuario) {

                    $message->from('todocyber100@gmail.com', 'Activación de cuenta');

                    $message->to($usuario->email)->subject('Activación de cuenta');

                });
                $bitacora = new BitacoraUsuario();

                $bitacora->fill(
                    [
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->Organizacion->id,
                        'descripcion' => 'Creación del usuario: ' . $usuario->nombre,

                    ]
                );
                $bitacora->save();
                
                flash('Usuario guardado con éxito', 'success');
                return redirect()->route('catalogoUsuarios');
            }
            else{
                flash('Ya existe un usuario registrado con ese correo', 'info');

                return redirect()->route('nuevoUsuario')->withInput();
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

    public function EliminarRestaurarUsuario(Request $request)
    {
        try {
            $message = '';
            $state = '';
            if ($request["tipo"] == 0) {
                if ($request["id"] != Auth::user()->id) {
                    Usuario::destroy($request["id"]);
                    $message = 'Estado cambiado con éxito';
                    $state = 'success';
                } else {

                    $message = 'No puede modificar el estado de este usuario';
                    $state = 'info';
                }
                $usuario = Usuario::withTrashed()->where("id", $request["id"])->first();
                $bitacora = new BitacoraUsuario();

                $bitacora->fill(
                    [
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->Organizacion->id,
                        'descripcion' => 'Desactivación de  usuario: ' . $usuario->nombre,

                    ]
                );
                $bitacora->save();
                $action = new Action();
                $action->killSession($request["id"]);

            }
            else {

                $usuario = Usuario::withTrashed()->where('id', '=', $request["id"])->first();
                $usuario->restore();
                $bitacora = new BitacoraUsuario();

                $bitacora->fill(
                    [
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->Organizacion->id,
                        'descripcion' => 'Activación de usuario: ' . $usuario->nombre,

                    ]
                );
                $bitacora->save();

                flash('Estado cambiado con éxito', 'success');
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

                $token = new token();
                $gentoken = new GenerarToken();
                $tokenDeUsuario = $gentoken->tokengenerador();


                $data = [
                    'tokenDeUsuario' => $tokenDeUsuario,
                    'objetoToken' => $token,
                    'titulo' => 'Activación de cuenta',
                    'nombre' => 'Cambio de contraseña, para: ' . $user->nombre,
                    'usuario' => $user->email,
                    'ruta' => 'Token.Activacion',
                    'subtitulo' => 'Tu contraseña ha sido reiniciada, ingresa a la siguiente dirección para cambiar su contraseña'
                ];
                $token->fill([
                    'token' => $tokenDeUsuario,
                    'idUsuario' => $user->id
                ]);
                $token->save();
                $beautymail = app()->make(Beautymail::class);
                $beautymail->send('emails.ResetPasswordBolsa', $data, function ($message) use ($user) {

                    $message->from('todocyber100@gmail.com', 'Reinicio de contraseña');

                    $message->to($user->email)->subject('Reinicio de contraseña');

                });
                //Usuario::destroy($id);
                $message = 'Contraseña reiniciada con éxito';
                $state = 'success';
                $action = new Action();
                $action->killSession($id);
            }
            else {

                $message = 'No puede reiniciar la contraseña  de este usuario';
                $state = 'info';
            }

            $bitacora = new BitacoraUsuario();

            $bitacora->fill(
                [
                    'idUsuario' => Auth::user()->id,
                    'idOrganizacion' => Auth::user()->Organizacion->id,
                    'descripcion' => 'Reinicio de contraseña: ' . $user->nombre,

                ]
            );
            $bitacora->save();



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
            'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'email' => 'required|email',
            'Estado' => 'required|numeric',
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
                    $action = new Action();
                    $action->killSession($usuario->id);

                } else {
                    $usuario->restore();

                }
                flash('Usuario modificado con éxito', 'success');

                $bitacora = new BitacoraUsuario();

                $bitacora->fill(
                    [
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->Organizacion->id,
                        'descripcion' => 'Modificación de  usuario: ' . $usuario->nombre,

                    ]
                );
                $bitacora->save();

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

        $usuarios = Usuario::withTrashed()->where('idOrganizacion', 1)->where('id', '!=', Auth::user()->id)->get();
        return View('bves.Usuarios.ListadoUsuarios',['usuarios'=>$usuarios]);
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
        return View('bves.Perfil.MiPerfil', ['user'=> Auth::user()]);
    }

    public function EditarPerfil()
    {
        return View('bves.Perfil.MiPerfil', ['user'=> Auth::user()]);
    }




}
