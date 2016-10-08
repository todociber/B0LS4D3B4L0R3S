@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Afiliados</title>

@stop



@section('NombrePantalla')
    Afiliados
@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Afiliados</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('alertas.flash')
                            @include('alertas.errores')
                            <br><br>

                            <div class="table-responsive">
                                <table id="example1" class="table table-hover dt-responsive display nowrap"
                                       cellspacing="0">
                                <thead>
                                <tr>
                                    <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                                    <th><p class="text-center">Nombre</p></th>
                                    <th><p class="text-center">Apellido</p></th>
                                    <th><p class="text-center">Correo</p></th>
                                    <th><p class="text-center">Numero Afiliado</p></th>
                                    <th><p class="text-center">Estado</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitudes as $solicitud)





                                    <tr>
                                        <td>
                                            {!!link_to_route('Afiliado.eliminar', $title = 'Eliminar Afiliacion ', $parameters = $solicitud->id, $attributes = ['class'=>'btn btn-danger','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                        </td>
                                        <td>

                                            {{ $solicitud->ClienteNSolicitud->UsuarioNC->nombre}}


                                        </td>
                                        <td>
                                            {{ $solicitud->ClienteNSolicitud->UsuarioNC->apellido}}
                                        </td>
                                        <td>
                                            {{ $solicitud->ClienteNSolicitud->UsuarioNC->email}}
                                        </td>
                                        <td>
                                            {{$solicitud->numeroDeAfiliado}}
                                        </td>
                                        <td>
                                            {{$solicitud->EstadoSolicitudN->nombre}}
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop