<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cedeval;
use App\Models\Ordene;
use App\Models\Organizacion;
use App\Models\Usuario;
use App\Utilities\Action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class OrdenesAPI extends Controller
{


    public function getOrdenes($id)
    {

        try {

            $ordenes = Ordene::with("EstadoOrden", "MensajesN_Orden", "MensajesN_Orden.UsuarioMensaje",
                "Operaiones_ordenes", "Corredor_UsuarioN",
                "OrganizacionOrdenN", "CuentaCedeval")
                ->where("idCliente", $id)
                ->where("idEstadoOrden", "!=", 4)->get();

            if (count($ordenes) > 0) {
                foreach ($ordenes as $key => $orden) {
                    $arrOrden[$key]["id"] = $orden->id;
                    $arrOrden[$key]["correlativo"] = $orden->correlativo;
                    $arrOrden[$key]["FechaDeVigencia"] = Carbon::parse($orden->FechaDeVigencia)->format('m-d-Y');
                    $arrOrden[$key]["agente_corredor"] = $nombre = isset($orden->Corredor_UsuarioN->nombre) ? $orden->Corredor_UsuarioN->nombre . ' ' . $orden->Corredor_UsuarioN->apellido : null;
                    $arrOrden[$key]["Tipo_orden"] = $orden->idTipoOrden;
                    $arrOrden[$key]["idOrden"] = $orden->idOrden;
                    $arrOrden[$key]["estado_orden"] = $orden->idEstadoOrden;
                    $arrOrden[$key]["titulo"] = $orden->titulo;
                    $arrOrden[$key]["tipo_ejecucion"] = $orden->idTipoEjecucion;
                    $arrOrden[$key]["valor_minimo"] = $orden->valorMinimo;
                    $arrOrden[$key]["valor_maximo"] = $orden->valorMaximo;
                    $arrOrden[$key]["casa_corredora"] = $orden->OrganizacionOrdenN->nombre;
                    $arrOrden[$key]["fecha_creacion"] = Carbon::parse($orden->created_at)->format('m-d-Y');
                    $arrOrden[$key]["fecha_vigencia"] = Carbon::parse($orden->FechaDeVigencia)->format('m-d-Y');
                    $arrOrden[$key]["monto"] = $orden->monto;
                    $arrOrden[$key]["tasa_interes"] = $orden->tasaDeInteres;
                    $arrOrden[$key]["comision"] = $orden->comision;
                    $arrOrden[$key]["cuenta_cedeval"] = $orden->CuentaCedeval->cuenta;
                    $arrOrden[$key]["emisor"] = $orden->emisor;
                    $arrOrden[$key]["tipo_mercado"] = $orden->TipoMercado;
                    $mensajes = [];
                    foreach ($orden->MensajesN_Orden as $key2 => $mensaje) {
                        $mensajes[$key]["id"] = $mensaje->id;
                        $mensajes[$key]["id_Tipo"] = $mensaje->idTipoMensaje;
                        $mensajes[$key]["idUsuario"] = $mensaje->idUsuario;
                        $mensajes[$key]["nombre_usuario"] = $mensaje->UsuarioMensaje->nombre;
                        $mensajes[$key]["mensaje"] = $mensaje->contenido;

                    }
                    $arrOrden[$key]["mensajes"] = $mensajes;
                    $operaciones = [];
                    foreach ($orden->Operaiones_ordenes as $key3 => $operacion) {
                        $operaciones[$key]["id"] = $operacion->id;
                        $operaciones[$key]["monto"] = $operacion->monto;

                    }
                    $arrOrden[$key]["operaciones"] = $operaciones;


                }

                return response()->json(['ErrorCode' => '0', 'msg' => '', 'data' => $arrOrden]);

            } else {

                return response()->json(['ErrorCode' => '4', 'msg' => 'No hay datos']);
            }


        } catch (Exception $e) {
            return response()->json(['ErrorCode' => '2', 'msg' => 'Error en ejecucion de servicio']);

        }

    }

    public function getOrdenesPadre($id, $idCliente)
    {

        try {

            $ordenes = Ordene::with("EstadoOrden", "MensajesN_Orden", "MensajesN_Orden.UsuarioMensaje",
                "Operaiones_ordenes", "Corredor_UsuarioN",
                "OrganizacionOrdenN", "CuentaCedeval")
                ->where("idOrden", $id)
                ->orWhere("id", $id)
                ->where("idCliente", $idCliente)
                ->orderBy("created_at", 'DESC')
                ->get();
            if (count($ordenes) > 0) {
                foreach ($ordenes as $key => $orden) {
                    $arrOrden[$key]["id"] = $orden->id;
                    $arrOrden[$key]["correlativo"] = $orden->correlativo;
                    $arrOrden[$key]["FechaDeVigencia"] = Carbon::parse($orden->FechaDeVigencia)->format('m-d-Y');
                    $arrOrden[$key]["agente_corredor"] = $nombre = isset($orden->Corredor_UsuarioN->nombre) ? $orden->Corredor_UsuarioN->nombre . ' ' . $orden->Corredor_UsuarioN->apellido : null;
                    $arrOrden[$key]["Tipo_orden"] = $orden->idTipoOrden;
                    $arrOrden[$key]["idOrden"] = $orden->idOrden;
                    $arrOrden[$key]["estado_orden"] = $orden->idEstadoOrden;
                    $arrOrden[$key]["titulo"] = $orden->titulo;
                    $arrOrden[$key]["tipo_ejecucion"] = $orden->idTipoEjecucion;
                    $arrOrden[$key]["valor_minimo"] = $orden->valorMinimo;
                    $arrOrden[$key]["valor_maximo"] = $orden->valorMaximo;
                    $arrOrden[$key]["casa_corredora"] = $orden->OrganizacionOrdenN->nombre;
                    $arrOrden[$key]["fecha_creacion"] = Carbon::parse($orden->created_at)->format('m-d-Y');
                    $arrOrden[$key]["monto"] = $orden->monto;
                    $arrOrden[$key]["tasa_interes"] = $orden->tasaDeInteres;
                    $arrOrden[$key]["comision"] = $orden->comision;
                    $arrOrden[$key]["cuenta_cedeval"] = $orden->CuentaCedeval->cuenta;
                    $arrOrden[$key]["emisor"] = $orden->emisor;
                    $arrOrden[$key]["tipo_mercado"] = $orden->TipoMercado;
                    $mensajes = [];
                    foreach ($orden->MensajesN_Orden as $key2 => $mensaje) {
                        $mensajes[$key]["id"] = $mensaje->id;
                        $mensajes[$key]["id_Tipo"] = $mensaje->idTipoMensaje;
                        $mensajes[$key]["idUsuario"] = $mensaje->idUsuario;
                        $mensajes[$key]["nombre_usuario"] = $mensaje->UsuarioMensaje->nombre;
                        $mensajes[$key]["mensaje"] = $mensaje->contenido;

                    }
                    $arrOrden[$key]["mensajes"] = $mensajes;
                    $operaciones = [];
                    foreach ($orden->Operaiones_ordenes as $key3 => $operacion) {
                        $operaciones[$key]["id"] = $operacion->id;
                        $operaciones[$key]["monto"] = $operacion->monto;

                    }
                    $arrOrden[$key]["operaciones"] = $operaciones;


                }

                return response()->json(['ErrorCode' => '0', 'msg' => '', 'data' => $arrOrden]);

            }

        } catch (Exception $e) {
            return response()->json(['ErrorCode' => '2', 'msg' => 'Error en ejecucion de servicio']);

        }

    }

    public function makeOrder(Request $request)
    {
        try {
            $rules = [
                'cuentacedeval' => 'required|integer',
                'casacorredora' => 'required',
                'nombreCliente' => 'required',
                'idCliente' => 'required|numeric',
                'tipodeorden' => 'required|numeric|integer',
                'mercado' => 'required',
                'titulo' => 'required',
                'emisor' => 'required',
                'valorMinimo' => 'required|numeric|min:1',
                'valorMaximo' => 'required|numeric|min:1',
                'monto' => 'required|numeric|min:1',
                'FechaDeVigencia' => 'required|date',
                'tasaDeInteres' => 'required|numeric|min:0',

            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['ErrorCode' => '5', 'msg' => $validator->errors()->all(),]);
            } else {
                if ($request['valorMinimo'] <= 0) {
                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor minimo  debe ser mayor a cero',]);
                } else if ($request['valorMaximo'] <= 0) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor máximo  debe ser mayor a cero',]);

                } else if ($request['valorMinimo'] > $request['valorMaximo']) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor minimo no debe ser mayor al maximo',]);

                } else if ($request['valorMinimo'] >= $request['monto']) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor minimo no debe ser mayor al monto',]);

                } else if ($request['valorMaximo'] >= $request['monto']) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor máximo no debe ser mayor al monto',]);

                } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) < 2) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'La fecha de vigencia no debe ser menor a 2 días',]);

                } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) > 60) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'La fecha de vigencia no debe ser mayor a 2 meses',]);

                } else {
                    $result = DB::statement('call NuevaOrden(?,?,?,?,?,?,?,?,?,?,?,?)',
                        array($request['idCliente'],
                            Carbon::parse($request['FechaDeVigencia'])->format('Y-m-d'),
                            $request['tipodeorden'],
                            $request['titulo'],
                            number_format((float)$request['valorMinimo'], 2, '.', ''),
                            $request['casacorredora'],
                            number_format((float)$request['valorMaximo'], 2, '.', ''),
                            number_format((float)$request['monto'], 2, '.', ''),
                            $request['cuentacedeval'],
                            $request['emisor'],
                            $request['mercado'],
                            $request['tasaDeInteres'])
                    );

                    $idrol = 3;
                    $usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                        $query->where('idRol', $idrol);
                    })->where("idOrganizacion", $request["casacorredora"])->get();
                    $emails = [];
                    $i = 0;
                    foreach ($usuarios as $user) {
                        $emails[$i] = $user->email;
                        $i++;
                    }

                    $data = [
                        'titulo' => 'El cliente ' . $request["nombreCliente"] . ' ha realizado una orden de inversión',
                    ];
                    $action = new Action();
                    $action->sendEmail($data, $emails, 'Nueva orden de inversión', 'Nueva orden de inversión', 'emails.OrdenEmail');

                    return response()->json(['ErrorCode' => '0', 'msg' => 'Orden generada con exito',]);
                }
            }
        } catch (\Exception $e) {

            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al realizar la orden']);
        }

    }

    public function ModifyOrder(Request $request)
    {
        try {

            $rules = [
                'cuentacedeval' => 'required|integer',
                'idOrden' => 'required|numeric',
                'idCliente' => 'required|numeric',
                'nombreCliente' => 'required',
                'apellidoCliente' => 'required',
                'tipodeorden' => 'required|numeric|integer',
                'mercado' => 'required',
                'titulo' => 'required',
                'emisor' => 'required',
                'valorMinimo' => 'required|numeric|min:1',
                'valorMaximo' => 'required|numeric|min:1',
                'monto' => 'required|numeric|min:0',
                'FechaDeVigencia' => 'required|date',
                'tasaDeInteres' => 'required|numeric|min:0',

            ];

            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['ErrorCode' => '5', 'msg' => $validator->errors()->all(),]);
            } else {
                if ($request['valorMinimo'] <= 0) {
                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor minimo  debe ser mayor a cero',]);
                } else if ($request['valorMaximo'] <= 0) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor máximo  debe ser mayor a cero',]);

                } else if ($request['valorMinimo'] > $request['valorMaximo']) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor minimo no debe ser mayor al maximo',]);

                } else if ($request['valorMinimo'] >= $request['monto']) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor minimo no debe ser mayor al monto',]);

                } else if ($request['valorMaximo'] >= $request['monto']) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'El valor máximo no debe ser mayor al monto',]);

                } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) < 2) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'La fecha de vigencia no debe ser menor a 2 días',]);

                } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) > 60) {

                    return response()->json(['ErrorCode' => '4', 'msg' => 'La fecha de vigencia no debe ser mayor a 2 meses',]);

                } else {

                    $idCliente = $request["idCliente"];
                    $orden = Ordene::where("id", $request["idOrden"])
                        ->where("idCliente", $idCliente)
                        ->whereIn("idEstadoOrden", [1, 2])->first();
                    $idOrden = $orden->idOrden ? $orden->idOrden : $orden->id;
                    $idor = $orden->idOrden ? "idOrden" : "id";
                    $count = Ordene::where($idor, $idOrden)->count() + 1;
                    $correlativoPadre = DB::table('ordenes')->where('id', $idOrden)->value('correlativo');
                    Log::info($count);
                    $correlativo = $correlativoPadre . '-' . $count;
                    $nuevaOrden = new Ordene();
                    $nuevaOrden->fill(
                        [
                            'correlativo' => $correlativo,
                            'idCliente' => $idCliente,
                            'FechaDeVigencia' => Carbon::parse($request['FechaDeVigencia'])->format('Y-m-d'),
                            'idCorredor' => $orden->idCorredor,
                            'idTipoOrden' => $request["tipodeorden"],
                            'titulo' => $request['titulo'],
                            'idEstadoOrden' => 1,
                            'valorMinimo' => number_format((float)$request['valorMinimo'], 2, '.', ''),
                            'idOrganizacion' => $orden->idOrganizacion,
                            'valorMaximo' => number_format((float)$request['valorMaximo'], 2, '.', ''),
                            'idOrden' => $idOrden,
                            'monto' => number_format((float)$request['monto'], 2, '.', ''),
                            'idCuentaCedeval' => $request['cuentacedeval'],
                            'emisor' => $request['emisor'],
                            'TipoMercado' => $request['mercado'],
                            'tasaDeInteres' => $request['tasaDeInteres'],
                            'idTipoEjecucion' => $orden->idTipoEjecucion,

                        ]
                    );
                    $nuevaOrden->save();


                    $orden->fill(
                        [
                            'idEstadoOrden' => 4,

                        ]
                    );
                    $orden->save();
                    $idrol = 3;
                    $usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                        $query->where('idRol', $idrol);
                    })->where("idOrganizacion", $request["casacorredora"])->get();
                    $emails = [];
                    $i = 0;
                    $band = false;
                    foreach ($usuarios as $user) {
                        if ($orden->Corredor_UsuarioN->email == $user->email) {

                            $band = true;
                        }
                        $emails[$i] = $user->email;
                        $i++;
                    }
                    if (!$band) {
                        $i++;
                        if ($orden->Corredor_UsuarioN) {
                            $emails[$i] = $orden->Corredor_UsuarioN->email;
                        }

                    }


                    $data = [
                        'titulo' => 'El cliente ' . $request["nombreCliente"] . ' ' . $request["apellidoCliente"] . ' ha modificado una orden de inversión, con el correlativo ' . $nuevaOrden->correlativo,
                    ];
                    $action = new Action();
                    $action->sendEmail($data, $emails, 'Modificación de orden de inversión', 'Modificación de orden de inversión', 'emails.OrdenEmail');

                    return response()->json(['ErrorCode' => '0', 'msg' => 'Orden modificada con exito',]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al modificar la orden']);
        }

    }

    public function CancelOrder(Request $request)
    {
        try {
            $rules = [
                'motivo' => 'required',
                'idCliente' => 'required|number',
                'idOrden' => 'required|number',
                'idUsuario' => 'required|number',
                'nombreCliente' => 'required',
                'apellidoCliente' => 'required',

            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['ErrorCode' => '5', 'msg' => $validator->errors()->all(),]);
            } else {
                $idCliente = $request["idCliente"];
                $orden = Ordene::where("id", $request["idOrden"])
                    ->where("idCliente", $idCliente)
                    ->where("idEstadoOrden", "=", 2)
                    ->first();

                $orden->fill(
                    [
                        'idEstadoOrden' => 3,

                    ]
                );
                $orden->save();
                $mensajes = new Mensaje();
                $mensajes->fill(
                    [
                        'idTipoMensaje' => 2,
                        'idOrden' => $orden->id,
                        'idUsuario' => $request["idUsuario"],
                        'contenido' => $request["motivo"],

                    ]
                );
                $mensajes->save();
                $idrol = 3;
                $usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                    $query->where('idRol', $idrol);
                })->where("idOrganizacion", $request["casacorredora"])->get();
                $emails = [];
                $i = 0;
                $band = false;
                foreach ($usuarios as $user) {
                    if ($orden->Corredor_UsuarioN->email == $user->email) {

                        $band = true;
                    }
                    $emails[$i] = $user->email;
                    $i++;
                }
                if (!$band) {
                    $i++;
                    $emails[$i] = $orden->Corredor_UsuarioN->email;
                }


                $data = [
                    'titulo' => 'El cliente ' . $request["nombreCliente"] . ' ' . $request["apellidoCliente"] . ' ha cancelado una orden de inversión, con el correlativo ' . $orden->correlativo,
                ];
                $action = new Action();
                $action->sendEmail($data, $emails, 'Cancelación de orden', 'Cancelación de orden', 'emails.OrdenEmail');
                return response()->json(['ErrorCode' => '0', 'msg' => 'Orden cancelada con exito',]);
            }
        } catch (\Exception $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al cancelar la orden']);

        }


    }

    public function ExecuteOrder(Request $request)
    {
        try {
            $rules = [
                'idCliente' => 'required|number',
                'idOrden' => 'required|number',
                'nombreCliente' => 'required',
                'apellidoCliente' => 'required',

            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['ErrorCode' => '5', 'msg' => $validator->errors()->all(),]);
            } else {
                $idCliente = $request['idCliente'];
                $orden = Ordene::where("id", $request['idOrden'])
                    ->where("idCliente", $idCliente)
                    ->where("idEstadoOrden", "=", 2)
                    ->first();

                $orden->fill(
                    [
                        'idEstadoOrden' => 5,

                    ]
                );
                $orden->save();
                $idrol = 3;
                $usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                    $query->where('idRol', $idrol);
                })->where("idOrganizacion", $request["casacorredora"])->get();
                $emails = [];
                $i = 0;
                $band = false;
                foreach ($usuarios as $user) {
                    if ($orden->Corredor_UsuarioN->email == $user->email) {

                        $band = true;
                    }
                    $emails[$i] = $user->email;
                    $i++;
                }
                if (!$band) {
                    $i++;
                    $emails[$i] = $orden->Corredor_UsuarioN->email;
                }


                $data = [
                    'titulo' => 'El cliente ' . $request["nombreCliente"] . ' ' . $request["apellidoCliente"] . ' ha ejecutado una orden de inversión, con el correlativo ' . $orden->correlativo,
                ];
                $action = new Action();
                $action->sendEmail($data, $emails, 'Ejecución de orden', 'Ejecución de orden', 'emails.OrdenEmail');
                return response()->json(['ErrorCode' => '0', 'msg' => 'Orden ejecutada con exito',]);

            }
        } catch (\Exception $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al ejecutar la orden']);
        }

    }

    public function makeMessage(Request $request)
    {
        try {
            $rules = [
                'idUsuario' => 'required|number',
                'idOrden' => 'required|number',
                'nombreCliente' => 'required',
                'apellidoCliente' => 'required',
                'comentario' => 'required',


            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['ErrorCode' => '5', 'msg' => $validator->errors()->all(),]);
            } else {
                $idOrden = $request["idOrden"];
                $mensaje = new Mensaje();
                $mensaje->fill(
                    [
                        'idOrden' => $idOrden,
                        'idTipoMensaje' => 1,
                        'idUsuario' => $request['idUsuario'],
                        'contenido' => $request['comentario'],

                    ]
                );
                $mensaje->save();
                $emails = [];
                $i = 0;
                $band = false;


                $data = [
                    'titulo' => 'El cliente ' . $request["nombreCliente"] . ' ' . $request["apellidoCliente"] . 'Ha enviado un nuevo mensaje',
                ];
                $action = new Action();
                $action->sendEmail($data, $emails, 'Mensaje', 'Nuevo mensaje de cliente', 'emails.OrdenEmail');
                return response()->json(['ErrorCode' => '0', 'msg' => 'Mensaje realizado con exito']);

            }
        } catch (\Exception $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al crear el mensaje']);
        }


    }

    public function getCasasAfiliado($idCliente)
    {

        try {
            //OBTENIENDO LAS ORGNANZACIONES DONDE ESTA AFILIADO UN CLIENTE
            $casas = Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
                $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 2);
            })->select('id', 'nombre')->get();

            if (count($casas) > 0) {
                return response()->json(['ErrorCode' => '0', 'data' => $casas]);
            } else {
                return response()->json(['ErrorCode' => '2', 'msg' => 'No hay datos']);
            }
        } catch (\Exception $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al crear el mensaje']);


        }


    }

    public function getCedevales($idCliente)
    {
        try {
            $cedevales = Cedeval::where("idCliente", $idCliente)->select('id', 'cuenta')->get();
            if (count($cedevales) > 0) {

                return response()->json(['ErrorCode' => '0', 'data' => $cedevales]);
            } else {
                return response()->json(['ErrorCode' => '2', 'msg' => 'No hay datos']);
            }
        } catch (\Exception $e) {
            return response()->json(['ErrorCode' => '3', 'msg' => 'Ocurrio un problema al crear el mensaje']);
        }

    }

    public function getOrdenesByCasa($idCliente, $idCasa)
    {
        try {

            $ordenes = Ordene::with("EstadoOrden", "MensajesN_Orden", "MensajesN_Orden.UsuarioMensaje",
                "Operaiones_ordenes", "Corredor_UsuarioN",
                "OrganizacionOrdenN", "CuentaCedeval")
                ->where("idCliente", $idCliente)
                ->where("idOrganizacion", $idCasa)
                ->where("idEstadoOrden", "!=", 4)->get();

            if (count($ordenes) > 0) {
                foreach ($ordenes as $key => $orden) {
                    $arrOrden[$key]["id"] = $orden->id;
                    $arrOrden[$key]["correlativo"] = $orden->correlativo;
                    $arrOrden[$key]["FechaDeVigencia"] = Carbon::parse($orden->FechaDeVigencia)->format('m-d-Y');
                    $arrOrden[$key]["agente_corredor"] = $nombre = isset($orden->Corredor_UsuarioN->nombre) ? $orden->Corredor_UsuarioN->nombre . ' ' . $orden->Corredor_UsuarioN->apellido : null;
                    $arrOrden[$key]["Tipo_orden"] = $orden->idTipoOrden;
                    $arrOrden[$key]["idOrden"] = $orden->idOrden;
                    $arrOrden[$key]["estado_orden"] = $orden->idEstadoOrden;
                    $arrOrden[$key]["titulo"] = $orden->titulo;
                    $arrOrden[$key]["tipo_ejecucion"] = $orden->idTipoEjecucion;
                    $arrOrden[$key]["valor_maximo"] = $orden->valorMaximo;
                    $arrOrden[$key]["valor_minimo"] = $orden->valorMinimo;
                    $arrOrden[$key]["casa_corredora"] = $orden->OrganizacionOrdenN->nombre;
                    $arrOrden[$key]["fecha_creacion"] = Carbon::parse($orden->created_at)->format('m-d-Y');
                    $arrOrden[$key]["monto"] = $orden->monto;
                    $arrOrden[$key]["tasa_interes"] = $orden->tasaDeInteres;
                    $arrOrden[$key]["comision"] = $orden->comision;
                    $arrOrden[$key]["cuenta_cedeval"] = $orden->CuentaCedeval->cuenta;
                    $arrOrden[$key]["emisor"] = $orden->emisor;
                    $arrOrden[$key]["tipo_mercado"] = $orden->TipoMercado;
                    $mensajes = [];
                    foreach ($orden->MensajesN_Orden as $key2 => $mensaje) {
                        $mensajes[$key]["id"] = $mensaje->id;
                        $mensajes[$key]["id_Tipo"] = $mensaje->idTipoMensaje;
                        $mensajes[$key]["idUsuario"] = $mensaje->idUsuario;
                        $mensajes[$key]["nombre_usuario"] = $mensaje->UsuarioMensaje->nombre;
                        $mensajes[$key]["mensaje"] = $mensaje->contenido;

                    }
                    $arrOrden[$key]["mensajes"] = $mensajes;
                    $operaciones = [];
                    foreach ($orden->Operaiones_ordenes as $key3 => $operacion) {
                        $operaciones[$key]["id"] = $operacion->id;
                        $operaciones[$key]["monto"] = $operacion->monto;

                    }
                    $arrOrden[$key]["operaciones"] = $operaciones;


                }

                return response()->json(['ErrorCode' => '0', 'msg' => '', 'data' => $arrOrden]);

            } else {

                return response()->json(['ErrorCode' => '4', 'msg' => 'No hay datos']);
            }


        } catch (Exception $e) {
            return response()->json(['ErrorCode' => '2', 'msg' => 'Error en ejecucion de servicio']);

        }

    }


}
