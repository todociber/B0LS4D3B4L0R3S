<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\CountValidator\Exception;
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


        $organizacion = new Organizacion;
        return View('bves.Casas.RegistroCasas');
    }


    //REGISTRAR NUEVA CASA

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'correo' => 'required|email',
                'direccion' => 'required',
                'telefono' => 'required|numeric|digits:8|min:0',
                'codigo' => 'required|numeric|digits:5|min:0',
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

                        //errir 0 todo bien, error 1, no se guardo la imagen, error 3 ya existe una casa con ese codigo
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
                'password' => bcrypt($pass),
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
            'subtitulo' => 'Tu cuenta ha sido creada, ingresa a la siguiente dirección para activarla'
        ];
        $token->fill([
                'token' => $tokenDeUsuario,
                'idUsuario' => $usuario->id
            ]
        );
        $token->save();

        Mail::send('emails.EmailSend', $data, function ($message) use ($usuario) {

            $message->from('todociber100@gmail.com', 'Activacion de cuenta');

            $message->to($usuario->email)->subject('Activar su cuenta para uso del sistema SERO');

        });

    }

    public function eliminarRestaurarCasa(Request $request)
    {
        try {

            if ($request["tipo"] == 0) {
                $countOrden = Ordene::where("idOrganizacion", $request["id"])
                    ->whereNotIn("idEstadoOrden", [1, 2, 4, 5, 6])->count();
                if ($countOrden == 0) {
                    DB::table('usuarios')->where("idOrganizacion", $request["id"])->update(["deleted_at" => Carbon::now()]);
                    Organizacion::destroy($request["id"]);
                } else {

                    flash('La casa no puede ser removida porque tiene ordenes en curso', 'success');

                }
            } else {
                $organizacion = Organizacion::withTrashed()->where('id', '=', $request["id"])->first();
                $organizacion->restore();
                DB::table('usuarios')->where("idOrganizacion", $request["id"])->update(["deleted_at" => null]);

                flash('Estado cambiado con éxito', 'success');
            }
        } catch (Exception $e) {
            flash('Ocurrio un problema para cambiar el estado', 'danger');

        }
        return redirect()->route('listadoCasas');

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

        try {

            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'correo' => 'required|email',
                'direccion' => 'required',
                'telefono' => 'required',
                'codigo' => 'required',
                'file' => 'required',
            ]);
            if (!$validator->fails()) {
                $codCasa = DB::table('organizacion')->where('organizacion.codigo', '=', $request['codigo'])->where('organizacion.id', '!=', $id)->count();

                if ($codCasa == 0) {
                    $countOrden = Ordene::where("idOrganizacion", $id)
                        ->whereNotIn("idEstadoOrden", [1, 2, 4, 5, 6])->count();

                    if ($countOrden == 0) {

                    $organizacion = Organizacion::withTrashed()->where('id', $id)->first();
                    $path = $this->Upload($request);
                    if ($path != 'error') {
                        $date = Carbon::now();
                        $activo = ($request['Estado'] == 0) ? $date : null;
                        $organizacion->fill(
                            [
                                'nombre' => $request['nombre'],
                                'logo' => $path,
                                'correo' => $request['correo'],
                                'direccion' => $request['direccion'],
                                'telefono' => $request['telefono'],
                                'codigo' => $request['codigo'],
                            ]
                        );
                        $organizacion->save();
                        if ($activo != null) {
                            $organizacion->delete();

                        } else {
                            $organizacion->restore();

                        }


                        $data = [
                            'titulo' => 'La bolsa de valores ha modificado información de la casa corredora ' . $organizacion->nombre,
                            'nombre' => $organizacion->nombre,
                            'usuario' => $organizacion->email,
                            'ruta' => 'Token.Activacion',
                            'subtitulo' => 'Ingresa al siguiente enlace par activar tu usuario',

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
                        

                       
                        // $this->makeUser($request['codigo'],$organizacion,$request['correo']);
                        return response()->json(['error' => '0']);
                    } else {

                        return response()->json(['error' => '1']);

                    }

                    } else {

                        return response()->json(['error' => '5']);

                    }
                } else {

                    return response()->json(['error' => '3']);
                }

            } else {

                return response()->json(['error' => '2']);
            }
        } catch (Exception $e) {

            return response()->json(['error' => '1', 'error' => $e]);

        }
    }


    //MAKEUSER

    public function ListadoCasas()
    {
        $organizaciones = Organizacion::withTrashed()->where("idTipoOrganizacion", "!=", 2)->get();


        return View('bves.Casas.ListaCasas', ['organizaciones' => $organizaciones]);
    }

}
