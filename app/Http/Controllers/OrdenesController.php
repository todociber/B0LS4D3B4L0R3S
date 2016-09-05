<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Mensaje;
use App\Models\Ordene;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->where('id', '=', $id)->count();
        if ($orden > 0) {
            $mensaje = new Mensaje([
                'contenido' => $request['comentario'],
                'idTipoMensaje' => '1',
                'idOrden' => $id,
                'idUsuario' => Auth::user()->id
            ]);
            flash('Comentario enviado exitosamente', 'success');
            $mensaje->save();

        } else {
            flash('Error al enviar Comentario', 'danger');

        }

        return Redirect::back();


    }


    public function Historial($id)
    {


        $ordenes = Ordene::with('OrdenPadre')->ofid($id)->get();

        if ($ordenes[0]->OrdenPadre == null) {
            flash('Historial no disponible', 'warning');
            return redirect('/Ordenes');
        } else {
            return view('CasaCorredora.OrdenesAutorizador.HistorialOrden', compact('ordenes'));
        }

    }

    public function Editar($id)
    {


        $Autorizador = false;
        $roles = Auth::user()->UsuarioRoles;
        foreach ($roles as $rol) {
            if ($rol->idRol == 4) {
                $Autorizador = true;
            }
        }


        $ordenes = Ordene::ofid($id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoorden', '=', '2')->get();

        if ($ordenes->count() > 0) {
            if ($Autorizador) {
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
                return view('CasaCorredora.Ordenes.OrdenesEditar', compact('ordenes', 'agentesCorredores', 'agentes', 'usuariosAgentes', 'Autorizador'));
            } else {
                return view('CasaCorredora.Ordenes.OrdenesEditar', compact('ordenes', 'Autorizador'));
            }


        } else {
            flash('Error en consulta', 'danger');
            return redirect('Ordenes');
        }
    }


    public function  Actualizar(Request $request, $id)
    {
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

            flash('Actualizacion con exito', 'success');
            return redirect('/Ordenes');
        } else {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }


    }

    public function Operaciones($id)
    {
        $ordenes = Ordene::ofid($id)->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoOrden', '=', '5')->get();
        if ($ordenes->count() > 0) {

            return view('CasaCorredora.Ordenes.OperacionesDeBolsa', compact('ordenes'));

        } else {
            flash('Error en consulta', 'danger');
            return redirect('/Ordenes');
        }
    }
}
