<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Mensaje;
use App\Models\Ordene;
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
}
