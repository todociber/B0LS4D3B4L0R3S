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

        $solicitudes = SolicitudRegistro::with('ClienteNSolicitud', 'EstadoSolicitudN')->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoSolicitud', '=', '1')->get();
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

        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion && $solicitud[0]->idUsuario == Auth::user()->id) {

            if ($solicitud[0]->idEstadoSolicitud == 4) {
                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->fill(
                    [
                        'idEstadoSolicitud' => '3',
                        'comentarioDeRechazo' => $request['motivoDeRechazo']
                    ]
                );

                $solicitudAActualizar->save();
                flash('Solicitud rechazada', 'warning');
                return redirect('/SolicitudAfiliacion');

            } else {
                flash('Solicitud no pudo ser rechazada', 'danger');
                return redirect('/SolicitudAfiliacion');
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

        $solicitud = SolicitudRegistro::ofid($id)->with('ClienteNSolicitud', 'EstadoSolicitudN')->get();
        try {
            $solicitud[0]->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }
        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion) {

            if ($solicitud[0]->idUsuario == null) {
                return view('CasaCorredora.SolicitudesAfiliacion.DetalleAfiliacion', compact('solicitud'));
            } elseif ($solicitud[0]->idUsuario == Auth::user()->id) {
                return view('CasaCorredora.SolicitudesAfiliacion.DetalleAfiliacion', compact('solicitud'));
            } else {
                return redirect('/SolicitudAfiliacion');
            }


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

            if ($solicitud[0]->idEstadoSolicitud == 4 && $solicitud[0]->idUsuario == Auth::user()->id) {

                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->fill(
                    [
                        'idEstadoSolicitud' => '2'
                    ]
                );

                $solicitudAActualizar->save();
                flash('Solicitud aceptada', 'success');
                return redirect('/SolicitudAfiliacion');

            } else {
                flash('Solicitud no pudo ser aceptada', 'danger');
                return redirect('/SolicitudAfiliacion');
            }

        } else {
            return redirect('/home');
        }

    }

    public function Procesadas()
    {

        $solicitudes = SolicitudRegistro::with('ClienteN', 'EstadoSolicitudN')
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('idEstadoSolicitud', '!=', '1')->where('idEstadoSolicitud', '!=', '4')
            ->where('idUsuario', '=', Auth::user()->id)
            ->get();
        return view('CasaCorredora.SolicitudesAfiliacion.MostrarAfiliacionesProcesadas', compact('solicitudes'));
    }

    public function Procesar($id)
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
                        'idEstadoSolicitud' => '4',
                        'idUsuario' => Auth::user()->id
                    ]
                );

                $solicitudAActualizar->save();
                flash('Solicitud procesada', 'success');
                return redirect('/SolicitudAfiliacion');

            } else {
                flash('Solicitud no pudo ser aceptada', 'danger');
                return redirect('/SolicitudAfiliacion');
            }

        } else {
            return redirect('/home');
        }


    }


    public function Procesando()
    {


        $solicitudes = SolicitudRegistro::with('ClienteNSolicitud', 'EstadoSolicitudN')
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('idEstadoSolicitud', '=', '4')
            ->where('idUsuario', '=', Auth::user()->id)
            ->get();
        return view('CasaCorredora.SolicitudesAfiliacion.MostrarAfiliacionesProcesadas', compact('solicitudes'));
    }


}
