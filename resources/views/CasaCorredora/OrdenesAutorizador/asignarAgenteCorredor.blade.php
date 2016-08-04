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


    @include('alertas.flash')
    @include('alertas.errores')


            <!-- PRUEBAS BVOOTSTRAP MODAL -->
    <div class="bs-example bs-example-padded-bottom">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#SeleccionAgente"> Launch
            demo modal
        </button>
    </div>
    <div class="modal fade" role="dialog" id="SeleccionAgente" tabindex="-1" aria-labelledby="gridModalLabel"
         style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="gridModalLabel">Modal title</h4>
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
                            <td></td>


                            <td>
                                Botones
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>






    <!-- PRUEBAS BVOOTSTRAP MODAL -->


    <br><br>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice">
                    <h2 class="page-header">
                        <i class="fa fa-file-text-o"></i> Orden #{{$orden->correlativo}} <br/><br/>
                        Cliente: {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->nombre}} {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}
                        <small class="pull-right"><strong>Fecha de
                                Registro:</strong> <?php use Carbon\Carbon;$fecha = $orden->created_at;$fecha = $fecha->format('Y-m-d');?>{{$fecha}}
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
                            <b>Tipo de mercado: </b>{{$orden->TipoMercadoN->nombre}}<br>
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
                            @if($orden->idEstadoOrden==1)
                                @include('CasaCorredora.OrdenesAutorizador.formularios.AsignarAgenteCorredorForm')
                                <div>
                                    <br>
                                    {!!link_to_route('Ordenes.rechazar', $title = 'Rechazar', $parameters = $orden->id, $attributes = ['class'=>'btn btn-danger','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                </div>

                            @else
                                {!!Form::label('Agente Corredor: ')!!} {{$orden->Corredor_UsuarioN->nombre}} {{$orden->Corredor_UsuarioN->apellido}}
                                <br>{!! Form::label('Comision') !!} {{$orden->tasaDeInteres}}%
                            @endif

                            <div class="row">
                                <div class="col-md-12 text-right">


                                </div>
                            </div>
                        </div><!-- /.box -->


                    </div><!-- /.col -->
                </div><!-- /.row -->

    </section>
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
                                            <small class="pull-right">4 comentarios</small>
                                            Comentarios
                                        </h3>
                                    </div>
                                    <div class="comments-list">
                                        <div class="media">
                                            <p class="pull-right">
                                                <small>12/12/12</small>
                                            </p>
                                            <a class="media-left" href="#">

                                            </a>

                                            <div class="media-body">

                                                <h4 class="media-heading user_name">Casa corredora</h4>
                                                Comentario


                                            </div>
                                        </div>
                                        <div class="media">
                                            <p class="pull-right">
                                                <small>12/12/12</small>
                                            </p>
                                            <a class="media-left" href="#">

                                            </a>

                                            <div class="media-body">

                                                <h4 class="media-heading user_name">Cliente</h4>
                                                Comentario


                                            </div>
                                        </div>
                                        <div class="media">
                                            <p class="pull-right">
                                                <small>12/12/12</small>
                                            </p>
                                            <a class="media-left" href="#">

                                            </a>

                                            <div class="media-body">

                                                <h4 class="media-heading user_name">Casa corredora</h4>
                                                Comentario


                                            </div>
                                        </div>
                                        <div class="media">
                                            <p class="pull-right">
                                                <small>12/12/12</small>
                                            </p>
                                            <a class="media-left" href="#">

                                            </a>

                                            <div class="media-body">

                                                <h4 class="media-heading user_name">Cliente</h4>
                                                Comentario


                                            </div>
                                        </div>
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
                        <form>
                            <textarea style="color: black;font-family: Arial;"
                                      placeholder="Escriba aqui su comentario"></textarea>

                            <button type="button" class="btn btn-info "> Comentar</button>
                        </form>
                    </div><!-- Status Upload  -->
                </div><!-- Widget Area -->
            </div>

        </div>

    </section>









@stop