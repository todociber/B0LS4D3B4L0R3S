<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\EstadoOrden;
use App\Models\Mensaje;
use App\Models\Ordene;
use App\Models\SolicitudRegistro;
use App\Models\Usuario;
use App\Utilities\Action;
use App\Utilities\RolIdentificador;
use Auth;
use Carbon\Carbon;
use DB;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdenesCasaCorredoraAutorizador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolIdentificador = new RolIdentificador;

        $titulo = '';
        
        if ($rolIdentificador->Autorizador(Auth::user())) {
            $ordenes = Ordene::where('idEstadoOrden', '!=', '4')
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idEstadoOrden', '=', 1)
                ->get();

            $ordenesCount = Ordene::where('idEstadoOrden', '!=', '4')
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idEstadoOrden', '=', 2)
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->count();

            $ordenesVencer = Ordene::where('idEstadoOrden', '!=', '4')
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idEstadoOrden', '=', 2)
                ->whereBetween('FechaDeVigencia', [Carbon::now()->addDay(1)->format('Y-m-d'), Carbon::now()->addDay(6)->format('Y-m-d')])
                ->count();
            $CountSolicitudes = SolicitudRegistro::where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where("idEstadoSolicitud", 1)
                ->count();

            $titulo = 'Ordenes pendiente de asignar';
            return view('CasaCorredora.OrdenesAutorizador.MostrarOrdenes', compact(['ordenes', 'ordenesCount', 'titulo', 'ordenesVencer', 'CountSolicitudes']));

        } else {
            $ordenes = Ordene::where('idEstadoOrden', '!=', '4')
                ->where('idCorredor', '=', Auth::user()->id)
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
            $ordenesAsignadas = count($ordenes);

            $ordenesVencer = Ordene::where('idEstadoOrden', '!=', '4')
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idEstadoOrden', '=', 2)
                ->where('idCorredor', '=', Auth::user()->id)
                ->whereBetween('FechaDeVigencia', [Carbon::now()->addDay(1)->format('Y-m-d'), Carbon::now()->addDay(6)->format('Y-m-d')])
                ->count();

            $ordenesEjecutadas = Ordene::where('idEstadoOrden', '!=', '4')
                ->where('idCorredor', '=', Auth::user()->id)
                ->where('idEstadoOrden', '=', 5)
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->count();
            return view('CasaCorredora.OrdenesAgente.ordenesAsignadas', compact(['ordenes', 'ordenesAsignadas', 'ordenesVencer', 'ordenesEjecutadas']));
        }

    }

    //AGENTE CORREDOR
    public function OrdenesAsignadasAgente()
    {


        $ordenes = Ordene::where('idEstadoOrden', '!=', '4')
            ->where('idCorredor', '=', Auth::user()->id)
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->orderBy("created_at", "ASC")
            ->get();

        $ordenesAsignadas = Ordene::where('idEstadoOrden', '!=', '4')
            ->where('idCorredor', '=', Auth::user()->id)
            ->where('idEstadoOrden', '=', 2)
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->count();

        $ordenesEjecutadas = Ordene::where('idEstadoOrden', '!=', '4')
            ->where('idCorredor', '=', Auth::user()->id)
            ->where('idEstadoOrden', '=', 5)
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->count();


        $ordenesVencer = Ordene::where('idEstadoOrden', '!=', '4')
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('idEstadoOrden', '=', 2)
            ->where('idCorredor', '=', Auth::user()->id)
            ->whereBetween('FechaDeVigencia', [Carbon::now()->addDay(1)->format('Y-m-d'), Carbon::now()->addDay(6)->format('Y-m-d')])
            ->count();

        return view('CasaCorredora.OrdenesAgente.ordenesAsignadas', ['ordenes' => $ordenes, 'ordenesAsignadas' => $ordenesAsignadas, 'ordenesVencer' => $ordenesVencer, 'ordenesEjecutadas' => $ordenesEjecutadas]);

    }

    public function ListadoGeneralOrdenesAgente()
    {

        $idCorredor = Auth::user()->id;

        $ordenes = Ordene::orderBy('FechaDevigencia', 'desc')->with('TipoOrdenN')->where('idCorredor', $idCorredor)->get();
        $estadoOrdenes = EstadoOrden::lists('estado', 'id');
        $estadoOrdenes['0'] = 'Todas';
        return view('CasaCorredora.OrdenesAgente.listadoOrdenes', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes]);

    }

    public function ListadoGeneralAutorizador()
    {

        $idCorredor = Auth::user()->id;

        $ordenes = Ordene::orderBy('FechaDevigencia', 'desc')->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->with('TipoOrdenN')->get();
        $estadoOrdenes = EstadoOrden::lists('estado', 'id');
        $estadoOrdenes['0'] = 'Todas';
        return view('CasaCorredora.OrdenesAutorizador.ListadoGeneral', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes]);

    }
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detallesEliminar($id)
    {

        if (\Session::has('UsuarioEliminar')) {
            $ordenes = Ordene::ofid($id)->get();
            try {
                $ordenes[0]->id;
            } catch (ErrorException $i) {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            } catch (Exception $e) {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            }

            if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            } else {
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
                $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');


                $ordenes = Ordene::ofid($id)
                    ->with(['Corredor_UsuarioN' => function ($query) {
                        $query->withTrashed();
                    }])->get();


                return view('CasaCorredora.OrdenesAutorizador.ReAsignarAgenteCorredor', compact('ordenes', 'agentes', 'usuariosAgentes', 'agentesCorredores'));
            }
        } else {
            flash('Error de consulta', 'danger');
            return redirect('UsuarioCasaCorredora');
        }


    }

    public function asignar($id)
    {

        $ordenes = Ordene::ofid($id)->get();
        try {
            $ordenes[0]->id;
        } catch (ErrorException $i) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } catch (Exception $e) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }

        if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } elseif ($ordenes[0]->idEstadoOrden != 1) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } else {
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
                ->whereNull('usuarios.deleted_at')
                ->whereNull('rol_usuarios.deleted_at')
                ->orderBy('usuarios.id')
                ->select('usuarios.*')->get();
            $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');
            $ordenes = Ordene::ofid($id)->get();
            return view('CasaCorredora.OrdenesAutorizador.asignarAgenteCorredor', compact('ordenes', 'agentes', 'usuariosAgentes', 'agentesCorredores'));
        }


    }

    public function detalles($id)
    {

        $ordenes = Ordene::ofid($id)->get();
        Log::info(json_encode($ordenes));
        try {
            $ordenes[0]->id;
        } catch (ErrorException $i) {
            Log::info($i);
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } catch (Exception $e) {
            Log::info($e);
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }
        $rol = new RolIdentificador();
        if (!$rol->Autorizador(Auth::user())) {
            if ($ordenes[0]->idCorredor != Auth::user()->id) {
                flash('Error en consulta', 'danger');
                return redirect('Ordenes');
            }
        }

        if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
            Log::info('DIFERENTE');
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } else {
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
                ->whereNull('usuarios.deleted_at')
                ->whereNull('rol_usuarios.deleted_at')
                ->orderBy('usuarios.id')
                ->select('usuarios.*')->get();
            $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');


            $ordenes = Ordene::ofid($id)
                ->with(['MensajesN_Orden', 'Corredor_UsuarioN' => function ($query) {
                    $query->withTrashed();
                }])->get();


            return view('CasaCorredora.OrdenesAutorizador.DetalleOrden', compact('ordenes', 'usuariosAgentes', 'agentesCorredores', 'agentes'));


        }


    }

    public function aceptar(Requests\RequestOrdenAutorizador $request, $id)
    {
        $agenteC = Usuario::ofid($request['AgenteCorredor'])->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
        if ($agenteC->count() == 0) {
            return redirect()->back()->withInput()->withErrors('Agente Corredor no disponible');
        }

        $ordenes = Ordene::ofid($id)->get();
        try {
            $ordenes[0]->id;
        } catch (ErrorException $i) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } catch (Exception $e) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }
        if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } else {

            if ($ordenes[0]->idEstadoOrden == '1') {
                $orden = Ordene::find($id);
                $orden->fill([
                    'idCorredor' => $request['AgenteCorredor'],
                    'comision' => $request['Comision'],
                    'idEstadoOrden' => '2'
                ]);
                $orden->save();


                flash('Agente corredor asignado exitosamente', 'success');
                $action = new Action();
                $action->sendPush($orden->idCliente, 1, $orden->id);
                return redirect('/Ordenes');
            } else {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            }


        }

    }

    public function rechazar(Requests\RequestComenatiosCasaCorredora $request, $id)
    {
        $ordenes = Ordene::ofid($id)->get();
        try {
            $ordenes[0]->id;
        } catch (ErrorException $i) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } catch (Exception $e) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }

        if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } else {
            if ($ordenes[0]->idEstadoOrden == '1') {
                $ordenAEliminar = Ordene::find($id);
                $ordenAEliminar->fill(
                    [
                        'idCorredor' => Auth::user()->id,
                        'idEstadoOrden' => '8'
                    ]
                );
                $ordenAEliminar->save();

                $mensaje = new Mensaje([
                    'contenido' => $request['comentario'],
                    'idTipoMensaje' => '2',
                    'idOrden' => $id,
                    'idUsuario' => Auth::user()->id
                ]);
                flash('Comentario enviado exitosamente', 'success');
                $mensaje->save();
                $action = new Action();
                $action->sendPush($ordenAEliminar->idCliente, 1, $ordenAEliminar->id);
                flash('Orden rechazada ', 'success');
                return redirect('/Ordenes');
            } else {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            }


        }


    }

    public function ReAceptar(Request $request, $id)
    {
        $ordenes = Ordene::ofid($id)->get();
        try {
            $ordenes[0]->id;
        } catch (ErrorException $i) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } catch (Exception $e) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }
        if ($ordenes[0]->idOrganizacion != Auth::user()->idOrganizacion) {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        } else {
            $agenteC = Usuario::ofid($request['AgenteCorredor'])->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
            if ($agenteC->count() == 0) {
                return redirect()->back()->withInput()->withErrors('Agente Corredor no disponible');
            }

            if (\Session::has('UsuarioEliminar')) {
                $orden = Ordene::find($id);
                if ($request['Comision'] == null) {
                    $orden->fill([
                        'idCorredor' => $request['AgenteCorredor'],
                        'idEstadoOrden' => '2'
                    ]);
                } else {
                    $orden->fill([
                        'idCorredor' => $request['AgenteCorredor'],
                        'comision' => $request['Comision'],
                        'idEstadoOrden' => '2'
                    ]);
                }
                $orden->save();
                flash('Agente corredor asignado exitosamente', 'success');
                return redirect("Ordenes/Reasignacion");
            } else {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            }


        }
    }

    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
