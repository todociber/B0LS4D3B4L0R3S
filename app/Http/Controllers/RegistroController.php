<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cedeval;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Direccione;
use App\Models\Municipio;
use App\Models\Organizacion;
use App\Models\RolUsuario;
use App\Models\SolicitudRegistro;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\CountValidator\Exception;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $departamentos = Departamento::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $casas = Organizacion::orderBy('nombre', 'ASC')->where('idTipoOrganizacion', '!=', 2)->lists('nombre', 'id');


        return view('Clientes.Registro.Registro', ['departamentos' => $departamentos, 'casas' => $casas]);
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
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nombre' => 'required',
                'apellido' => 'required',
                'dui' => 'required|unique:clientes,dui|numeric',
                'nit' => 'required|unique:clientes,nit|numeric',
                'nacimiento' => 'required|date',
                'numeroCasa' => 'required|numeric',
                'numeroCelular' => 'required|numeric',
                'departamento' => 'required',
                'municipio' => 'required',
                'direccion' => 'required',
                'cedeval.*.cuenta' => 'required|numeric|unique:cedevals,cuenta',
                'casaCorredora' => 'required',
                'numeroafiliacion' => 'required|numeric',
                'password' => 'required',
                'password2' => 'required',
                'email' => 'required|email|unique:usuarios,email',
            ]);

            $usuario = new Usuario();

            if ($request['password'] != $request['password2']) {
                flash('Las contraseñas ingresadas no coinciden.', 'info');
                return redirect()->route('Registro.index');
            } else if (!$this->verifyCedeval($request['cedeval'])) {
                flash('Ha ingresado cuentas cedevales repetidas', 'info');
                return redirect()->route('Registro.index');
            } else {

                $usuario->fill(
                    [
                        'idOrganizacion' => 17,
                        'nombre' => $request['nombre'],
                        'apellido' => $request['apellido'],
                        'email' => $request['email'],
                        'password' => Hash::make($request['password2']),
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
                        'fecha de nacimiento' => Carbon::parse($request['nacimiento'])->format('Y-m-d'),

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
                    'idOrganizacion' => $request['casaCorredora'],
                    'numeroDeAfiliado' => $request['numeroafiliacion'],
                ]);
                $solicitud->save();

                flash('Datos ingresados con exito', 'success');
                return redirect()->route('Registro.index');

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

}

