<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;


//use App\Http\Controllers\Datatable;

class UsuarioCasaCorredoraController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/




    public function index()
    {

        return view('CasaCorredora.Usuarios.MostrarUsuarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/UsuarioCasaCorredora/crear');
    }

    public function crear()
    {

        return view('CasaCorredora.Usuarios.NuevoUsuario',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\RequestUsuarioCasaCorredora|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        return redirect('/UsuarioCasaCorredora');
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


        return redirect('/UsuarioCasaCorredora/' . $id . '/editar');
    }

    public function editar()
    {

        return view('CasaCorredora.Usuarios.EditarUsuario');

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
        return redirect('/UsuarioCasaCorredora');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }


}
