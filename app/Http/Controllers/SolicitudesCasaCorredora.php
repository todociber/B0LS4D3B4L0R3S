<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cliente;
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

        $rolesUsuario = Auth::user()->UsuarioRoles;
        $autorizadorRol = 0;
        foreach ($rolesUsuario as $rol) {

            if ($rol->idRol == '3') {

                $autorizadorRol = 1;
            }
        }


        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion) {

            if ($solicitud[0]->idUsuario == null) {
                return view('CasaCorredora.SolicitudesAfiliacion.DetalleAfiliacion', compact('solicitud'));
            } elseif ($solicitud[0]->idUsuario == Auth::user()->id) {
                return view('CasaCorredora.SolicitudesAfiliacion.DetalleAfiliacion', compact('solicitud'));
            } else if ($autorizadorRol == 1) {
                return view('CasaCorredora.SolicitudesAfiliacion.DetalleAfiliacion', compact('solicitud'));
            } else {
                return redirect('/SolicitudAfiliacion');
            }


        } else {
            return redirect('/SolicitudAfiliacion');
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

        $rolesUsuario = Auth::user()->UsuarioRoles;
        $autorizadorRol = 0;
        foreach ($rolesUsuario as $rol) {

            if ($rol->idRol == '3') {

                $autorizadorRol = 1;
            }
        }

        if ($autorizadorRol == 0) {

            $solicitudes = SolicitudRegistro::with('ClienteNSolicitud', 'EstadoSolicitudN')
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idEstadoSolicitud', '!=', '1')->where('idEstadoSolicitud', '!=', '4')
                ->where('idUsuario', '=', Auth::user()->id)
                ->get();
        } else if ($autorizadorRol == 1) {
            $solicitudes = SolicitudRegistro::with('ClienteNSolicitud', 'EstadoSolicitudN')
                ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idEstadoSolicitud', '!=', '1')->where('idEstadoSolicitud', '!=', '4')
                ->get();
        }


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

    public function afiliados()
    {
        $solicitudes = SolicitudRegistro::with('ClienteNSolicitud', 'EstadoSolicitudN')
            ->where('idOrganizacion', '=', Auth::user()->idOrganizacion)
            ->where('idEstadoSolicitud', '=', '2')
            ->get();

        return view('CasaCorredora.SolicitudesAfiliacion.MostrarAfiliados', compact('solicitudes'));

    }


    public function eliminar($id)
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

            if ($solicitud[0]->idEstadoSolicitud == 2) {
                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->delete();
                flash('Afiliado Eliminado ', 'success');
                return redirect('/Afiliados');

            } else {
                flash('Solicitud no pudo ser aceptada', 'danger');
                return redirect('/SolicitudAfiliacion');
            }

        } else {
            return redirect('/home');
        }

    }


    public function buscarCliente()
    {
        return view('CasaCorredora.SolicitudesAfiliacion.BuscarAfiliado');
    }


    public function buscarClientePost(Requests\BuscarClienteRequest $request)
    {
        $cliente = Cliente::withTrashed()->where('DUI', '=', $request['dui'])->get();
        if ($cliente->count() > 0) {
            flash('Cliente encontrado', 'success');
            \Session::remove('cliente');
            \Session::push('cliente', $cliente[0]);
        } else {
            flash('No se encontró al cliente', 'warning');
            \Session::remove('cliente');
        }
        return view('CasaCorredora.SolicitudesAfiliacion.BuscarAfiliado');
    }

    public function afiliarCliente(Requests\AfiliarClienteRequest $request, $id)
    {

        $cliente = Cliente::withTrashed()->where('id', '=', $id)->get();
        if ($cliente->count() > 0) {
            if ($cliente[0]->deleted_at == NULL) {
                $buscarSolicitud = SolicitudRegistro::where('idCliente', '=', $cliente[0]->id)->where('idEstadoSolicitud', '=', '2')->get();
                if ($buscarSolicitud->count() == 0) {
                    $buscarSolicitudPendiente = SolicitudRegistro::where('idCliente', '=', $cliente[0]->id)->where('idEstadoSolicitud', '=', '1')->get();
                    if ($buscarSolicitudPendiente->count() == 0) {
                        $nuevaSolicitud = new SolicitudRegistro();
                        $nuevaSolicitud->fill([
                            'idCliente' => $id,
                            'idOrganizacion' => Auth::user()->idOrganizacion,
                            'idEstadoSolicitud' => '2',
                            'idUsuario' => Auth::user()->id,
                            'numeroDeAfiliado' => $request['numeroafiliacion']
                        ]);

                        $nuevaSolicitud->save();
                        flash('Cliente Afiliado Exitosamente', 'success');
                        return redirect('/Afiliados');
                    } else {
                        $buscarSolicitudPendiente[0]->fill([
                            'idEstadoSolicitud' => 2
                        ]);
                        $buscarSolicitudPendiente[0]->save();
                        flash('Cliente Afiliado Exitosamente', 'success');
                        return redirect('/Afiliados');
                    }
                } else {
                    return redirect()->back()->withErrors('Cliente ya se encuentra afiliado');
                }
            } else {
                return redirect()->back()->withErrors('Cliente no se encuentra Activo');
            }
        } else {
            return redirect()->back()->withErrors('Cliente no encontrado');
        }

    }


}
