@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Detalle Orden</title>

@stop

@section('NombrePantalla')
    Detalle de la Orden
@stop
@section('content')
    <script>

        $(document).ready(function () {
            $('#agentes').select2();
            //example1
            $('#AgentesC').DataTable({
                "paging": true,
                "ordering": true,
                "info": false,
                "language": {


                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }

                }
            });
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


    <div id="modalRechazar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                @include('CasaCorredora.OrdenesAutorizador.formularios.RechazarOrden')

            </div>

        </div>
    </div>


    <?php use Carbon\Carbon;?>


    @include('alertas.flash')
    @include('alertas.errores')
            <!-- PRUEBAS BVOOTSTRAP MODAL -->

    <div class="modal fade" role="dialog" id="SeleccionAgente" data-backdrop="static" data-keyboard="false"
         tabindex="-1" aria-labelledby="gridModalLabel"
         style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="gridModalLabel">Seleccion Agente Corredor</h4>
                </div>
                <div class="modal-body">
                    <table id="AgentesC" class="table table-hover">
                    <thead>
                    <tr>

                        <th><p class="text-center">Nombre</p></th>
                        <th><p class="text-center">email</p></th>
                        <th><p class="text-center">Nº Ordenes asignadas</p></th>
                        <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuariosAgentes as $usuarioA)

                        <tr>

                            <td>{{$usuarioA->nombre}}  {{$usuarioA->apellido}}</td>
                            <td>{{$usuarioA->email}}</td>
                            <td class="text-center">

                                <?php
                                $existenordenes = 0;

                                for ($i = 0; $i < count($agentesCorredores); $i++) {

                                    if ($agentesCorredores[$i]->id == $usuarioA->id) {
                                        $existenordenes = 1;
                                        echo $agentesCorredores[$i]->N;
                                    }

                                }

                                if ($existenordenes == 0) {
                                    echo '0';
                                }


                                ?>
                            </td>


                            <td>
                                <input type="button" data-dismiss="modal" class="btn btn-primary"
                                       onclick="clikLog(this)" id="{{$usuarioA->nombre}} {{$usuarioA->apellido}}"
                                       name="{{$usuarioA->id}}" value="Asignar orden"/>
                            </td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>





    <!-- PRUEBAS BVOOTSTRAP MODAL -->



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
                                @if($orden->idTipoEjecucion!=3)
                                    <br> <b>Operaciones de bolsa realizadas</b>
                                    @foreach($orden->Operaiones_ordenes as $operaciones)
                                        <li><b>Monto: </b> {{$operaciones->monto}}<br></li>
                                    @endforeach
                                    <br>
                                @endif

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Tipo de ejecución:</b>{{$orden->TipoEjecucionN->forma}}<br>
                                <b>Estado:</b><span style="color:orangered"> {{$orden->EstadoOrden->estado}}</span>
                                <br><br>

                                {!!link_to_route('OrdenesDetalles.PDF', $title = 'Descargar Reporte', $parameters = $orden->id, $attributes = ['class'=>'btn btn-info','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                @if($orden->idEstadoOrden==2)
                                    {!!link_to_route('Ordenes.editar', $title = 'Editar', $parameters = $orden->id, $attributes = ['class'=>'btn btn-warning','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                @endif
                                @if ($orden->idOrden !=null )
                                    {!!link_to_route('Ordenes.historial', $title = 'Historial ', $parameters = $orden->idOrden, $attributes = ['class'=>'btn btn-info','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                @endif

                                <br><br>
                                @if($orden->idEstadoOrden==5)
                                    @if(Auth::user()->id == $orden->idCorredor)

                                        {!!link_to_route('Ordenes.operaciones', $title = 'Operaciones de Bolsa', $parameters = $orden->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'success'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

                                    @endif

                                @endif

                                @if($orden->MensajesN_Orden()->count()>0)
                                    @foreach($ordenes[0]->MensajesN_Orden as $mensaje)
                                        @if($mensaje->idTipoMensaje ==2)
                                            <b>Motivo: </b>   {{$mensaje->contenido}}
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-sm-4 invoice-col">


                            </div>
                        </div><!-- /.box-info -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                @if($orden->idEstadoOrden==1)

                                    {!!Form::model($agentes, ['route'=>['Ordenes.aceptar', $orden->id], 'method'=>'PUT','onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                    <label>Agente Corredor: </label>
                                    <label id="AgenteSeleccionado" value="Sin Seleccionar">Sin Seleccionar </label>
                                    <div class="bs-example bs-example-padded-bottom">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#SeleccionAgente">
                                            Seleccionar Agente Corredor
                                        </button>
                                    </div>
                                    <input name="AgenteCorredor" id="AgenteCorredor" value="" size="40"
                                           style="display:none">
                                    <br>
                                    {!!Form::label('Comision')!!}
                                    {!!Form::number('Comision',null, ['class'=>'form-control', 'placeholder'=>'Ingrese la Comision  a cobrar ','min'=>'0','step'=>'any', 'max'=>'100'])!!}
                                    <br>
                                    <ul class="list-inline">

                                        <li>{!!Form::submit('Completar', ['class'=>'btn btn-info btn-flat'])!!}</li>

                                        <li><a data-toggle="modal" data-target="#modalRechazar"
                                           class="btn btn-danger btn-flat">Rechazar</a>
                                        </li>
                                        {!!Form::close()!!}
                                    </ul>



                                @elseif($orden->Corredor_UsuarioN()->count()>0)
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
                </div><!-- /.row -->
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
                                            <?php $contador = 0;

                                            foreach ($ordenes[0]->MensajesN_Orden as $mensaje2) {
                                                if ($mensaje2->idTipoMensaje != 2) {
                                                    $contador++;
                                                }

                                            }
                                            ?>
                                            <small class="pull-right">{{$contador}}
                                                comentarios
                                            </small>
                                            Comentarios
                                        </h3>
                                    </div>
                                    <div class="comments-list">


                                        @foreach($ordenes[0]->MensajesN_Orden as $mensaje)
                                            @if($mensaje->idTipoMensaje !=2)
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
                                            @endif
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($ordenes[0]->idEstadoOrden == 2 ||$ordenes[0]->idEstadoOrden == 1||$ordenes[0]->idEstadoOrden == 5  )
            <div class="row">

                <div class="col-md-12">

                    <div class="widget-area no-padding blank">
                        <div class="status-upload">
                            @include('CasaCorredora.OrdenesAutorizador.formularios.EnviarComentarios')
                        </div><!-- Status Upload  -->
                    </div><!-- Widget Area -->
                </div>

            </div>
        @endif


    </section>





@stop