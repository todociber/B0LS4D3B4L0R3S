@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')
    <script>

        $(document).ready(function () {
            $('#agentes').select2();
        });
    </script>
    <script>


        function clikLog(boton) {
            var idAgenteCorredor = boton.name;
            var NombreAgenteCorredor = boton.id;
            console.log(idAgenteCorredor);
            document.getElementById("AgenteCorredor").value = idAgenteCorredor;
            document.getElementById("AgenteSeleccionado").innerHTML = NombreAgenteCorredor;
        }


    </script>

    <?php use Carbon\Carbon;?>


    @include('alertas.flash')
    @include('alertas.errores')




    @foreach($ordenes as $orden)
        <br><br>


        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice">
                        <h2 class="page-header">
                            <i class="fa fa-file-text-o"></i> Orden #{{$orden->correlativo}} <br/><br/>
                            Cliente: {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->nombre}} {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}
                            <small class="pull-right"><strong>Fecha de
                                    Registro:</strong> <?php $fecha = $orden->created_at;$fecha = $fecha->format('Y-m-d');?>{{$fecha}}
                            </small>
                            <br>
                            <small class="pull-right"><strong>Fecha de
                                    Vigencia:</strong><?php echo Carbon::createFromFormat('Y-m-d', $orden->FechaDeVigencia)->toDateString();?>
                            </small>
                            <br>
                        </h2>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">


                                <b>Casa corredora: </b> {{$orden->OrganizacionOrdenN->nombre}}<br>
                                <b>Tipo de mercado: </b>{{$orden->TipoMercado}}<br>
                                <b>Tipo de orden: </b> {{$orden->TipoOrdenN->nombre}} <br>
                                <b>Titulo: </b>{{$orden->titulo}}<br>
                                <b>Cuenta cedeval: </b>{{$orden->CuentaCedeval->cuenta}} <br>
                                <b>Precio minimo: </b>{{$orden->valorMinimo}}<br>
                                <b>Precio máximo: </b>{{$orden->valorMaximo}}<br>
                                <b>Monto: </b>{{$orden->monto}}<br>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Tipo de ejecución:</b>{{$orden->TipoEjecucionN->forma}}<br>
                                <b>Estado:</b><span style="color:orangered"> {{$orden->EstadoOrden->estado}}</span>
                                <br><br>

                                @if($orden->idEstadoOrden==2)
                                    {!!link_to_route('Ordenes.editar', $title = 'Editar', $parameters = $orden->id, $attributes = ['class'=>'btn btn-warning','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                @endif
                                @if ($orden->idOrden !=null )
                                    {!!link_to_route('Ordenes.historial', $title = 'Historial ', $parameters = $orden->id, $attributes = ['class'=>'btn btn-info','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                @endif

                                <br><br>
                                @if($orden->idEstadoOrden==5)
                                    @if(Auth::user()->id == $orden->idCorredor)

                                        {!!link_to_route('Ordenes.operaciones', $title = 'Operaciones de Bolsa', $parameters = $orden->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'success'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

                                    @endif

                                @endif
                            </div>
                            <div class="col-sm-4 invoice-col">


                            </div>
                        </div><!-- /.box-info -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                @if($orden->idEstadoOrden==1)

                                    @include('CasaCorredora.OrdenesAutorizador.formularios.AsignarAgenteCorredorForm')
                                    <div>
                                        <br>
                                        {!!link_to_route('Ordenes.rechazar', $title = 'Rechazar', $parameters = $orden->id, $attributes = ['class'=>'btn btn-danger','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                    </div>

                                @else
                                    {!!Form::label('Agente Corredor: ')!!} {{$orden->Corredor_UsuarioN->nombre}} {{$orden->Corredor_UsuarioN->apellido}}
                                    <br>{!! Form::label('Comision') !!} {{$orden->comision}}%
                                @endif


                                <div class="row">
                                    <div class="col-md-12 text-right">


                                    </div>
                                </div>
                            </div><!-- /.box -->


                        </div><!-- /.col -->
                    </div><!-- /.row -->

        </section>
    @endforeach




    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="invoice">

                    <div class="invoice-info">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="page-header">
                                        <h3>
                                            <small class="pull-right">{{$ordenes[0]->MensajesN_Orden->count()}}
                                                comentarios
                                            </small>
                                            Comentarios
                                        </h3>
                                    </div>
                                    <div class="comments-list">


                                        @foreach($ordenes[0]->MensajesN_Orden as $mensaje)
                                            <div class="media">
                                                <p class="pull-right">
                                                    <small>{{$mensaje->created_at}}</small>
                                                </p>
                                                <a class="media-left" href="#">

                                                </a>

                                                <div class="media-body">
                                                    @if ($mensaje->UsuarioMensaje->idOrganizacion==null)

                                                        <h4 class="media-heading user_name">
                                                            Cliente: {{$mensaje->UsuarioMensaje->nombre}} {{$mensaje->UsuarioMensaje->apellido}}</h4>
                                                    @else
                                                        <h4 class="media-heading user_name">Casa Corredora enviado
                                                            por: {{$mensaje->UsuarioMensaje->nombre}} {{$mensaje->UsuarioMensaje->apellido}} </h4>

                                                    @endif


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


        <div class="row">

            <div class="col-md-12">

                <div class="widget-area no-padding blank">
                    <div class="status-upload">
                        @include('CasaCorredora.OrdenesAutorizador.formularios.EnviarComentarios')
                    </div><!-- Status Upload  -->
                </div><!-- Widget Area -->
            </div>

        </div>

    </section>





@stop