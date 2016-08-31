<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cedeval;
use App\Models\Ordene;
use App\Models\Organizacion;
use App\Models\TipoOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function NuevaOrden()
    {
        $idCliente = Auth::user()->ClienteN->id;
        $cedeval = Cedeval::where('idCliente', Auth::user()->ClienteN->id)->lists('cuenta', 'id');
        $casas = Organizacion::whereHas('ClienteOrganizacion', function ($query) use ($idCliente) {
            $query->where('idCliente', $idCliente);
        })->lists('nombre', 'id');
        $tipoOrden = TipoOrden::lists('nombre', 'id');

        return View('Clientes.Ordenes.NuevaOrden', ['cedeval' => $cedeval, 'casas' => $casas, 'Tipoorden' => $tipoOrden]);



    }

    public function ListadoOrdenesVigentes()
    {

        $idCliente = Auth::user()->ClienteN->id;

        $ordenes = Ordene::where('idCliente', $idCliente)->where('idEstadoOrden', 2)->get();

        return View('Clientes.Ordenes.ListaOrdenesCliente', ['ordenes' => $ordenes]);
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
