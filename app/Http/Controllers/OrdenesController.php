<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BitacoraUsuario;
use App\Models\EstadoOrden;
use App\Models\LatchModel;
use App\Models\Mensaje;
use App\Models\OperacionBolsa;
use App\Models\Ordene;
use App\Models\RolUsuario;
use App\Models\Usuario;
use App\Utilities\Action;
use App\Utilities\RolIdentificador;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Latch;
use PDF;
use Redirect;

class OrdenesController extends Controller
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
        //
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
        //
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


    public function Comentar(Requests\RequestComenatiosCasaCorredora $request, $id)
    {
        $orden = Ordene::where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('id', '=', $id)->first();
        if ($orden->count() > 0) {
            $mensaje = new Mensaje([
                'contenido' => $request['comentario'],
                'idTipoMensaje' => '1',
                'idOrden' => $id,
                'idUsuario' => Auth::user()->id
            ]);
            $action = new Action();
            $action->sendPush($orden->idCliente, 3, $orden->id);

            $data = [
                'nombrecasa' => Auth::user()->Organizacion->nombre,
                'correlativo' => $orden->correlativo
            ];
            $action->sendEmail($data, $orden->ClientesN->UsuarioNC->email, 'Comentario en Orden', 'Comentario en Orden', 'emails.ComentarioCasa');


            flash('Comentario enviado exitosamente', 'success');
            $mensaje->save();

        } else {
            flash('Error al enviar Comentario', 'danger');

        }

        return Redirect::back();


    }


    public function Historial($id)
    {


        $ordenes = Ordene::with("EstadoOrden", "OrdenPadre")->where("idOrden", $id)
            ->where("idOrganizacion", Auth::user()->idOrganizacion)
            ->orWhere("id", $id)
            ->orderBy("created_at", 'DESC')
            ->get();


        if ($ordenes->count() < 2) {
            flash('Historial no disponible', 'warning');
            return redirect('/Ordenes');
        } else {
            return view('CasaCorredora.OrdenesAutorizador.HistorialOrden', compact('ordenes'));
        }

    }

    public function Editar($id)
    {


        $Autorizador = new RolIdentificador();


        $ordenes = Ordene::ofid($id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoorden', '=', '2')->get();

        if ($ordenes->count() > 0) {
            if ($Autorizador->Autorizador(Auth::user())) {
                $agentes = DB::table('usuarios')
                    ->join('rol_usuarios', 'usuarios.id', '=', 'rol_usuarios.idUsuario')
                    ->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)
                    ->where('rol_usuarios.idRol', '=', '4')
                    ->whereNull('rol_usuarios.deleted_at')
                    ->lists(DB::raw(' concat_ws("",nombre," ",apellido) as name'), 'usuarios.id');


                $usuariosAgentes = DB::table('usuarios')
                    ->join('rol_usuarios', 'usuarios.id', '=', 'rol_usuarios.idUsuario')
                    ->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)
                    ->where('rol_usuarios.idRol', '=', '4')
                    ->where('usuarios.id', '!=', \Session::get('UsuarioEliminar'))
                    ->whereNull('usuarios.deleted_at')
                    ->whereNull('rol_usuarios.deleted_at')
                    ->orderBy('usuarios.id')
                    ->select('usuarios.*')->get();
                $Autorizador = true;
                $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');
                return view('CasaCorredora.Ordenes.OrdenesEditar', compact('ordenes', 'agentesCorredores', 'agentes', 'usuariosAgentes', 'Autorizador'));
            } else {
                $Autorizador = false;
                return view('CasaCorredora.Ordenes.OrdenesEditar', compact('ordenes', 'Autorizador'));
            }


        } else {
            flash('Error en consulta', 'danger');
            return redirect('Ordenes');
        }
    }


    public function Actualizar(Request $request, $id)
    {

        $agenteC = Usuario::ofid($request['AgenteCorredor'])->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
        if ($agenteC->count() == 0) {
            return redirect()->back()->withInput()->withErrors('Agente Corredor no disponible');
        }
        $Orden = Ordene::ofid($id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoOrden', '=', 2)->get();
        if ($Orden->count() > 0) {
            $agenteActual = $Orden[0]->idCorredor;
            $comisionActual = $Orden[0]->comision;


            if ($request['Comision'] == '') {
                $ActuaizarComision = $comisionActual;
            } else {
                $ActuaizarComision = $request['Comision'];
            }

            if ($request['AgenteCorredor'] == '') {
                $ActualizarAgente = $agenteActual;
            } else {
                $ActualizarAgente = $request['AgenteCorredor'];
            }

            $orden = Ordene::find($id);

            $orden->fill([
                'comision' => $ActuaizarComision,
                'idCorredor' => $ActualizarAgente,
            ]);
            $orden->save();

            $bitacora = new BitacoraUsuario();
            $bitacora->fill(
                [
                    'tipoCambio' => 'Actualizacion',
                    'idUsuario' => Auth::user()->id,
                    'idOrganizacion' => Auth::user()->idOrganizacion,
                    'descripcion' => 'Actualizacion sobre Orden id' . $orden->id . ' Correlativo ' . $orden->correlativo,

                ]
            );
            $bitacora->save();
            flash('Actualizacion con exito', 'success');
            return redirect('/Ordenes');
        } else {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }


    }

    public function Operaciones($id)
    {
        $ordenes = Ordene::ofid($id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoOrden', '=', '5')->orWhere('idTipoEjecucion', '!=', '3')->get();


        if ($ordenes->count() > 0) {

            if ($ordenes[0]->idTipoEjecucion == 2) {

                return redirect('/Ordenes')->withErrors('Orden ya terminada');

            }
            return view('CasaCorredora.Ordenes.OperacionesDeVolsa', compact('ordenes'));

        } else {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }
    }

    public function OperacionesGuardar(Requests\RequestOperacionBolsa $request, $id)
    {
        $ordenes = Ordene::ofid($id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoOrden', '=', '5')->orWhere('idTipoEjecucion', '!=', '3')->where('idCorredor', '=', Auth::user()->id)->get();
        if ($ordenes->count() > 0) {
            if ($ordenes[0]->idTipoEjecucion != 2) {
                $montoEjecutado = 0;
                $OperacionesRealizadas = $ordenes[0]->Operaiones_ordenes;
                foreach ($OperacionesRealizadas as $operacion) {
                    $montoEjecutado = $montoEjecutado + $operacion->monto;
                }
                $montoGuardar = $request['Monto'];

                if ($montoEjecutado < $ordenes[0]->monto && $montoEjecutado + $montoGuardar <= $ordenes[0]->monto) {

                    if ($montoGuardar == $ordenes[0]->monto) {
                        $orden = Ordene::find($id);

                        $orden->fill([
                            'idTipoEjecucion' => 2,
                            'idEstadoOrden' => 6
                        ]);
                    } else {

                        if ($montoEjecutado + $montoGuardar == $ordenes[0]->monto) {
                            $orden = Ordene::find($id);
                            $orden->fill([
                                'idTipoEjecucion' => 1,
                                'idEstadoOrden' => 6
                            ]);
                        } else {
                            $orden = Ordene::find($id);
                            $orden->fill([
                                'idTipoEjecucion' => 1
                            ]);
                        }

                    }
                    $operacion = new OperacionBolsa();
                    $operacion->fill([
                        'monto' => $request['Monto'],
                        'idOrden' => $id
                    ]);
                    $operacion->save();
                    $orden->save();

                    $data = [
                        'nombreCasa' => Auth::user()->Organizacion->nombre,
                        'correlativoOrden' => $orden->correlativo
                    ];
                    $action = new Action();
                    $action->sendEmail($data, $orden->ClientesN->UsuarioNC->email, 'Operacion de Bolsa', 'Operacion de Bolsa', 'emails.OperacionBolsa');
                    $bitacora = new BitacoraUsuario();
                    $bitacora->fill(
                        [
                            'tipoCambio' => 'OperacionBolsa',
                            'idUsuario' => Auth::user()->id,
                            'idOrganizacion' => Auth::user()->idOrganizacion,
                            'descripcion' => 'Realizacion de Operacion de Bolsa sobre Orden id: ' . $orden->id . ' Correlativo' . $orden->correlativo,

                        ]
                    );
                    $bitacora->save();
                    $action = new Action();
                    $action->sendPush($orden->idCliente, 4, $orden->id);
                    flash('Operacion registrada exitosamente', 'success');
                    return redirect()->back();


                } else {
                    return redirect()->back()->withErrors('Monto superior al autorizado por el cliente');
                }
            } else {

                return redirect()->back()->withErrors('Orden ejecutada completamente');
            }


        } else {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }
    }


    public function DetalleOrdenPDF($id)
    {
        $ordenes = Ordene::ofid($id)->get();
        if ($ordenes->count() > 0) {
            if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            } else {

                $ordenes = Ordene::ofid($id)
                    ->with(['MensajesN_Orden', 'Corredor_UsuarioN' => function ($query) {
                        $query->withTrashed();
                    }])->first();
                $pdf = PDF::loadView('Reportes.reporteFinal', ['orden' => $ordenes]);
                return $pdf->stream('Orden' . $ordenes->correlativo . '.pdf');
            }
        } else {
            flash('Orden no encontrada', 'danger');
            return redirect('/Ordenes');
        }
    }


    public function DetallesOrdenesPDF()
    {
        $ordenes = Ordene::where('idOrganizacion', '=', Auth::user()->idOrganizacion)->with(['MensajesN_Orden', 'Corredor_UsuarioN' => function ($query) {
            $query->withTrashed();
        }])->get();
        if ($ordenes->count() > 0) {
            $view = \View::make('CasaCorredora.OrdenesAutorizador.OrdenesReportePDF', compact('ordenes'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('DetalleOrden#' . $ordenes[0]->correlativo);
        } else {
            return redirect()->back()->withErrors('No se encontraron Ordenes para el reporte');
        }

    }

    public function ReporteFecha()
    {
        $estadosOrdenes = EstadoOrden::orderBy('id', 'ASC')->lists('estado', 'id');
        $estadosOrdenes['7'] = 'Todas';
        return view('CasaCorredora.Ordenes.ReporteDeOrdenes', compact('estadosOrdenes'));
    }

    public function ReporteFechaBuscar(Requests\BuscadorOrdenRequest $request)
    {
        $estadoOrden = $request['estadoOrden'];
        if ($request['fechaFinal'] == null || $request['fechaFinal'] == null) {
            $ordenes = Ordene::where('idEstadoOrden', '=', $estadoOrden)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->with(['MensajesN_Orden', 'Corredor_UsuarioN' => function ($query) {
                $query->withTrashed();
            }])->get();
        } else {
            $fechaInicial = Carbon::parse($request['fechaInicial'])->format('Y-m-d');
            $fechaFinal = Carbon::parse($request['fechaFinal'])->format('Y-m-d');



                if (Carbon::parse($request['fechaInicial'])->diffInDays(Carbon::parse($request['fechaFinal']), false) >= 0) {
                    if ($estadoOrden == 7) {
                        $ordenes = Ordene::where('idOrganizacion', '=', Auth::user()->idOrganizacion)->whereBetween('created_at', [$fechaInicial . ' 00:00:00', $fechaFinal . ' 00:00:00'])->with(['MensajesN_Orden', 'Corredor_UsuarioN' => function ($query) {
                            $query->withTrashed();
                        }])->get();
                    } else {
                        $ordenes = Ordene::where('idEstadoOrden', '=', $estadoOrden)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->whereBetween('created_at', [$fechaInicial . ' 00:00:00', $fechaFinal . ' 00:00:00'])->with(['MensajesN_Orden', 'Corredor_UsuarioN' => function ($query) {
                            $query->withTrashed();
                        }])->get();
                    }


                } else {

                    return redirect()->back()->withInput()->withErrors('Fecha final no puede ser mayor que la fecha inicial');
                }

        }
        if ($ordenes->count() > 0) {
            $view = \View::make('CasaCorredora.OrdenesAutorizador.OrdenesReportePDF', compact('ordenes'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('DetalleOrden#' . $ordenes[0]->correlativo);
        } else {
            return redirect()->back()->withInput()->withErrors('No se encontraron ordenes para el reporte');
        }



    }


    public function reasignar()
    {


        if (\Session::has('UsuarioEliminar')) {


            $id = \Session::get('UsuarioEliminar');


            $Usuario = Usuario::ofid($id)->first();
            $ordenesVigentes = 0;
            foreach ($Usuario->OrdenesUsuario as $ordenes) {
                if ($ordenes->idEstadoOrden == 2) {
                    $ordenesVigentes = 1;
                } elseif ($ordenes->idEstadoOrden == 5) {
                    $ordenesVigentes = 1;
                }
            }
            if ($ordenesVigentes == 1) {
                $usuario = Usuario::ofid($id)->get();
                $ordenes = Ordene::where('idCorredor', '=', $id)
                    ->where('idEstadoOrden', '=', 2)
                    ->orWhere('idEstadoOrden', '=', 5)
                    ->get();
                flash('Usuario tiene ordenes pendientes', 'danger');
                return view('CasaCorredora.OrdenesAutorizador.ReAsignarOrdenes', compact('ordenes', 'usuario'));
            } else {
                if (\Session::has('EditarUsuario')) {
                    flash('Puede editar el usuario ahora', 'succsess');
                    \Session::remove('EditarUsuario');
                    \Session::remove('UsuarioEliminar');

                    return redirect('UsuarioCasaCorredora/' . $id . '/editar');

                } else {


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
                    $Usuario->delete();
                    \Session::remove('UsuarioEliminar');
                    flash('Usuario Eliminado Exitosamente', 'danger');
                    return redirect('UsuarioCasaCorredora');
                }
            }
        } else {
            flash('Error en consulta', 'danger');
            return redirect('UsuarioCasaCorredora');
        }

    }

    public function ordenesbyEstado(Request $request)
    {

        try {


            $idusuario = Auth::user()->id;
            if ($request["estado"] != 0) {
                $ordenes = Ordene::with('TipoOrdenN')
                    ->where('idCorredor', $idusuario)
                    ->where('idEstadoOrden', $request['estado'])
                    ->get();
            } else {
                $ordenes = Ordene::with('TipoOrdenN')
                    ->where('idCorredor', $idusuario)
                    ->get();

            }
            $mensaje = '';
            $estadoOrdenes = EstadoOrden::lists('estado', 'id');
            $estadoOrdenes['0'] = 'Todas';
            return View('CasaCorredora.OrdenesAgente.listadoOrdenes', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes, 'selected' => $request['estado']]);
        } catch (Exception $e) {

            flash('Hubo un problema al filtrar las ordenes', 'danger');
            return redirect()->route('listadoordenesclienteV');

        }


    }

    public function ordenesbyEstadoAu(Request $request)
    {

        try {


            $idusuario = Auth::user()->id;
            if ($request["estado"] != 0) {
                $ordenes = Ordene::with('TipoOrdenN')
                    ->where('idEstadoOrden', $request['estado'])
                    ->where('idOrganizacion', Auth::user()->idOrganizacion)
                    ->get();
            } else {
                $ordenes = Ordene::with('TipoOrdenN')
                    ->where('idOrganizacion', Auth::user()->idOrganizacion)
                    ->get();

            }
            $mensaje = '';
            $estadoOrdenes = EstadoOrden::lists('estado', 'id');
            $estadoOrdenes['0'] = 'Todas';
            return View('CasaCorredora.OrdenesAutorizador.ListadoGeneral', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes, 'selected' => $request['estado']]);
        } catch (Exception $e) {

            flash('Hubo un problema al filtrar las ordenes', 'danger');
            return redirect()->route('listadoordenesclienteV');

        }


    }

    public function ReasignacionUsuario()
    {


        $usuarios = DB::table('usuarios')
            ->join('rol_usuarios', 'usuarios.id', '=', 'rol_usuarios.idUsuario')
            ->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('rol_usuarios.idRol', '=', '4')
            ->whereNull('usuarios.deleted_at')
            ->whereNull('rol_usuarios.deleted_at')
            ->orderBy('usuarios.id')
            ->select('usuarios.*')->get();

        $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');
        return view('CasaCorredora.OrdenesAutorizador.ReasignacionMostrarUsuarios', compact("usuarios", "agentesCorredores"));
    }

    public function ReasignacionOrdenes($id)
    {
        $ordenes = Ordene::where("idCorredor", "=", $id)
            ->where("idOrganizacion", "=", Auth::user()->idOrganizacion)
            ->where("idEstadoOrden", "=", "2")
            ->orWhere("idEstadoOrden", "=", "5")
            ->get();
        if ($ordenes->count() > 0) {
            return view("CasaCorredora.OrdenesAutorizador.ReasignacionMostrarOrdenes", compact("ordenes"));
        } else {
            flash("El usuario no cuenta con Ordenes Asignadas", "danger");
            return redirect("/Ordenes/Reasignacion/Usuario");
        }

    }

    public function ReasignacionAgente($id, $agente)
    {
        $agentes = DB::table('usuarios')
            ->join('rol_usuarios', 'usuarios.id', '=', 'rol_usuarios.idUsuario')
            ->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('rol_usuarios.idRol', '=', '4')
            ->whereNull('rol_usuarios.deleted_at')
            ->lists(DB::raw(' concat_ws("",nombre," ",apellido) as name'), 'usuarios.id');
        $usuariosAgentes = DB::table('usuarios')
            ->join('rol_usuarios', 'usuarios.id', '=', 'rol_usuarios.idUsuario')
            ->where('usuarios.idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('rol_usuarios.idRol', '=', '4')
            ->where('usuarios.id', '!=', $agente)
            ->whereNull('usuarios.deleted_at')
            ->whereNull('rol_usuarios.deleted_at')
            ->orderBy('usuarios.id')
            ->select('usuarios.*')->get();
        $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');


        $ordenes = Ordene::ofid($id)
            ->with(['Corredor_UsuarioN' => function ($query) {
                $query->withTrashed();
            }])->get();


        return view('CasaCorredora.OrdenesAutorizador.ReasignacionAgenteCorredorOrden', compact('ordenes', 'agentes', 'usuariosAgentes', 'agentesCorredores'));
    }

    public function AceptarReasignacion(Requests\AceptarReasignacionRequest $request, $id)
    {

        $ordenes = Ordene::where("id", '=', $id)->where("idOrganizacion", '=', Auth::user()->idOrganizacion)
            ->where('idEstadoOrden', "=", "2")
            ->orWhere('idEstadoOrden', "=", "5")
            ->get();

        if ($ordenes->count() == 0) {
            return redirect()->back()->withErrors("Error Orden no disponible");
        } else {
            $agenteValido = Usuario::where("idOrganizacion", "=", Auth::user()->idOrganizacion)
                ->where("id", "=", $request['AgenteCorredor'])
                ->get();
            $rolAgente = RolUsuario::where("idUsuario", "=", $request['AgenteCorredor'])
                ->where("idRol", "=", "4")
                ->get();
            if ($agenteValido->count() > 0 && $rolAgente->count() > 0) {
                $orden = Ordene::find($id);
                $orden->fill([
                    'idCorredor' => $request['AgenteCorredor'],
                ]);
                $orden->save();
                flash('Agente corredor asignado exitosamente', 'success');
                return redirect("Ordenes/Reasignacion/Usuario");
            } else {
                return redirect()->back()->withErrors("Error Agente no disponible disponible");
            }

        }

    }


}





