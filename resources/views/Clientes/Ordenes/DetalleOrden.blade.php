@extends('layouts.ClientesLayout')

@section('title')
    <title>Detalle de orden</title>

@stop
@section('content')
    <script>
        $('#ordenes').addClass('active');
        $('#listadoOrdenes').addClass('active')
    </script>

    <div class="invoice">
        <h2 class="page-header">
            <i class="fa fa-file-text-o"></i> Orden #{{$orden->correlativo}} <br/><br/>
            Cliente: {{Auth::user()->nombre.' '. Auth::user()->apellido}}
            <small class="pull-right"><strong>Fecha de Registro:</strong> {{$ordenDate}} </small>
            <br>
            <small class="pull-right"><strong>Fecha de
                    Vigencia:</strong> {{\Carbon\Carbon::parse($orden->FechaDeVigencia)->format('m-d-Y')}}</small>
            <br>
        </h2>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">


                <b>Casa corredora: </b> {{$orden->OrganizacionOrdenN->nombre}}<br>
                <b>Tipo de mercado: </b>{{$orden->TipoMercado}}<br>
                <b>Tipo de orden: </b> {{$orden->TipoOrdenN->nombre}} <br>
                <b>Titulo: </b>{{$orden->titulo}}<br>
                <b>Cuenta cedeval: </b>{{$orden->CuentaCedeval->cuenta}} <br>
                <b>Valor minimo: </b>${{$orden->valorMinimo}}<br>
                <b>Valor máximo: </b>${{$orden->valorMaximo}}<br>
                <b>Monto: </b>${{$orden->monto}}<br>
            </div>
            <div class="col-sm-4 invoice-col"> <?php $corredor = $orden->Corredor_UsuarioN; ?>
                <b> Agente corredor:</b>@if($corredor != null)
                    {{$corredor->nombre}}
                @else No asignado
                @endif<br>
                <b>Comisión a cobrar: </b> {{$cm = $orden->comision ? $orden->comision:'Por definir'}}<br>
                <b>Tipo de
                    ejecución:</b> {{$orden->TipoEjecucionN->forma}}
                <br>
                <b>Estado:</b>{{$orden->EstadoOrden->estado}}

            </div>

        </div><!-- /.box-info -->
        <div class="row">
            <div class="col-md-12 text-right">

                <?php
                $orderEstado = $orden->EstadoOrden->id;
                ?>
                @if($orderEstado == 2)
                    <a data-toggle="modal" data-target="#modalEjecutar" class="btn btn-info btn-flat">Ejecutar</a>
                    <a data-toggle="modal" data-target="#modalAnular" class="btn btn-danger btn-flat">Anular</a>

                @elseif($orderEstado==8)

                    <a data-toggle="modal" data-target="#modalRechazo" class="btn btn-danger btn-flat">Ver motivo de
                        rechazo</a>

                @endif

                @if(count($orden->OrdenPadre)>0)
                    <a href="{{route('listadordenespadre',["id"=>$orden->idOrden])}}" class="btn btn-primary btn-flat">Ver
                        historial de la orden</a>
                    @endif

                            <!--   <a href="#" class="btn btn-danger btn-flat">Anular</a>-->
            </div>
        </div>
    </div>

    <!-- /.box -->
@stop

@section('content2')


    <div class="row">
        <div class="col-md-12">
            @include('alertas.errores')
            @include('alertas.flash')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Comentarios de la orden</strong></h3>
                </div>
                <div class="box-body">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header">
                                    <?php
                                    $mensajes = $orden->MensajesN_Orden;
                                    ?>
                                    <h1>
                                        <small class="pull-right">{{count($mensajes)}} comentarios</small>
                                        Comentarios
                                    </h1>
                                </div>
                                <div class="comments-list">
                                    @foreach($mensajes as $mensaje)
                                        <div class="media">
                                            <p class="pull-right">
                                                <small>{{\Carbon\Carbon::parse($mensaje->created_at)->format('m-d-Y')}}</small>
                                            </p>
                                            <a class="media-left" href="#">

                                            </a>

                                            <div class="media-body">

                                                <h4 class="media-heading user_name">
                                                    @if($mensaje->UsuarioMensaje->idOrganizacion == null)
                                                        Yo
                                                    @else
                                                        {{$mensaje->UsuarioMensaje->nombre}} (Casa Corredora)
                                                    @endif

                                                </h4>
                                                {{$mensaje->contenido}}


                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($orden->idEstadoOrden == 1 || $orden->idEstadoOrden == 2 || $orden->idEstadoOrden == 5)
        <div class="row">

            <div class="col-md-12">
                <div class="widget-area no-padding blank">
                    <div class="status-upload">
                        {{Form::open(['route'=>'setMensaje','method' =>'POST', 'id'=>'form','role' => 'form'])  }}

                        <textarea class="text-areaD" name="Comentario"
                                  placeholder="Escriba aqui su comentario"></textarea>
                        <button type="submit" class="btn btn-info " onclick="animatedLoading()"> Comentar</button>
                        {{ Form::close() }}

                    </div><!-- Status Upload  -->
                </div><!-- Widget Area -->
            </div>

        </div>
    @endif
@stop

@if($orden->idEstadoOrden == 5 || $orden->idEstadoOrden == 7)
    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Operaciones de bolsa</h4>
                </div>
                <div class="modal-body">


                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>monto</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orden->Operaiones_ordenes as $operacion)
                            <tr>

                                <td>{{$operacion->id}}</td>
                                <td>{{$operacion->monto}}</td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>


                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar ventana</button>

                </div>
            </div>

        </div>
    </div>
@endif


@if($orden->idEstadoOrden == 2)
    <div id="modalAnular" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Anular orden</h4>
                </div>
                {{Form::open(['route'=>['anularorden', $orden->id],'method' =>'PUT', 'id'=>'form','role' => 'form','onsubmit'=>'animatedLoading()'])  }}
                <div class="modal-body">


                    <div class="form-group" id="monto">
                        {{ Form::label('Ingrese el motivo de la anulación de la orden') }}
                        {{ Form::text('motivo',null,['class'=>'form-control','required','placeholder'=>'Ingrese el motivo de la anulación']) }}
                    </div>


                </div>
                <div class="modal-footer">


                    <button type="submit" class="btn btn-info">Anular</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>
                {{Form::close()}}
            </div>

        </div>
    </div>
    <div id="modalEjecutar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                {{Form::open(['route'=>'ejecutarorden','method' =>'PUT', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()'])  }}
                <div style="display: none">

                    {{ Form::text('id',$orden->id,['class'=>'form-control', 'required']) }}


                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ejecutar orden</h4>
                </div>

                <div class="modal-body">
                    <p>¿Desea ejecutar la orden?</p>

                </div>
                <div class="modal-footer">


                    <button type="submit" class="btn btn-info">Ejecutar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>
                {{ Form::close() }}

            </div>

        </div>
    </div>
@endif

@if($orden->idEstadoOrden == 8)
    <div id="modalRechazo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Motivo de rechazo</h4>
                </div>

                <div class="modal-body">

                    <p>{{$motivoCancel}}</p>

                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>

                </div>
            </div>

        </div>
    </div>
@endif