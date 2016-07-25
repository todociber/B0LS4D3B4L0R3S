<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\SolicitudRegistro;
use Auth;
use ErrorException;
use Exception;
use Illuminate\Http\Request;

class SolicitudesCasaCorredora extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $solicitudes = SolicitudRegistro::with('ClienteN', 'EstadoSolicitudN')->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->get();
        return view('CasaCorredora.SolicitudesAfiliacion.MostrarAfiliaciones', compact('solicitudes'));
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
    public function update(Requests\RequestRechazoAfiliazion $request, $id)
    {
        $solicitud = SolicitudRegistro::find($id)->get();
        try {
            $solicitud[0]->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }

        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion) {

            if ($solicitud[0]->idEstadoSolicitud == 1) {
                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->fill(
                    [
                        'idEstadoSolicitud' => '3',
                        'comentarioDeRechazo' => $request['motivoDeRechazo']
                    ]
                );

                $solicitudAActualizar->save();
                return redirect('/SolicitudAfiliacion')->with('message', 'Solicitud rechazada')->with('tipo', 'warning');

            } else {
                return redirect('/SolicitudAfiliacion')->with('message', 'Solicitud no pudo ser rechazada')->with('tipo', 'danger');
            }
        } else {
            return redirect('/home');
        }
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

    public function detalle($id)
    {

        $solicitud = SolicitudRegistro::ofid($id)->with('ClienteN', 'EstadoSolicitudN')->get();
        try {
            $solicitud[0]->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }
        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion) {
            return view('CasaCorredora.SolicitudesAfiliacion.DetalleAfiliacion', compact('solicitud'));
        } else {
            return redirect('/home');
        }


    }

    public function aceptar($id)
    {
        $solicitud = SolicitudRegistro::ofid($id)->get();
        try {
            $solicitud[0]->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }
        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion) {

            if ($solicitud[0]->idEstadoSolicitud == 1) {
                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->fill(
                    [
                        'idEstadoSolicitud' => '2'
                    ]
                );

                $solicitudAActualizar->save();
                return redirect('/SolicitudAfiliacion')->with('message', 'Solicitud aceptada')->with('tipo', 'success');

            } else {
                return redirect('/SolicitudAfiliacion')->with('message', 'Solicitud  no pudo ser aceptada')->with('tipo', 'danger');
            }

        } else {
            return redirect('/home');
        }

    }


}
