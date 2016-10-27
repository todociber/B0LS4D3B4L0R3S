<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BitacoraUsuario;
use App\Models\Cliente;
use App\Models\Ordene;
use App\Models\SolicitudRegistro;
use App\Utilities\Action;
use Auth;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Log;

class SolicitudesCasaCorredora extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $solicitudes = SolicitudRegistro::with('ClienteNSolicitud', 'EstadoSolicitudN')->where('idOrganizacion', '=', Auth::user()->idOrganizacion)->where('idEstadoSolicitud', '=', '5')->get();
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
                $bitacora = new BitacoraUsuario();
                $bitacora->fill(
                    [
                        'tipoCambio' => 'Rechazo',
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->idOrganizacion,
                        'descripcion' => 'Rechazo de afiliacion id' . $solicitudAActualizar->id,

                    ]
                );
                $bitacora->save();

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

                $bitacora = new BitacoraUsuario();
                $bitacora->fill(
                    [
                        'tipoCambio' => 'Aceptar',
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->idOrganizacion,
                        'descripcion' => 'Aceptacion de afiliacion id' . $solicitudAActualizar->id,

                    ]
                );
                $bitacora->save();
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

            if ($solicitud[0]->idEstadoSolicitud == 5) {
                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->fill(
                    [
                        'idEstadoSolicitud' => '4',
                        'idUsuario' => Auth::user()->id
                    ]
                );

                $solicitudAActualizar->save();
                $bitacora = new BitacoraUsuario();
                $bitacora->fill(
                    [
                        'tipoCambio' => 'ProcesoAfiliacion',
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->idOrganizacion,
                        'descripcion' => 'Afiliacion en proceso id' . $solicitudAActualizar->id,

                    ]
                );
                $bitacora->save();

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


    public function eliminar(Request $request)
    {
        $id = $request["id"];
        $solicitud = SolicitudRegistro::ofid($id)->get();
        try {
            $solicitud[0]->id;
        } catch (ErrorException $i) {
            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/home');
        }
        if ($solicitud[0]->idOrganizacion == Auth::user()->idOrganizacion) {

            $ordenesVigentes = Ordene::where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idCliente', '=', $solicitud[0]->idCliente)
                ->get();

            $ordenVigente = 0;


            foreach ($ordenesVigentes as $orden) {
                if ($orden->idEstadoOrden == 2) {
                    $ordenVigente = 1;
                } else if ($orden->idEstadoOrden == 5) {
                    $ordenVigente = 1;
                }
            }

            if ($ordenVigente == 1) {
                flash('Cliente aun tiene ordenes pendientes', 'danger');
                return redirect('/Afiliados');
            } else if ($solicitud[0]->idEstadoSolicitud == 2) {
                $solicitudAActualizar = SolicitudRegistro::find($id);

                $solicitudAActualizar->fill([
                    'idEstadoSolicitud' => '3'
                ]);
                $solicitudAActualizar->save();


                $data = [
                    'nombreCasa' => Auth::user()->Organizacion->nombre,
                    'accionAfiliacion' => 'Eliminada'
                ];
                $action = new Action();
                $action->sendEmail($data, $solicitud[0]->ClienteNSolicitud->UsuarioNC->email, 'Cancelación de Afiliacion', 'Cancelación de Afiliacion', 'emails.AfiliacionAceptada');
                $bitacora = new BitacoraUsuario();
                $bitacora->fill(
                    [
                        'tipoCambio' => 'Eliminacion',
                        'idUsuario' => Auth::user()->id,
                        'idOrganizacion' => Auth::user()->idOrganizacion,
                        'descripcion' => 'Eliminacion de afiliacion id' . $solicitudAActualizar->id,

                    ]
                );
                $bitacora->save();

                flash('Afiliado Eliminado ', 'success');
                return redirect('/Afiliados');

            } else {
                flash('Solicitud no pudo ser eliminado', 'danger');
                return redirect('/Afiliados');
            }

        } else {
            return redirect('/Afiliados');
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
            $solicitudAceptada = SolicitudRegistro::where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                ->where('idCliente', '=', $cliente[0]->id)->where('idEstadoSolicitud', '=', 2)->count();


            $clienteInfo = '';
            if ($solicitudAceptada == 0) {
                $solicitudN = SolicitudRegistro::where('idOrganizacion', '=', Auth::user()->idOrganizacion)
                    ->where('idCliente', '=', $cliente[0]->id)->first();
                $clienteInfo = 'El cliente ya estuvo afiliado en la casa';
            }

            \Session::remove('cliente');
            \Session::remove('clienteInfo');
            \Session::remove('solicitud');
            \Session::push('cliente', $cliente[0]);
            \Session::push('clienteInfo', $clienteInfo);
            \Session::push('solicitud', $solicitudAceptada);
            if (isset($solicitudN)) {
                \Session::push('solicitudN', $solicitudN);
            } else {

                Log::info('FDSDFSDF');
                \Session::remove('solicitudN');
            }
            

        } else {
            flash('No se encontró al cliente', 'warning');
            \Session::remove('solicitud');
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
                        $data = [
                            'nombreCasa' => Auth::user()->Organizacion->nombre,
                            'accionAfiliacion' => 'Aceptada'
                        ];
                        $action = new Action();
                        Log::info('Email de afiliado a Eliminar' . $cliente[0]->UsuarioNC->email);
                        $action->sendEmail($data, $cliente[0]->UsuarioNC->email, 'Afiliacion', ' Afiliacion', 'emails.AfiliacionAceptada');

                        flash('Cliente Afiliado Exitosamente', 'success');
                        return redirect('/Afiliados');
                    } else {
                        $buscarSolicitudPendiente[0]->fill([
                            'idEstadoSolicitud' => 2
                        ]);
                        $buscarSolicitudPendiente[0]->save();

                        $bitacora = new BitacoraUsuario();
                        $bitacora->fill(
                            [
                                'tipoCambio' => 'Afiliacion',
                                'idUsuario' => Auth::user()->id,
                                'idOrganizacion' => Auth::user()->idOrganizacion,
                                'descripcion' => 'Aceptacion de afiliacion id' . $buscarSolicitudPendiente[0]->id,

                            ]
                        );
                        $bitacora->save();
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

    public function AfiliacionesCanceladas()
    {

        $afiliaciones = SolicitudRegistro::where("idOrganizacion", Auth::user()->idOrganizacion)
            ->where("idEstadoSolicitud", 3)->get();

        return view('CasaCorredora.SolicitudesAfiliacion.AfiliacionesCanceladas', ["solicitudes" => $afiliaciones]);

    }


}
