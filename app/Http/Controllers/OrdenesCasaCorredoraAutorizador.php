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

        $ordenes = Ordene::where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
        return view('CasaCorredora.OrdenesAutorizador.MostrarOrdenes', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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

            $orden = Ordene::find($id);
            return view('CasaCorredora.OrdenesAutorizador.asignarAgenteCorredor', compact('orden', 'agentes'));
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
                    'idCorredor' => $request['agentes'],
                    'tasaDeInteres' => $request['Comision'],
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
