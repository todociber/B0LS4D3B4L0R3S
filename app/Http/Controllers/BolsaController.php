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
use Illuminate\Support\Facades\Log;
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
                'telefono' => 'required',
                'codigo' => 'required',
                'file' => 'required',
            ]);
            if (!$validator->fails()) {
                $codCasa = Organizacion::where('codigo', $request['codigo'])->count();
                Log::info($codCasa);
                if ($codCasa == 0) {
                    $path = $this->Upload($request);
                    if ($path != 'error') {
                        $date = Carbon::now();
                        $activo = ($request['estado'] == 0) ? $date : null;
                        $organizacion = new Organizacion();
                        $organizacion->nombre = $request->input('nombre');
                        $organizacion->logo = $path;
                        $organizacion->correo = $request->input('correo');
                        $organizacion->direccion = $request->input('direccion');
                        $organizacion->telefono = $request->input('telefono');
                        $organizacion->codigo = $request->input('codigo');
                        $organizacion->idTipoOrganizacion = 1;
                        $organizacion->save();
                        if ($activo != null) {
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
                'password' => bcrypt('12345'),
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
        try {
            Organizacion::destroy($id);
            flash('Estado cambiado con éxito', 'success');
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
                        // $this->makeUser($request['codigo'],$organizacion,$request['correo']);
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
        } catch (Exception $e) {
            return response()->json(['error' => '1', 'error' => $e]);
        }
    }
    //MAKEUSER
    public function ListadoCasas()
    {
        $organizaciones = Organizacion::withTrashed()->get();
        return View('bves.Casas.ListaCasas', ['organizaciones' => $organizaciones]);
    }
}