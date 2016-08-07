<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Ordene;
use Auth;
use DB;
use ErrorException;
use Exception;
use Illuminate\Http\Request;

class OrdenesCasaCorredoraAutorizador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ordenes = Ordene::all();
        return view('CasaCorredora.OrdenesAutorizador.MostrarOrdenes', compact('ordenes'));
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
                ->whereNull('usuarios.deleted_at')
                ->whereNull('rol_usuarios.deleted_at')
                ->orderBy('usuarios.id')
                ->select('usuarios.*')->get();
            $agentesCorredores = DB::select('select COUNT(orden.id) as N, usuario.id, usuario.nombre, usuario.apellido,usuario.email from usuarios as usuario JOIN ordenes as orden ON usuario.id = orden.idCorredor JOIN rol_usuarios as roleU ON usuario.id = roleU.idUsuario where usuario.idOrganizacion=' . Auth::user()->idOrganizacion . ' and roleU.idRol =4 and (orden.idEstadoOrden= 2  or orden.idEstadoOrden=5) and  roleU.deleted_at IS NULL  and usuario.deleted_at IS NULL group by usuario.id, roleU.id order by usuario.id');


            $ordenes = Ordene::ofid($id)
                ->with(['Corredor_UsuarioN' => function ($query) {
                    $query->withTrashed();
                }])->get();


            return view('CasaCorredora.OrdenesAutorizador.asignarAgenteCorredor', compact('ordenes', 'agentes', 'usuariosAgentes', 'agentesCorredores'));
        }


    }

    public function aceptar(Requests\RequestOrdenAutorizador $request, $id)
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
                $orden = Ordene::find($id);
                $orden->fill([
                    'idCorredor' => $request['AgenteCorredor'],
                    'idEstadoOrden' => '2'
                ]);
                $orden->save();
                flash('Agente corredor asignado exitosamente', 'success');
                return redirect('/Ordenes');
            } else {
                flash('Error en consulta', 'danger');
                return redirect('/Ordenes');
            }


        }

    }

    public function rechazar($id)
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
                        'idEstadoOrden' => '3'
                    ]
                );
                $ordenAEliminar->save();
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

            if (\Session::has('UsuarioEliminar')) {
                $orden = Ordene::find($id);
                $orden->fill([
                    'idCorredor' => $request['AgenteCorredor'],
                    'tasaDeInteres' => $request['Comision'],
                    'idEstadoOrden' => '2'
                ]);
                $orden->save();
                flash('Agente corredor asignado exitosamente', 'success');
                return redirect()->back();
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
