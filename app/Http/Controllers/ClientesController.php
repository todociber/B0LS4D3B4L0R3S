<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Cedeval;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Direccione;
use App\Models\EstadoOrden;
use App\Models\Mensaje;
use App\Models\Municipio;
use App\Models\Ordene;
use App\Models\Organizacion;
use App\Models\SolicitudRegistro;
use App\Models\Telefono;
use App\Models\TipoOrden;
use App\Models\Usuario;
use App\Utilities\Action;
use Carbon\Carbon;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;

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

    //RETORNA VISTA DE ORDEN
    public function NuevaOrden()
    {

        $count = SolicitudRegistro::where("idCliente", Auth::user()->ClienteN->id)->where("idEstadoSolicitud", 2)->count();
        if ($count > 0) {
            $client = new GuzzleHttp\Client();
            $res = $client->request('GET', 'http://e60e591e.ngrok.io/GetTitulos');
            $bodyJ = $res->getBody();
            $body = json_decode($bodyJ);
            Log::info($body->Titulos);
            if ($body->errorCode == 0) {
                $titulos = $body->Titulos;


                $idCliente = Auth::user()->ClienteN->id;
                $cedeval = Cedeval::where('idCliente', $idCliente)->lists('cuenta', 'id');
                //OBTENIENDO LAS ORGNANZACIONES DONDE ESTA AFILIADO UN CLIENTE
                $casas = Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
                    $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 2);
                })->lists('nombre', 'id');
                $tipoOrden = TipoOrden::lists('nombre', 'id');

                return View('Clientes.Ordenes.NuevaOrden', ['cedeval' => $cedeval, 'casas' => $casas, 'Tipoorden' => $tipoOrden, 'titulos' => $titulos]);
            } else {
                return redirect()->back();
            }
        } else {

            return redirect()->back();
        }
    }

    public function getEmisor($id)
    {
        try {

            $client = new GuzzleHttp\Client();
            $res = $client->request('GET', "http://e60e591e.ngrok.io//GetEmisores/$id/titulo");
            $bodyJ = $res->getBody();
            $body = json_decode($bodyJ);

            return response()->json(["error" => 0, "datos" => $body], 200);

        } catch (Exception $e) {
            return response()->json(["error" => 1, "datos" => $body], 200);

        }

    }

    //LISTADO DE ORDENES SIN IMPORTAR ESTADO
    public function ListadoOrdenes()
    {

        $count = SolicitudRegistro::where("idCliente", Auth::user()->ClienteN->id)->where("idEstadoSolicitud", 2)->count();
        Log::info($count);
        if ($count > 0) {
            $idCliente = Auth::user()->ClienteN->id;

            $ordenes = Ordene::orderBy('FechaDevigencia', 'desc')->with('TipoOrdenN')->where('idCliente', $idCliente)->where("idEstadoOrden", 1)->get();
            $estadoOrdenes = EstadoOrden::lists('estado', 'id');

            return View('Clientes.Ordenes.ListaOrdenesCliente', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes]);
        } else {

            return redirect()->back();
        }
    }


    //DETALLE DE ORDEN POR ID
    public function OrdenesByID($id)
    {
        try {
            \Session::put('idOrden', $id);
            $orden = Ordene::orderBy('FechaDevigencia', 'desc')->where('id', $id)->where('idCliente', Auth::user()->ClienteN->id)->first();
            if (count($orden) > 0) {

                $motivoCancel = '';
                if ($orden->idEstadoOrden == 8) {

                    $motivoCancel = Mensaje::where("idOrden", $orden->id)->where("idTipoMensaje", 2)->first();

                }
                // var_dump($orden);
                // $timestamp = Carbon::parse($orden->created_at)->timestamp;
                $ordenDate = $orden->created_at->format('m-d-Y'); //date('m-d-Y',Carbon::createFromFormat('Y-d-m H:i:s', $orden->created_at)->timestamp);
                return view('Clientes.Ordenes.DetalleOrden', ['orden' => $orden, 'ordenDate' => $ordenDate, 'motivoCancel' => $motivoCancel]);
            } else {

                return redirect()->route('listadoordenesclienteV');
            }
        } catch (Exception $e) {


        }


    }

    public function ordenesbyEstado(Request $request)
    {

        try {

            $idCliente = Auth::user()->ClienteN->id;
            $ordenes = Ordene::with('TipoOrdenN')->where('idCliente', $idCliente)->where('idEstadoOrden', $request['estado'])->get();
            $mensaje = '';
            $estadoOrdenes = EstadoOrden::lists('estado', 'id');
            return View('Clientes.Ordenes.ListaOrdenesCliente', ['ordenes' => $ordenes, 'estadoOrdenes' => $estadoOrdenes, 'selected' => $request['estado']]);
        } catch (Exception $e) {

            flash('Hubo un problema al filtrar las ordenes', 'danger');
            return redirect()->route('listadoordenesclienteV');

        }


    }


    //GUARDAR MENSAJES
    function storeMensajes(Request $request)
    {
        try {
            $this->validate($request, [
                'Comentario' => 'required',

            ]);
            $idOrden = \Session::get('idOrden');
            $mensaje = new Mensaje();
            $mensaje->fill(
                [
                    'idOrden' => $idOrden,
                    'idTipoMensaje' => 1,
                    'idUsuario' => Auth::user()->id,
                    'contenido' => $request['Comentario'],

                ]
            );
            $mensaje->save();
            $emails = [];
            $i = 0;
            $band = false;
        

            $data = [
                'titulo' => 'El cliente ' . Auth::user()->nombre . ' ' . Auth::user()->apellido . 'Ha enviado un nuevo mensaje',
            ];
            $action = new Action();
            $action->sendEmail($data, $emails, 'Mensaje', 'Nuevo mensaje de cliente', 'emails.OrdenEmail');
            flash('Mensaje agregado con exito', 'success');
            return redirect()->route('getOrdenes', ['id' => $idOrden]);
        } catch (Exception $e) {

            flash('Ocurrio un error al agregar un comentario', 'danger');
            return redirect()->route('getOrdenes', ['id' => $idOrden]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //GUARDANDO ORDENES
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'cuentacedeval' => 'required|integer',
                'casacorredora' => 'required',
                'tipodeorden' => 'required|numeric|integer',
                'mercado' => 'required',
                'titulo' => 'required',
                'emisor' => 'required',
                'valorMinimo' => 'required|numeric|min:1',
                'valorMaximo' => 'required|numeric|min:1',
                'monto' => 'required|numeric|min:1',
                'FechaDeVigencia' => 'required|date',
                'tasaDeInteres' => 'required|numeric|min:0',

            ]);

            if ($request['valorMinimo'] <= 0) {
                flash('El valor minimo  debe ser mayor a cero', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMaximo'] <= 0) {

                flash('El valor máximo  debe ser mayor a cero', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMinimo'] > $request['valorMaximo']) {

                flash('El valor minimo no debe ser mayor al maximo', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMinimo'] >= $request['monto']) {

                flash('El valor minimo no debe ser mayor al monto', 'info');
                return redirect()->route('nuevaOrden');
            } else if ($request['valorMaximo'] >= $request['monto']) {

                flash('El valor máximo no debe ser mayor al monto', 'info');
                return redirect()->route('nuevaOrden');
            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) < 2) {


                flash('La fecha de vigencia no debe ser menor a 2 días', 'info');

                return redirect()->route('nuevaOrden');
            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) > 60) {

                flash('La fecha de vigencia no debe ser mayor a 2 meses', 'info');
                return redirect()->route('nuevaOrden');
            } else {
                $result = DB::statement('call NuevaOrden(?,?,?,?,?,?,?,?,?,?,?,?)',
                    array(Auth::user()->ClienteN->id,
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
                    'titulo' => 'El cliente ' . Auth::user()->nombre . ' ha realizado una orden de inversión',
                ];
                $action = new Action();
                $action->sendEmail($data, $emails, 'Nueva orden de inversión', 'Nueva orden de inversión', 'emails.OrdenEmail');
                
                flash('Orden generada con exito', 'success');
                return redirect()->route('listadoordenesclienteV');
            }
        } catch (Exception $e) {

            flash('Ocurrior un error al procesar la orden', 'danger');
            return redirect()->route('nuevaOrden');
        }


    }


    //RETORNA VISTA PARA MODIFCAR ORDENES
    public function modificarOrden($id)
    {


        $idCliente = Auth::user()->ClienteN->id;
        $orden = Ordene::where("id", $id)
            ->where("idCliente", $idCliente)
            ->whereIn("idEstadoOrden", [1, 2])->first();

        if (count($orden) > 0) {
            $client = new GuzzleHttp\Client();
            $res = $client->request('GET', 'http://e60e591e.ngrok.io/GetTitulos');
            $bodyJ = $res->getBody();
            $body = json_decode($bodyJ);
            Log::info($body->Titulos);
            if ($body->errorCode == 0) {
                $titulos = $body->Titulos;
                $fechaVigencia = Carbon::parse($orden->FechaDeVigencia)->format('m/d/Y');
                $orden->FechaDeVigencia = $fechaVigencia;
                $cedeval = Cedeval::where('idCliente', $idCliente)->lists('cuenta', 'id');
                //OBTENIENDO LAS ORGNANZACIONES DONDE ESTA AFILIADO UN CLIENTE
                $casas = Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
                    $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 2);
                })->lists('nombre', 'id');
                $tipoOrden = TipoOrden::lists('nombre', 'id');
                return view('Clientes.Ordenes.ModificarOrden', ['orden' => $orden, 'cedeval' => $cedeval, 'casas' => $casas, 'Tipoorden' => $tipoOrden, 'titulos' => $titulos]);

            }
        } else {
            return redirect()->route('ListadoOrdenesV');

        }


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

    public function AnularOrden(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'motivo' => 'required',

            ]);
            $idCliente = Auth::user()->ClienteN->id;
            $orden = Ordene::where("id", $id)
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
                    'idUsuario' => Auth::user()->id,
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
                'titulo' => 'El cliente ' . Auth::user()->nombre . ' ha cancelado una orden de inversión, con el correlativo ' . $orden->correlativo,
            ];
            $action = new Action();
            $action->sendEmail($data, $emails, 'Cancelación de orden', 'Cancelación de orden', 'emails.OrdenEmail');
            flash('Orden anulada con exito', 'success');
            return redirect()->route('listadoordenesclienteV');
        } catch (Exception $e) {
            flash('Ocurrior un error al anular la orden', 'danger');
            return redirect()->route('getOrdenes', ['id' => $orden->id]);
        }


    }

    public function ejecutarOrden(Request $request)
    {

        try {
            $this->validate($request, [
                'id' => 'required',

            ]);

            $idCliente = Auth::user()->ClienteN->id;
            $orden = Ordene::where("id", $request['id'])
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
                'titulo' => 'El cliente ' . Auth::user()->nombre . ' ha ejecutado una orden de inversión, con el correlativo ' . $orden->correlativo,
            ];
            $action = new Action();
            $action->sendEmail($data, $emails, 'Ejecución de orden', 'Ejecución de orden', 'emails.OrdenEmail');
            flash('Orden ejecutada con exito', 'success');
            return redirect()->route('getOrdenes', ["id" => $request["id"]]);

        } catch (Exception $e) {
            flash('Ocurrio un problema al ejecutar la orden', 'success');
            return redirect()->route('getOrdenes', ["id" => $request["id"]]);
        }

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
        try {

            $this->validate($request, [
                'cuentacedeval' => 'required|integer',
                'tipodeorden' => 'required|numeric|integer',
                'mercado' => 'required',
                'titulo' => 'required',
                'emisor' => 'required',
                'valorMinimo' => 'required|numeric|min:1',
                'valorMaximo' => 'required|numeric|min:1',
                'monto' => 'required|numeric|min:0',
                'FechaDeVigencia' => 'required|date',
                'tasaDeInteres' => 'required|numeric|min:0',

            ]);

            if ($request['valorMinimo'] <= 0) {
                flash('El valor minimo  debe ser mayor a cero', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMaximo'] <= 0) {

                flash('El valor máximo  debe ser mayor a cero', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMinimo'] > $request['valorMaximo']) {

                flash('El valor minimo no debe ser mayor al maximo', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMinimo'] >= $request['monto']) {

                flash('El valor minimo no debe ser mayor al monto', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else if ($request['valorMaximo'] >= $request['monto']) {
                // Log::info((int)Carbon::parse($request['FechaDeVigencia'])->diffInDays(Carbon::now(),false));
                flash('El valor máximo no debe ser mayor al monto', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);

            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) < 2) {

                /**/
                flash('La fecha de vigencia no debe ser menor a 2 días', 'info');

                return redirect()->route('modificarorden', ["id" => $id]);
            } else if (Carbon::now()->diffInDays(Carbon::parse($request['FechaDeVigencia']), false) > 60) {

                flash('La fecha de vigencia no debe ser mayor a 2 meses', 'info');
                return redirect()->route('modificarorden', ["id" => $id]);
            } else {

                $idCliente = Auth::user()->ClienteN->id;
                $orden = Ordene::where("id", $id)
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
                    'titulo' => 'El cliente ' . Auth::user()->nombre . ' ' . Auth::user()->apellido . ' ha modificado una orden de inversión, con el correlativo ' . $nuevaOrden->correlativo,
                ];
                $action = new Action();
                $action->sendEmail($data, $emails, 'Modificación de orden de inversión', 'Modificación de orden de inversión', 'emails.OrdenEmail');

                flash('Orden modificada con exito', 'success');
                return redirect()->route('listadoordenesclienteV');
            }
        } catch (Exception $e) {
            flash('Ocurrior un error al modificar la orden', 'danger');
            return redirect()->route('modificarorden');
        }
    }


    public function miPerfilUsuario()
    {


        return view('Clientes.Perfil.PerfilUsuario', ['user' => Auth::user()]);

    }

    public function modificarPerfil()
    {
        $idCliente = Auth::user()->ClienteN->id;
        $departamentos = Departamento::orderBy('nombre', 'ASC')->lists('nombre', 'id');
        $telefonos = Telefono::with('TipoTelefonoN')->where('idCliente', $idCliente)->get();
        $direcciones = Direccione::with('MunicipioDireccion', 'MunicipioDireccion.Departamento')->where('id', $idCliente)->get();
        $municipios = Municipio::where('id_departamento', $direcciones[0]->MunicipioDireccion->Departamento->id)->lists('nombre', 'id');
        $telefonoCasa = '';
        $telefonoCelular = '';
        foreach ($telefonos as $telefono) {

            if ($telefono->TipoTelefonoN->id == 1) {

                $telefonoCasa = $telefono->numero;

            } else {

                $telefonoCelular = $telefono->numero;
            }


        }
        return view('Clientes.Perfil.modificarPerfil', ['user' => Auth::user(), 'departamentos' => $departamentos, 'numeroCasa' => $telefonoCasa, 'numeroCelular' => $telefonoCelular, 'direccion' => $direcciones[0], 'municipios' => $municipios]);


    }

    public function modificarPerfilCliente(Request $request)
    {
        try {
            $this->validate($request, [
                'nombre' => 'required',
                'apellido' => 'required',
                'dui' => 'required|numeric|digits:9|min:0',
                'nit' => 'required|numeric|digits:14|min:0',
                'fechaDeNacimiento' => 'required|date',
                'numeroCasa' => 'required|numeric|digits:8|min:0',
                'numeroCelular' => 'required|numeric|digits:8|min:0',
                'departamento' => 'required',
                'municipio' => 'required',
                'direccion' => 'required',
                'email' => 'required|email',
            ]);

            $usuario = Auth::user();
            $clientes = $usuario->ClienteN;

            $countDui = Cliente::where('dui', $request['dui'])->where('id', '!=', $clientes->id)->count();
            $countNIT = Cliente::where('nit', $request['nit'])->where('id', '!=', $clientes->id)->count();
            $countEmail = Usuario::where('email', $request['email'])->where('id', '!=', $usuario->id)->count();
            $countOrdenes = Ordene::where('idCliente', $clientes->id)->whereIn("idEstadoOrden", [1, 2, 5])->count();
            if ($countDui > 0) {

                flash('El DUI ingresado ya pertenece a un usuario', 'danger');
                return redirect()->route('modificarperfilCliente');

            } else if ($countNIT > 0) {

                flash('El NIT ingresado ya pertenece a un usuario', 'danger');
                return redirect()->route('modificarperfilCliente');

            } else if ($countEmail > 0) {

                flash('El email ingresado ya pertenece a un usuario', 'danger');
                return redirect()->route('modificarperfilCliente');

            } else if (Carbon::parse($request['fechaDeNacimiento'])->diffInYears(Carbon::now(), false) < 18) {

                flash('Debe ser mayor de de 18 años', 'danger');
                return redirect()->route('modificarperfilCliente');
            } else if ($countOrdenes != 0) {

                flash('Tiene ordenes en curso, no puede modificar su información', 'danger');
                return redirect()->route('modificarperfilCliente');
            } else {
                $usuario->fill(
                    [
                        'nombre' => $request['nombre'],
                        'apellido' => $request['apellido'],
                        'email' => $request['email'],
                    ]
                );
                $usuario->save();

                $clientes->fill(
                    [
                        'idUsuario' => $usuario->id,
                        'dui' => $request['dui'],
                        'nit' => $request['nit'],
                        'fechaDeNacimiento' => Carbon::parse($request['fechaDeNacimiento'])->format('Y-m-d'),

                    ]
                );
                $clientes->save();
                $telefonos = Telefono::with('TipoTelefonoN')->where('idCliente', $clientes->id)->get();
                foreach ($telefonos as $telefono) {

                    $reqName = $telefono->TipoTelefonoN->id == 1 ? 'numeroCasa' : 'numeroCelular';
                    if ($telefono->TipoTelefonoN->numero != $request[$reqName]) {
                        $tel = new Telefono();
                        $tel->fill(
                            [
                                'idTipoTelefono' => $telefono->TipoTelefonoN->id,
                                'numero' => $request[$reqName],
                                'idCliente' => $clientes->id,

                            ]
                        );
                        $tel->save();
                        Telefono::destroy($telefono->id);

                    }
                }


                $direcciones = Direccione::with('MunicipioDireccion', 'MunicipioDireccion.Departamento')->where('id', $clientes->id)->get();
                if ($direcciones[0]->detalle != $request['direccion']) {
                    $direccion = new Direccione();
                    $direccion->fill(
                        [
                            'idMunicipio' => $request['municipio'],
                            'idCliente' => $clientes->id,
                            'detalle' => $request['direccion'],

                        ]
                    );
                    $direccion->save();
                    Direccione::destroy($direcciones[0]->id);

                }
                $idCliente = $clientes->id;
                $this->modificarEstadoSolicitud($clientes->id);
                $idrol = 3;
                /*OBTENIENDO USUARIOS DE ROL AUTORIZADOR DE TODAS LAS CASAS DONDE EL CLIENTE
                ESTA AFILIADO PARA NOTIFICAR DEL CAMBIO DE INFORMACIÓN.
              */
                $usuarios = Usuario::whereHas('UsuarioRoles', function ($query) use ($idrol) {
                    $query->where('idRol', $idrol);
                })->whereIn("idOrganizacion", Organizacion::whereHas('SolicitudOrganizacion', function ($query) use ($idCliente) {
                    $query->where('idCliente', $idCliente)->where('idEstadoSolicitud', 5);
                })->pluck('id')->toArray())->get();
                $emails = [];
                $i = 0;
                foreach ($usuarios as $user) {
                    $emails[$i] = $user->email;
                    $i++;
                }

                $data = [
                    'titulo' => 'El cliente ' . Auth::user()->nombre . ' ' . Auth::user()->apellido . ' ha cambiado su información'
                ];
                $action = new Action();
                $action->sendEmail($data, $emails, 'Cambio de información', 'Cambio de información', 'emails.cambioInformacion');
                flash('Datos ingresados con exito', 'success');
                return redirect()->route('perfilcliente');
            }
        } catch (Exception $e) {
            flash('Ocurrio un problema al modifcar la información', 'danger');

            return redirect()->route('modificarperfilCliente');
        }

    }

    public function modificarEstadoSolicitud($idCliente)
    {
        DB::table('solicitud_registros')
            ->where('idCliente', $idCliente)
            ->update(['idEstadoSolicitud' => 5]);


    }

    public function AfiliacionCliente()
    {
        $arrcasas = [];
        $idCliente = Auth::user()->ClienteN->id;
        $casas = Organizacion::where("idTipoOrganizacion", 1)->get();
        foreach ($casas as $casa) {

            $casasClientes = DB::table("solicitud_registros")
                ->whereIn("idEstadoSolicitud", [1, 2, 4])
                ->where("idCliente", $idCliente)
                ->where("idOrganizacion", $casa->id)
                ->count();
            if ($casasClientes == 0) {
                $arrcasas[$casa->id] = $casa->nombre;


            }


        }


        return view("Clientes.Afiliaciones.AfiliacionCliente", ["casas" => $arrcasas]);

    }

    public function AfiliacionClienteStore(Request $request)
    {

        try {
            $this->validate($request, [
                'casas' => 'required',
                'numeroafiliacion' => 'required|numeric|digits:5|integer|min:0',

            ]);
            $afiliacion = new SolicitudRegistro();
            $afiliacion->fill(
                [
                    'idCliente' => Auth::user()->ClienteN->id,
                    'idOrganizacion' => $request["casas"],
                    'numeroDeAfiliado' => $request["numeroafiliacion"],
                    'comentarioDeRechazo' => '',
                    'idEstadoSolicitud' => 1,

                ]
            );
            $afiliacion->save();

            flash('Afiliación realizada con éxito', 'success');
            return redirect()->route('afiliarsecasa');

        } catch (Exception $e) {
            flash('Ocurrio un error al realizar la afiliación', 'danger');
            return redirect()->route('afiliarsecasa');

        }

    }

    public function ListadoAfiliaciones()
    {

        $solicitudes = SolicitudRegistro::with("OrganizacionN")
            ->where("idCliente", Auth::user()->ClienteN->id)
            ->where("idEstadoSolicitud", 2)->get();
        return view("Clientes.Afiliaciones.ListaAfiliaciones", ["solicitudes" => $solicitudes]);


    }

    public function ListadoSolicitudes()
    {

        $solicitudes = SolicitudRegistro::with("OrganizacionN", "EstadoSolicitudN")
            ->where("idCliente", Auth::user()->ClienteN->id)->where("idEstadoSolicitud", "!=", 2)->get();
        return view("Clientes.Afiliaciones.ListadoSolicitudesAfiliacion", ["solicitudes" => $solicitudes]);


    }

    public function CuentasCedevales()
    {

        $cedevales = Cedeval::where("idCliente", Auth::user()->ClienteN->id)->get();


        return view("Clientes.Perfil.CuentasCedevales", ["cedevales" => $cedevales]);
    }

    public function EliminarCedeval(Request $request)
    {
        try {
            $this->validate($request, [
                'idCedeval' => 'required',


            ]);
            $countOrden = Ordene::where("idCuentaCedeval", $request["idCedeval"])
                ->whereNotIn("idEstadoOrden", [1, 2, 4, 5, 6])->count();
            Log::info($countOrden);
            if ($countOrden == 0) {

                Cedeval::where("idCliente", Auth::user()->ClienteN->id)->where("id", $request["idCedeval"])->delete();
                flash('Cuenta eliminada con exito', 'success');
                return redirect()->route('cuentascedevales');
            } else {

                flash('Hay orden que aun no ha finalizado, asociado a esta cuenta.', 'info');
                return redirect()->route('cuentascedevales');
            }

        } catch (Exception $e) {

            flash('Ocurrio un error al eliminar la cuenta cedeval', 'danger');
            return redirect()->route('cuentascedevales');
        }
    }

    public function AgregarCedeval(Request $request)
    {
        try {
            $this->validate($request, [
                'CuentaCedeval' => 'required|numeric|unique:cedevals,cuenta|digits:10|integer|min:0',

            ]);

            $cedeval = new Cedeval();
            $cedeval->fill(
                [
                    'idCliente' => Auth::user()->ClienteN->id,
                    'cuenta' => $request["CuentaCedeval"],


                ]
            );
            $cedeval->save();
            flash('Cuenta cedeval agregada con éxito', 'success');
            return redirect()->route('cuentascedevales');
        } catch (Exception $e) {

            flash('Cuenta cedeval eliminar la cuenta cedeval', 'danger');
            return redirect()->route('cuentascedevales');
        }
    }

    public function ModificarCedeval(Request $request)
    {
        try {
            $this->validate($request, [
                'CuentaCedeval' => 'required',
                'idCuentaCedeval' => 'required',

            ]);

            $cedeval = Cedeval::where("id", $request["idCuentaCedeval"])->where("idCliente", Auth::user()->id)->first();
            $cedeval->fill(
                [
                    'cuenta' => $request["CuentaCedeval"],


                ]
            );
            $cedeval->save();
            flash('Cuenta cedeval modificada con éxito', 'success');
            return redirect()->route('cuentascedevales');
        } catch (Exception $e) {

            flash('Ocurrio un error al modificar la cuenta cedeval', 'danger');
            return redirect()->route('cuentascedevales');
        }
    }

    public function modificarPassword()
    {


        return view("Clientes.Perfil.modificarPassword");


    }


    //CAMBIANDO LAS SOLICITUDES A ESTADO REVISIÓN

    public function modificarPasswordUpdate(Request $request)
    {

        $this->validate($request, [
            'passwordActual' => 'required',
            'newPassword' => 'required',
            'repitaPassword' => 'required',

        ]);

        if (Hash::check($request["passwordActual"], Auth::user()->password)) {
            if ($request["newPassword"] != $request["repitaPassword"]) {

                flash('Las contraseñas no coinciden', 'info');
                return redirect()->route('modificarpassword');
            } else {

                $user = Auth::user();
                $user->fill(
                    [
                        'password' => bcrypt($request["repitaPassword"]),


                    ]
                );
                $user->save();
                flash('contraseña cambiada con exito', 'info');
                return redirect()->route('perfilcliente');
            }


        } else {

            flash('Las contraseña ingresada no coincide con la actual', 'info');
            return redirect()->route('modificarpassword');
        }


    }

    //LISTADO DE ORDENES RELACION RECURSIVA

    public function ListadoOrdenesPadre($id)
    {

        try {

            $ordenes = Ordene::with("EstadoOrden")->where("idOrden", $id)
                ->orWhere("id", $id)
                ->where("idCliente", Auth::user()->ClienteN->id)
                ->orderBy("created_at", 'DESC')
                ->get();

            return view('Clientes.Ordenes.listadoOrdenesPadre', ["ordenes" => $ordenes]);
        } catch (Exception $e) {
            return redirect()->back();

        }


    }



    /**
     *
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
