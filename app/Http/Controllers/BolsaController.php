<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BitacoraUsuario;
use App\Models\Ordene;
use App\Models\Organizacion;
use App\Models\RolUsuario;
use App\Models\token;
use App\Models\Usuario;
use App\Utilities\Action;
use App\Utilities\GenerarToken;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use Snowfire\Beautymail\Beautymail;
use Validator;

class BolsaController extends Controller
{


    //-------CONTROL DE CASAS CORREDORAS-----//


    public function NuevaCasa()
    {

        return View('bves.Casas.RegistroCasas');
    }

    public function index()
    {

        return View('bves.Casas.RegistroCasas');
    }


    //REGISTRAR NUEVA CASA

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|unique:organizacion,nombre',
                'correo' => 'required|email|unique:organizacion,correo',
                'direccion' => 'required',
                'telefono' => 'required|numeric|digits:8|min:1',
                'codigo' => 'required|numeric|digits:5|min:1',
                'file' => 'required',
            ]);
            if (!$validator->fails()) {
                $codCasa = Organizacion::where('codigo', $request['codigo'])->count();
                Log::info($codCasa);
                if ($codCasa == 0) {

                    $path = $this->Upload($request);
                    if ($path != 'error') {


                        $organizacion = new Organizacion();
                        $organizacion->nombre = $request->input('nombre');
                        $organizacion->logo = $path;
                        $organizacion->correo = $request->input('correo');
                        $organizacion->direccion = $request->input('direccion');
                        $organizacion->telefono = $request->input('telefono');
                        $organizacion->codigo = $request->input('codigo');
                        $organizacion->idTipoOrganizacion = 1;
                        $organizacion->save();

                        if ($request['Estado'] == 0) {
                            $organizacion->delete();

                        }

                        $this->makeUser($request['codigo'], $organizacion, $request['correo']);

                        $bitacora = new BitacoraUsuario();

                        $bitacora->fill(
                            [
                                'idUsuario' => Auth::user()->id,
                                'idOrganizacion' => Auth::user()->Organizacion->id,
                                'descripcion' => 'Creación de la casa corredora ' . $organizacion->nombre,

                            ]
                        );
                        $bitacora->save();
                        return response()->json(['error' => '0']);
                    } else {

                        return response()->json(['error' => '1']);

                    }
                } else {

                    return response()->json(['error' => '3']);
                }
            } else {

                return response()->json(['error' => '2']);
            }
            // Flash::success('Casa registrada con éxito');

        } catch (Exception $e) {

            return response()->json(['error' => '1', 'error' => $e]);


        }
    }

    public function Upload($request)
    {

        try {
            //upload an image to the /img/tmp directory and return the filepath.

            if ($request->file('file')) {
            $date = Carbon::now();
            $file = $request->file('file');
            $tmpFilePath = '/imgTemp/';
            $tmpFileName = $date->timestamp;
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName . '.png');
            $path = $tmpFileName;
            return $path;
            } else {
                return 'notImage';

            }
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
                'password' => bcrypt($pass),
            ]
        );
        $usuario->save();
        //MAKING ROLE
        $rolAdmin = new RolUsuario();
        $rolAdmin->fill(
            [
                'idUsuario' => $usuario->id,
                'idRol' => 2,

            ]
        );
        $rolAdmin->save();

        $rolCorredor = new RolUsuario();
        $rolCorredor->fill(
            [
                'idUsuario' => $usuario->id,
                'idRol' => 4,

            ]
        );
        $rolCorredor->save();

        $rolAutorizador = new RolUsuario();
        $rolAutorizador->fill(
            [
                'idUsuario' => $usuario->id,
                'idRol' => 3,

            ]
        );
        $rolAutorizador->save();


        $token = new token();
        $gentoken = new GenerarToken();
        $tokenDeUsuario = $gentoken->tokengenerador();


        $data = [
            'tokenDeUsuario' => $tokenDeUsuario,
            'objetoToken' => $token,
            'titulo' => 'Activación de cuenta',
            'nombre' => 'Se ha registrado la casa corredora ' . $organizacion->nombre,
            'usuario' => $usuario->email,
            'ruta' => 'Token.Activacion',
            'subtitulo' => 'Ingresa al siguiente enlace para activar tu cuenta'
        ];
        $token->fill([
                'token' => $tokenDeUsuario,
                'idUsuario' => $usuario->id
            ]
        );
        $token->save();
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.EmailSend', $data, function ($message) use ($usuario) {

            $message->from('todocyber100@gmail.com', 'Activacion de cuenta');

            $message->to($usuario->email)->subject('Activar su cuenta para uso del sistema SERO');

        });


    }

    public function eliminarRestaurarCasa(Request $request)
    {
        try {

            if ($request["tipo"] == 0) {
                $countOrden = Ordene::where("idOrganizacion", $request["id"])
                    ->whereNotIn("idEstadoOrden", [1, 2, 5])->count();
                $organizacion = Organizacion::where("id", $request["id"])->first();
                if ($countOrden == 0) {
                    DB::table('usuarios')->where("idOrganizacion", $request["id"])->update(["deleted_at" => Carbon::now()]);
                    $usuarios = Usuario::where("idOrganizacion", $request["id"])->select("id")->get();
                    $this->killAllSesionHouse($request["id"]);
                    Organizacion::destroy($request["id"]);
                    $bitacora = new BitacoraUsuario();

                    $bitacora->fill(
                        [
                            'idUsuario' => Auth::user()->id,
                            'idOrganizacion' => Auth::user()->Organizacion->id,
                            'descripcion' => 'Casa' . $organizacion->nombre . ', cambio a estado innactivo ',

                        ]
                    );
                    $bitacora->save();
                    flash('Estado cambiado con éxito', 'success');
                } else {

                    flash('La casa no puede ser removida porque tiene ordenes en curso', 'success');


                }
            } else {
                $organizacion = Organizacion::withTrashed()->where('id', '=', $request["id"])->first();
                $organizacion->restore();
                $bitacora = new BitacoraUsuario();

                $bitacora->fill(
                    [
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->Organizacion->id,
                        'descripcion' => 'Casa' . $organizacion->nombre . ', cambio a estado activo ',

                    ]
                );
                $bitacora->save();
                DB::table('usuarios')->where("idOrganizacion", $request["id"])->update(["deleted_at" => null]);

                flash('Estado cambiado con éxito', 'success');
            }
        } catch (Exception $e) {
            flash('Ocurrio un problema para cambiar el estado', 'danger');

        }
        return redirect()->route('listadoCasas');

    }

    function killAllSesionHouse($idCasa)
    {

        $usuarios = Usuario::where("idOrganizacion", $idCasa)->select("id")->get();
        $action = new Action();
        $action->killAllSessionsHouse($usuarios);

    }

    public function RestoreCasa($id)
    {
        try {
            $organizacion = Organizacion::withTrashed()->where('id', '=', $id)->first();
            $organizacion->restore();
            flash('Estado cambiado con éxito', 'success');
        } catch (Exception $e) {
            flash('Ocurrio un problema para cambiar el estado', 'danger');

        }
        return redirect()->route('listadoCasas');

    }

    //RESET PASSWORD

    public function editarCasa($id)
    {
        //'id'=>'my-dropzone','class' => 'dropzone',

        $organizacion = DB::table('organizacion')->where('organizacion.id', '=', $id)->first();
        // $organizacion = Organizacion::find($id);

        return view('bves.Casas.ModificarCasa', ['organizacion' => $organizacion]);

    }

    //-------CONTROL DE CASAS CORREDORAS-----//


    //UPLOAD IMAGE

    public function ResetPasswordCasa($id)
    {
        if ($id) {
            try {

                $idrol = 2;
                $Usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                    $query->where('idRol', $idrol);
                })->where("idOrganizacion", $id)->get();
                Log::info($Usuarios);
                if (count($Usuarios) > 1) {

                    flash('La casa tiene ya mas de un usuario administrador, por ende no puede reinicar la contraseña', 'info');
                    return redirect()->back();
                } else {
                    $organizacion = Organizacion::where("id", $id)->first();
                    $token = new token();
                    $gentoken = new GenerarToken();
                    $tokenDeUsuario = $gentoken->tokengenerador();

                    $data = [
                        'tokenDeUsuario' => $tokenDeUsuario,
                        'objetoToken' => $token,
                        'titulo' => 'Activación de cuenta',
                        'nombre' => 'Se ha activado la casa corredora ' . $organizacion->nombre,
                        'usuario' => $Usuarios[0]->email,
                        'ruta' => 'Token.Activacion',
                        'subtitulo' => 'Ingresa al siguiente enlace para activar tu cuenta'
                    ];
                    $token->fill([
                            'token' => $tokenDeUsuario,
                            'idUsuario' => $Usuarios[0]->id
                        ]
                    );
                    $token->save();
                    $usuario = $Usuarios[0];
                    $beautymail = app()->make(Beautymail::class);
                    $beautymail->send('emails.EmailSend', $data, function ($message) use ($usuario) {

                        $message->from('todocyber100@gmail.com', 'Activacion de cuenta');

                        $message->to($usuario->email)->subject('Activar su cuenta para uso del sistema SERO');

                    });
                    $bitacora = new BitacoraUsuario();

                    $bitacora->fill(
                        [
                            'idUsuario' => Auth::user()->id,
                            'idOrganizacion' => Auth::user()->Organizacion->id,
                            'descripcion' => 'Renovación de contraseña de usuario admin casa corredora ' . $organizacion->nombre,

                        ]
                    );
                    $bitacora->save();

                    flash('Contraseña reiniciada con exito', 'success');
                    return redirect()->route('listadoCasas');

                }

            } catch (Exception $e) {
                flash('Ocurrio un error al reiniciar la contraseña', 'danger');
                return redirect()->back();

            }

        } else {
            return redirect()->route('listadoCasas');

        }


    }


    //MAKEUSER

    public function update(Request $request, $id)
    {

        Log::info('UPDATE?');
        try {

            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'correo' => 'required|email',
                'direccion' => 'required',
                'telefono' => 'required|numeric|digits:8|min:1',
                'codigo' => 'required|size:5|regex:/^([0-9])+$/i',

            ]);
            if (!$validator->fails()) {
                $codCasa = DB::table('organizacion')->where('organizacion.codigo', '=', $request['codigo'])->where('organizacion.id', '!=', $id)->count();
                $codEmail = DB::table('organizacion')->where('organizacion.correo', '=', $request['correo'])->where('organizacion.id', '!=', $id)->count();

                if ($codCasa == 0) {
                    if ($codEmail == 0) {
                    $countOrden = Ordene::where("idOrganizacion", $id)
                        ->whereNotIn("idEstadoOrden", [1, 2, 5])->count();

                    if ($countOrden == 0) {

                    $organizacion = Organizacion::withTrashed()->where('id', $id)->first();
                    $path = $this->Upload($request);
                    if ($path != 'error') {
                        $date = Carbon::now();
                        $activo = ($request['Estado'] == 0) ? $date : null;
                        $logo = $organizacion->logo;
                        $organizacion->fill(
                            [
                                'nombre' => $request['nombre'],
                                'logo' => $sc = $path == 'notImage' ? $logo : $path,
                                'correo' => $request['correo'],
                                'direccion' => $request['direccion'],
                                'telefono' => $request['telefono'],
                                'codigo' => $request['codigo'],
                            ]
                        );
                        $organizacion->save();

                        if ($activo != null) {
                            $organizacion->delete();
                            $this->killAllSesionHouse($organizacion->id);

                        } else {
                            $organizacion->restore();

                        }


                        $data = [
                            'titulo' => 'La bolsa de valores ha modificado información de la casa corredora ',
                            'usuario' => $organizacion->email,
                            'ruta' => 'Token.Activacion',
                            'subtitulo' => 'Ingresa al siguiente enlace par activar tu usuario',
                            'nombre' => $organizacion->nombre,

                        ];
                        $idrol = 2;
                        $usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                            $query->where('idRol', $idrol);
                        })->where("idOrganizacion", $organizacion->id)->get();
                        $emails = [];
                        $i = 0;
                        foreach ($usuarios as $user) {
                            $emails[$i] = $user->email;
                            $i++;
                        }
                        $action = new Action();
                        $action->sendEmail($data, $emails, 'Modificación de información', 'Modificación de información', 'emails.emailUpdateCasa');

                        $bitacora = new BitacoraUsuario();

                        $bitacora->fill(
                            [
                                'idUsuario' => Auth::user()->id,
                                'idOrganizacion' => Auth::user()->Organizacion->id,
                                'descripcion' => 'Casa' . $organizacion->nombre . ', han cambiado su información',

                            ]
                        );
                        $bitacora->save();
                        // $this->makeUser($request['codigo'],$organizacion,$request['correo']);
                        return response()->json(['error' => '0']);
                    } else {

                        return response()->json(['error' => '1']);

                    }

                    } else {

                        return response()->json(['error' => '5']);

                    }
                    } else {
                        return response()->json(['error' => '4']);
                    }
                } else {

                    return response()->json(['error' => '3']);
                }

            } else {

                return response()->json(['error' => '2', 'type' => $validator->errors()->all()]);
            }
        } catch (\Exception $e) {

            return response()->json(['error' => '1', 'error' => $e]);

        }
    }

    //BITACORAS

    public function ListadoCasas()
    {
        $organizaciones = Organizacion::withTrashed()->where("idTipoOrganizacion", "!=", 2)->get();


        return View('bves.Casas.ListaCasas', ['organizaciones' => $organizaciones]);
    }

    public function bitacoras()
    {
        $bitacoras = DB::table("bitacora")
            ->join("usuarios", "bitacora.idUsuario", "=", "usuarios.id")
            ->where("bitacora.idOrganizacion", "=", Auth::user()->idOrganizacion)
            ->orderBy("bitacora.created_at", "DESC")
            ->select("usuarios.nombre", "usuarios.id", "bitacora.*")
            ->get();

        return view("bves.Bitacora.listadoBitacora", ["bitacoras" => $bitacoras]);


    }

}
