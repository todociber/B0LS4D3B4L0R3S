<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\RegistroRequest;
use App\Models\Cedeval;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Direccione;
use App\Models\Municipio;
use App\Models\Organizacion;
use App\Models\RolUsuario;
use App\Models\SolicitudRegistro;
use App\Models\Telefono;
use App\Models\token;
use App\Models\Usuario;
use App\Utilities\GenerarToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Mockery\CountValidator\Exception;
use Redirect;

class RegistroController extends Controller
{
    public $emailE = "";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $departamentos = Departamento::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $casas = Organizacion::orderBy('nombre', 'ASC')->where('idTipoOrganizacion', '!=', 2)->lists('nombre', 'id');


        return view('CasaCorredora.SolicitudesAfiliacion.RegistrarCliente', ['departamentos' => $departamentos, 'casas' => $casas]);
    }


    //GET MUNICIIPIOS

    public function getMunicipios(Request $request)
    {

        try {


            $municipios = Municipio::where('id_departamento', $request['id'])->get();

            if (count($municipios) > 0) {

                return response()->json($municipios, 200);

            } else {

                return response()->json(['error' => 'No se encontraron municipios para este departamento'], 450);
            }
        } catch (Exception $e) {

            return response()->json(['error' => 'Ocurrio un error en la consulta'], 450);
        }


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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroRequest $request)
    {
        try {

            //return redirect()->back(
            $usuario = new Usuario();
            if (count($request['cedeval']) > 5) {
                flash('Solo puede ingresar 5 cuentas cedevales', 'info');
                return Redirect::back()->withInput();
            } else if (!$this->verifyCedeval($request['cedeval'])) {
                flash('Ha ingresado cuentas cedevales repetidas', 'info');
                return redirect()->back()->withInput();
            } else if (Carbon::parse($request['nacimiento'])->diffInYears(Carbon::now(), false) < 18) {
                flash('Debe ser mayor de de 18 años', 'danger');
                return redirect()->back()->withInput();
            } else {
                $usuario->fill(
                    [
                        'nombre' => $request['nombre'],
                        'apellido' => $request['apellido'],
                        'email' => $request['email'],
                        'password' => bcrypt(Carbon::now()),
                    ]
                );
                $usuario->save();
                $rolUsuario = new RolUsuario();
                $rolUsuario->fill(
                    [
                        'idUsuario' => $usuario->id,
                        'idRol' => 5,
                    ]
                );
                $rolUsuario->save();
                $clientes = new Cliente();
                $clientes->fill(
                    [
                        'idUsuario' => $usuario->id,
                        'dui' => $request['dui'],
                        'nit' => $request['nit'],
                        'fechaDeNacimiento' => Carbon::parse($request['nacimiento'])->format('Y-m-d'),
                    ]
                );
                $clientes->save();
                $direccion = new Direccione();
                $direccion->fill(
                    [
                        'idMunicipio' => $request['municipio'],
                        'idCliente' => $clientes->id,
                        'detalle' => $request['direccion'],
                    ]
                );
                $direccion->save();
                $telefono = new Telefono();
                $telefono->fill(
                    [
                        'numero' => $request['numeroCasa'],
                        'idCliente' => $clientes->id,
                        'idTipoTelefono' => 1,
                    ]
                );
                $telefono->save();
                $telefono2 = new Telefono();
                $telefono2->fill(
                    [
                        'numero' => $request['numeroCelular'],
                        'idCliente' => $clientes->id,
                        'idTipoTelefono' => 2,
                    ]
                );
                $telefono2->save();
                // var_dump($request['cedeval']);
                /*$key => $value*/
                foreach ($request['cedeval'] as $cede) {
                    $cedeval = new Cedeval([
                        'idCliente' => $clientes->id,
                        'cuenta' => $cede['cuenta'],
                    ]);
                    $cedeval->save();
                }
                $solicitud = new SolicitudRegistro();
                $solicitud->fill([
                    'idCliente' => $clientes->id,
                    'idOrganizacion' => Auth::user()->idOrganizacion,
                    'numeroDeAfiliado' => $request['numeroafiliacion'],
                    'idUsuario' => Auth::user()->id,
                    'idEstadoSolicitud' => 2,
                ]);
                $solicitud->save();

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
                $token->fill(
                    [
                        'token' => $tokenDeUsuario,
                        'idUsuario' => $usuario->id
                    ]
                );
                $token->save();

                Mail::send('emails.ActivacionCliente', $data, function ($message) use ($usuario) {

                    $message->from('bolsadevalores@bves.com', 'Activacion de cuenta');

                    $message->to($usuario->email)->subject('Activar cuenta de sistema de Ordenes ');

                });

                flash('Cliente registrado exitosamente', 'success');
                return redirect()->route('Afiliados.index');
            }
        } catch (Exception $e) {
            flash('Ocurrio un problema al ingresar la información', 'danger');
            return redirect()->route('Registro.index');
        }
    }
    public function verifyCedeval($cedevals)
    {
        $CopyCede = $cedevals;
        $BandFirst = true;
        $BandTwo = true;
        $i = 0;
        $y = 0;
        while ($BandFirst && $i < count($cedevals)) {
            $cede1 = $cedevals[$i];
            while ($BandTwo && $y < count($CopyCede)) {
                $cede2 = $CopyCede[$y];
                if ($i != $y) {
                    if ($cede1['cuenta'] == $cede2['cuenta']) {
                        $BandFirst = false;
                        $BandTwo = false;
                    }
                }
                $y++;
            }
            $i++;
        }
        return $BandFirst;
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
//PARA VERIFICAR SI EL USUARIO HA INGRESADO CUENTAS CEDEVALS REPETIDAS
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activarCuenta($tokenDeUsuario)
    {

        $tokenE = token::where('token', '=', $tokenDeUsuario)->get();
        if ($tokenE->count() == 0) {
            flash('Token incorrecto', 'danger');
            return view('auth.passwords.reset');
        } else {
            \Session::push('token', $tokenDeUsuario);

            return view('auth.passwords.reset');
        }

    }

    public function cambiarPassword(Requests\CambioPasswordRequest $request)
    {
        if ($request['password'] == $request['password2']) {
            $token = \Session::get('token');
            $tokenE = token::withTrashed()->where('token', '=', $token[0])->first();
            $usuario = Usuario::withTrashed()->where('id', '=', $tokenE->idUsuario)->first();
            $usuario->fill([
                'password' => bcrypt($request['password'])
            ]);
            $usuario->save();
            $usuario->restore();
            $tokenE->delete();
            \Session::remove('token');
            return redirect('/login');
        } else {
            return redirect()->back()->withErrors('Contraseñas no coiciden');
        }

    }
}