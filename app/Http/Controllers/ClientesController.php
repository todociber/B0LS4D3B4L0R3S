<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cedeval;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Direccione;
use App\Models\EstadoOrden;
use App\Models\Mensaje;
use App\Models\Municipio;
use App\Models\Ordene;
use App\Models\Organizacion;
use App\Models\SolicitudRegistro;
use App\Models\Telefono;
use App\Models\TipoOrden;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AfiliacionCasa()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //RETORNA VISTA DE ORDEN
    public function NuevaOrden()
    {

        $count = SolicitudRegistro::where("idCliente", Auth::user()->ClienteN)->where("idEstadoSolicitud", 2)->count();
        if ($count > 0) {

        $idCliente = Auth::user()->ClienteN->id;
        $cedeval = Cedeval::where('idCliente', $idCliente)->lists('cuenta', 'id');
        //OBTENIENDO LAS ORGNANZACIONES DONDE ESTA AFILIADO UN CLIENTE
        $casas = Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
            $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 2);
        })->lists('nombre', 'id');
        $tipoOrden = TipoOrden::lists('nombre', 'id');

        return View('Clientes.Ordenes.NuevaOrden', ['cedeval' => $cedeval, 'casas' => $casas, 'Tipoorden' => $tipoOrden]);

        } else {

            return redirect()->route("afiliarsecasa");
        }
    }

    //LISTADO DE ORDENES SIN IMPORTAR ESTADO
    public function ListadoOrdenes()
    {

        $count = SolicitudRegistro::where("idCliente", Auth::user()->ClienteN)->where("idEstadoSolicitud", 2)->count();
        if ($count > 0) {
        $idCliente = Auth::user()->ClienteN->id;

        $ordenes = Ordene::orderBy('FechaDevigencia', 'desc')->with('TipoOrdenN')->where('idCliente', $idCliente)->where("idEstadoOrden", 1)->get();
        $estadoOrdenes = EstadoOrden::lists('estado', 'id');

        return View('Clientes.Ordenes.ListaOrdenesCliente', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes]);
        } else {

            return redirect()->route("afiliarsecasa");
        }
    }


    //DETALLE DE ORDEN POR ID
    public function OrdenesByID($id)
    {
        try {
            \Session::put('idOrden', $id);
            $orden = Ordene::orderBy('FechaDevigencia', 'desc')->where('id', $id)->where('idCliente', Auth::user()->ClienteN->id)->first();
            if (count($orden) > 0) {

                // var_dump($orden);
                // $timestamp = Carbon::parse($orden->created_at)->timestamp;
                $ordenDate = $orden->created_at->format('m-d-Y'); //date('m-d-Y',Carbon::createFromFormat('Y-d-m H:i:s', $orden->created_at)->timestamp);
                return view('Clientes.Ordenes.DetalleOrden', ['orden' => $orden, 'ordenDate' => $ordenDate]);
            } else {

                return redirect()->route('listadoordenesclienteV');
            }
        } catch (Exception $e) {


        }


    }

    public function ordenesbyEstado(Request $request)
    {

        try {

            $idCliente = Auth::user()->ClienteN->id;
            $ordenes = Ordene::with('TipoOrdenN')->where('idCliente', $idCliente)->where('idEstadoOrden', $request['estado'])->get();
            $estadoOrdenes = EstadoOrden::lists('estado', 'id');
            return View('Clientes.Ordenes.ListaOrdenesCliente', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes, 'selected' => $request['estado']]);
        } catch (Exception $e) {

            flash('Hubo un problema al filtrar las ordenes', 'danger');
            return redirect()->route('listadoordenesclienteV');

        }


    }


    //GUARDAR MENSAJES
    function storeMensajes(Request $request)
    {
        try {
            $this->validate($request, [
                'Comentario' => 'required',

            ]);
            $idOrden = \Session::get('idOrden');
            $mensaje = new Mensaje();
            $mensaje->fill(
                [
                    'idOrden' => $idOrden,
                    'idTipoMensaje' => 1,
                    'idUsuario' => Auth::user()->id,
                    'contenido' => $request['Comentario'],

                ]
            );
            $mensaje->save();
            flash('Mensaje agregado con exito', 'success');
            return redirect()->route('getOrdenes', ['id' => $idOrden]);
        } catch (Exception $e) {

            flash('Ocurrio un error al agregar un comentario', 'danger');
            return redirect()->route('getOrdenes', ['id' => $idOrden]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //GUARDANDO ORDENES
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'cuentacedeval' => 'required',
                'casacorredora' => 'required',
                'tipodeorden' => 'required|numeric',
                'mercado' => 'required',
                'titulo' => 'required',
                'emisor' => 'required',
                'valorMinimo' => 'required|numeric',
                'valorMaximo' => 'required|numeric',
                'monto' => 'required|numeric',
                'FechaDeVigencia' => 'required|date',

            ]);

            if ($request['valorMinimo'] <= 0) {
                flash('El valor minimo  debe ser mayor a cero', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMaximo'] <= 0) {

                flash('El valor máximo  debe ser mayor a cero', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMinimo'] > $request['valorMaximo']) {

                flash('El valor minimo no debe ser mayor al maximo', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMinimo'] >= $request['monto']) {

                flash('El valor minimo no debe ser mayor al monto', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMaximo'] >= $request['monto']) {

                flash('El valor máximo no debe ser mayor al monto', 'info');
                return redirect()->route('nuevaOrden');
            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) < 2) {


                flash('La fecha de vigencia no debe ser menor a 2 días', 'info');

                return redirect()->route('nuevaOrden');
            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) > 60) {

                flash('La fecha de vigencia no debe ser mayor a 2 meses', 'info');
                return redirect()->route('nuevaOrden');
            } else {
                $result = DB::statement('call NuevaOrden(?,?,?,?,?,?,?,?,?,?,?)',
                    array(Auth::user()->ClienteN->id,
                        Carbon::parse($request['FechaDeVigencia'])->format('Y-m-d'),
                        $request['tipodeorden'],
                        $request['titulo'],
                        number_format((float)$request['valorMinimo'], 2, '.', ''),
                        $request['casacorredora'],
                        number_format((float)$request['valorMaximo'], 2, '.', ''),
                        number_format((float)$request['monto'], 2, '.', ''),
                        $request['cuentacedeval'],
                        $request['emisor'],
                        $request['mercado'])
                );


                flash('Orden generada con exito', 'success');
                return redirect()->route('listadoordenesclienteV');
            }
        } catch (Exception $e) {

            flash('Ocurrior un error al procesar la orden', 'danger');
            return redirect()->route('nuevaOrden');
        }


    }


    //RETORNA VISTA PARA MODIFCAR ORDENES
    public function modificarOrden($id)
    {


        $idCliente = Auth::user()->ClienteN->id;
        $orden = Ordene::where("id", $id)
            ->where("idCliente", $idCliente)
            ->where("idEstadoOrden", "=", 2)
            ->orwhere("idEstadoOrden", 1)->first();
        if (count($orden) > 0) {

            $fechaVigencia = Carbon::parse($orden->FechaDeVigencia)->format('m/d/Y');
            $orden->FechaDeVigencia = $fechaVigencia;
            $cedeval = Cedeval::where('idCliente', $idCliente)->lists('cuenta', 'id');
            //OBTENIENDO LAS ORGNANZACIONES DONDE ESTA AFILIADO UN CLIENTE
            $casas = Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
                $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 2);
            })->lists('nombre', 'id');
            $tipoOrden = TipoOrden::lists('nombre', 'id');
            return view('Clientes.Ordenes.ModificarOrden', ['orden' => $orden, 'cedeval' => $cedeval, 'casas' => $casas, 'Tipoorden' => $tipoOrden]);
        } else {
            return redirect()->route('ListadoOrdenesV');

        }


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

    public function AnularOrden(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'motivo' => 'required',

            ]);
            $idCliente = Auth::user()->ClienteN->id;
            $orden = Ordene::where("id", $id)
                ->where("idCliente", $idCliente)
                ->where("idEstadoOrden", "=", 2)
                ->first();

            $orden->fill(
                [
                    'idEstadoOrden' => 3,

                ]
            );
            $orden->save();
            $mensajes = new Mensaje();
            $mensajes->fill(
                [
                    'idTipoMensaje' => 2,
                    'idOrden' => $orden->id,
                    'idUsuario' => Auth::user()->id,
                    'contenido' => $request["motivo"],

                ]
            );
            $mensajes->save();
            flash('Orden anulada con exito', 'success');
            return redirect()->route('listadoordenesclienteV');
        } catch (Exception $e) {
            flash('Ocurrior un error al anular la orden', 'danger');
            return redirect()->route('getOrdenes', ['id' => $orden->id]);
        }


    }

    public function ejecutarOrden(Request $request)
    {

        try {
            $this->validate($request, [
                'id' => 'required',

            ]);

            $idCliente = Auth::user()->ClienteN->id;
            $orden = Ordene::where("id", $request['id'])
                ->where("idCliente", $idCliente)
                ->where("idEstadoOrden", "=", 2)
                ->first();

            $orden->fill(
                [
                    'idEstadoOrden' => 5,

                ]
            );
            $orden->save();

            flash('Orden ejecutada con exito', 'success');
            return redirect()->route('getOrdenes', ["id" => $request["id"]]);

        } catch (Exception $e) {
            flash('Ocurrio un problema al ejecutar la orden', 'success');
            return redirect()->route('getOrdenes', ["id" => $request["id"]]);
        }

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
        try {

            $this->validate($request, [
                'cuentacedeval' => 'required',
                'tipodeorden' => 'required|numeric',
                'mercado' => 'required',
                'titulo' => 'required',
                'emisor' => 'required',
                'valorMinimo' => 'required|numeric',
                'valorMaximo' => 'required|numeric',
                'monto' => 'required|numeric',
                'FechaDeVigencia' => 'required|date',

            ]);

            if ($request['valorMinimo'] <= 0) {
                flash('El valor minimo  debe ser mayor a cero', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMaximo'] <= 0) {

                flash('El valor máximo  debe ser mayor a cero', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMinimo'] > $request['valorMaximo']) {

                flash('El valor minimo no debe ser mayor al maximo', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMinimo'] >= $request['monto']) {

                flash('El valor minimo no debe ser mayor al monto', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMaximo'] >= $request['monto']) {
                // Log::info((int)Carbon::parse($request['FechaDeVigencia'])->diffInDays(Carbon::now(),false));
                flash('El valor máximo no debe ser mayor al monto', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);

            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) < 2) {


                flash('La fecha de vigencia no debe ser menor a 2 días', 'info');

                return redirect()->route('modificarorden', ["id" => $id]);
            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) > 60) {

                flash('La fecha de vigencia no debe ser mayor a 2 meses', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else {

                $idCliente = Auth::user()->ClienteN->id;
                $orden = Ordene::where("id", $id)
                    ->where("idCliente", $idCliente)
                    ->where("idEstadoOrden", "=", 2)
                    ->orwhere("idEstadoOrden", 1)->first();

                $idOrden = $orden->idOrden ? $orden->idOrden : $orden->id;
                $nuevaOrden = new Ordene();
                $nuevaOrden->fill(
                    [
                        'correlativo' => $orden->correlativo,
                        'idCliente' => $idCliente,
                        'FechaDeVigencia' => Carbon::parse($request['FechaDeVigencia'])->format('Y-m-d'),
                        'idCorredor' => $orden->idCorredor,
                        'idTipoOrden' => $request["tipodeorden"],
                        'titulo' => $request['titulo'],
                        'idEstadoOrden' => $orden->idEstadoOrden,
                        'valorMinimo' => number_format((float)$request['valorMinimo'], 2, '.', ''),
                        'idOrganizacion' => $orden->idOrganizacion,
                        'valorMaximo' => number_format((float)$request['valorMaximo'], 2, '.', ''),
                        'idOrden' => $idOrden,
                        'monto' => number_format((float)$request['monto'], 2, '.', ''),
                        'idCuentaCedeval' => $request['cuentacedeval'],
                        'emisor' => $request['emisor'],
                        'TipoMercado' => $request['mercado'],

                    ]
                );
                $nuevaOrden->save();
                $orden->fill(
                    [
                        'idEstadoOrden' => 4,

                    ]
                );
                $orden->save();

                flash('Orden modificada con exito', 'success');
                return redirect()->route('listadoordenesclienteV');
            }
        } catch (Exception $e) {
            flash('Ocurrior un error al modificar la orden', 'danger');
            return redirect()->route('modificarorden');
        }
    }


    public function miPerfilUsuario()
    {


        return view('Clientes.Perfil.PerfilUsuario', ['user' => Auth::user()]);

    }

    public function modificarPerfil()
    {
        $idCliente = Auth::user()->ClienteN->id;
        $departamentos = Departamento::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $telefonos = Telefono::with('TipoTelefonoN')->where('idCliente', $idCliente)->get();
        $direcciones = Direccione::with('MunicipioDireccion', 'MunicipioDireccion.Departamento')->where('id', $idCliente)->get();
        $municipios = Municipio::where('id_departamento', $direcciones[0]->MunicipioDireccion->Departamento->id)->lists('nombre', 'id');
        $telefonoCasa = '';
        $telefonoCelular = '';
        foreach ($telefonos as $telefono) {

            if ($telefono->TipoTelefonoN->id == 1) {

                $telefonoCasa = $telefono->numero;

            } else {

                $telefonoCelular = $telefono->numero;
            }


        }
        return view('Clientes.Perfil.modificarPerfil', ['user' => Auth::user(), 'departamentos' => $departamentos, 'numeroCasa' => $telefonoCasa, 'numeroCelular' => $telefonoCelular, 'direccion' => $direcciones[0], 'municipios' => $municipios]);


    }

    public function modificarPerfilCliente(Request $request)
    {
        try {
            $this->validate($request, [
                'nombre' => 'required',
                'apellido' => 'required',
                'dui' => 'required|numeric',
                'nit' => 'required|numeric',
                'fechaDeNacimiento' => 'required|date',
                'numeroCasa' => 'required|numeric',
                'numeroCelular' => 'required|numeric',
                'departamento' => 'required',
                'municipio' => 'required',
                'direccion' => 'required',
                'email' => 'required|email',
            ]);

            $usuario = Auth::user();
            $clientes = $usuario->ClienteN;

            $countDui = Cliente::where('dui', $request['dui'])->where('id', '!=', $clientes->id)->count();
            $countNIT = Cliente::where('nit', $request['nit'])->where('id', '!=', $clientes->id)->count();
            $countEmail = Usuario::where('email', $request['email'])->where('id', '!=', $usuario->id)->count();
            if ($countDui > 0) {

                flash('El DUI ingresado ya pertenece a un usuario', 'danger');
                return redirect()->route('modificarperfilCliente');

            } else if ($countNIT > 0) {

                flash('El NIT ingresado ya pertenece a un usuario', 'danger');
                return redirect()->route('modificarperfilCliente');

            } else if ($countEmail > 0) {

                flash('El email ingresado ya pertenece a un usuario', 'danger');
                return redirect()->route('modificarperfilCliente');

            } else if (Carbon::now()->diffInDays(Carbon::parse($request['fechaDeNacimiento']), false) < 18) {


                flash('Debe ser mayor de de 18 años', 'danger');
                return redirect()->route('modificarperfilCliente');
            } else {
                $usuario->fill(
                    [
                        'nombre' => $request['nombre'],
                        'apellido' => $request['apellido'],
                        'email' => $request['email'],
                    ]
                );
                $usuario->save();

                $clientes->fill(
                    [
                        'idUsuario' => $usuario->id,
                        'dui' => $request['dui'],
                        'nit' => $request['nit'],
                        'fechaDeNacimiento' => Carbon::parse($request['nacimiento'])->format('Y-m-d'),

                    ]
                );
                $clientes->save();
                $telefonos = Telefono::with('TipoTelefonoN')->where('idCliente', $clientes->id)->get();
                foreach ($telefonos as $telefono) {

                    $reqName = $telefono->TipoTelefonoN->id == 1 ? 'numeroCasa' : 'numeroCelular';
                    if ($telefono->TipoTelefonoN->numero != $request[$reqName]) {
                        $tel = new Telefono();
                        $tel->fill(
                            [
                                'idTipoTelefono' => $telefono->TipoTelefonoN->id,
                                'numero' => $request[$reqName],
                                'idCliente' => $clientes->id,

                            ]
                        );
                        $tel->save();
                        Telefono::destroy($telefono->id);

                    }
                }


                $direcciones = Direccione::with('MunicipioDireccion', 'MunicipioDireccion.Departamento')->where('id', $clientes->id)->get();
                if ($direcciones[0]->detalle != $request['direccion']) {
                    $direccion = new Direccione();
                    $direccion->fill(
                        [
                            'idMunicipio' => $request['municipio'],
                            'idCliente' => $clientes->id,
                            'detalle' => $request['direccion'],

                        ]
                    );
                    $direccion->save();
                    Direccione::destroy($direcciones[0]->id);

                }

                flash('Datos ingresados con exito', 'success');
                return redirect()->route('perfilcliente');
            }
        } catch (Exception $e) {
            flash('Ocurrio un problema al modifcar la información', 'danger');

            return redirect()->route('modificarperfilCliente');
        }

    }

    public function AfiliacionCliente()
    {
        $arrcasas = [];
        $idCliente = Auth::user()->ClienteN->id;
        $casas = Organizacion::where("idTipoOrganizacion", 1)->get();
        foreach ($casas as $casa) {

            $casasClientes = DB::table("solicitud_registros")
                ->whereIn("idEstadoSolicitud", [1, 2, 4])
                ->where("idCliente", $idCliente)
                ->where("idOrganizacion", $casa->id)
                ->count();
            if ($casasClientes == 0) {
                $arrcasas[$casa->id] = $casa->nombre;


            }


        }


        return view("Clientes.Afiliaciones.AfiliacionCliente", ["casas" => $arrcasas]);

    }


    public function AfiliacionClienteStore(Request $request)
    {

        try {
            $this->validate($request, [
                'casas' => 'required',
                'afiliacion' => 'required',

            ]);
            $afiliacion = new SolicitudRegistro();
            $afiliacion->fill(
                [
                    'idCliente' => Auth::user()->ClienteN->id,
                    'idOrganizacion' => $request["casas"],
                    'numeroDeAfiiado' => $request['afiliacion'],
                    'comentarioDeRechazo' => '',
                    'idEstadoSolicitud' => 1,

                ]
            );
            $afiliacion->save();

            flash('Afiliación realizada con éxito', 'success');
            return redirect()->route('afiliarsecasa');

        } catch (Exception $e) {
            flash('Ocurrio un error al realizar la afiliación', 'danger');
            return redirect()->route('afiliarsecasa');

        }

    }


    public function ListadoAfiliaciones()
    {

        $solicitudes = SolicitudRegistro::with("OrganizacionN")
            ->where("idCliente", Auth::user()->ClienteN->id)
            ->where("idEstadoSolicitud", 2)->get();
        return view("Clientes.Afiliaciones.ListaAfiliaciones", ["solicitudes" => $solicitudes]);


    }

    public function ListadoSolicitudes()
    {

        $solicitudes = SolicitudRegistro::with("OrganizacionN", "EstadoSolicitudN")
            ->where("idCliente", Auth::user()->ClienteN->id)->get();
        return view("Clientes.Afiliaciones.ListadoSolicitudesAfiliacion", ["solicitudes" => $solicitudes]);


    }

    public function CuentasCedevales()
    {

        $cedevales = Cedeval::where("idCliente", Auth::user()->ClienteN->id)->get();


        return view("Clientes.Perfil.CuentasCedevales", ["cedevales" => $cedevales]);
    }

    public function EliminarCedeval(Request $request)
    {
        try {
            $this->validate($request, [
                'idCedeval' => 'required',


            ]);
            $countOrden = Ordene::where("idCuentaCedeval", $request["idCedeval"])
                ->whereNotIn("idEstadoOrden", [1, 2, 4, 5, 6])->count();
            Log::info($countOrden);
            if ($countOrden == 0) {

                Cedeval::where("idCliente", Auth::user()->ClienteN->id)->where("id", $request["idCedeval"])->delete();
                flash('Cuenta eliminada con exito', 'success');
                return redirect()->route('cuentascedevales');
            } else {

                flash('Hay orden que aun no ha finalizado, asociado a esta cuenta.', 'info');
                return redirect()->route('cuentascedevales');
            }

        } catch (Exception $e) {

            flash('Ocurrio un error al eliminar la cuenta cedeval', 'danger');
            return redirect()->route('cuentascedevales');
        }
    }

    public function AgregarCedeval(Request $request)
    {
        try {
            $this->validate($request, [
                'CuentaCedeval' => 'required|numeric|unique:cedevals,cuenta',

            ]);

            $cedeval = new Cedeval();
            $cedeval->fill(
                [
                    'idCliente' => Auth::user()->ClienteN->id,
                    'cuenta' => $request["CuentaCedeval"],


                ]
            );
            $cedeval->save();
            flash('Cuenta cedeval agregada con éxito', 'success');
            return redirect()->route('cuentascedevales');
        } catch (Exception $e) {

            flash('Cuenta cedeval eliminar la cuenta cedeval', 'danger');
            return redirect()->route('cuentascedevales');
        }
    }

    public function ModificarCedeval(Request $request)
    {
        try {
            $this->validate($request, [
                'CuentaCedeval' => 'required',
                'idCuentaCedeval' => 'required',

            ]);

            $cedeval = Cedeval::where("id", $request["idCuentaCedeval"])->where("idCliente", Auth::user()->id)->first();
            $cedeval->fill(
                [
                    'cuenta' => $request["CuentaCedeval"],


                ]
            );
            $cedeval->save();
            flash('Cuenta cedeval modificada con éxito', 'success');
            return redirect()->route('cuentascedevales');
        } catch (Exception $e) {

            flash('Ocurrio un error al modificar la cuenta cedeval', 'danger');
            return redirect()->route('cuentascedevales');
        }
    }

    public function modificarPassword()
    {


        return view("Clientes.Perfil.modificarPassword");


    }

    public function modificarPasswordUpdate(Request $request)
    {

        $this->validate($request, [
            'passwordActual' => 'required',
            'newPassword' => 'required',
            'repitaPassword' => 'required',

        ]);

        if (Hash::check($request["passwordActual"], Auth::user()->password)) {
            if ($request["newPassword"] != $request["repitaPassword"]) {

                flash('Las contraseñas no coinciden', 'info');
                return redirect()->route('modificarpassword');
            } else {

                $user = Auth::user();
                $user->fill(
                    [
                        'password' => bcrypt($request["repitaPassword"]),


                    ]
                );
                $user->save();
                flash('contraseña cambiada con exito', 'info');
                return redirect()->route('perfilcliente');
            }


        } else {

            flash('Las contraseña ingresada no coincide con la actual', 'info');
            return redirect()->route('modificarpassword');
        }


    }


    
    
    /**
     *
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
