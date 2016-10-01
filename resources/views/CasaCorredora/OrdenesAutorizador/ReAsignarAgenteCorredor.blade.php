@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Reasignar Agente Corredor</title>

@stop
@section('NombrePantalla')
    Reasignar Agente Corredor
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
                <table id="example1" class="table table-hover">
                    <thead>
                    <tr>

                        <th><p class="text-center">Nombre</p></th>
                        <th><p class="text-center">email</p></th>
                        <th><p class="text-center">Numero de Ordenes</p></th>
                        <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuariosAgentes as $usuarioA)

                        <tr>

                            <td>{{$usuarioA->nombre}}  {{$usuarioA->apellido}}</td>
                            <td>{{$usuarioA->email}}</td>
                            <td>
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


                                ?> ordenes asignadas
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

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Tipo de ejecución:</b>{{$orden->TipoEjecucionN->forma}}<br>
                                <b>Estado:</b><span style="color:orangered"> {{$orden->EstadoOrden->estado}}</span>


                            </div>
                            <div class="col-sm-4 invoice-col">


                            </div>
                        </div><!-- /.box-info -->
                        <div class="row">
                            <div class="form-group col-md-6">


                                @include('CasaCorredora.OrdenesAutorizador.formularios.ReAsignarAgenteCorredorForm')
                                <div>
                                    <br>

                                </div>


                                <div class="row">
                                    <div class="col-md-12 text-right">


                                    </div>
                                </div>
                            </div><!-- /.box -->


                        </div><!-- /.col -->
                    </div><!-- /.row -->

        </section>
    @endforeach








@stop