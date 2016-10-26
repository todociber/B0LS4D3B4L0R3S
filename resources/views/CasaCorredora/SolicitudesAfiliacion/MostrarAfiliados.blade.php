@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Afiliados</title>

@stop



@section('NombrePantalla')
    Afiliados
@stop
@section('content')

    <script>

        function desafiliarCliente(id, texto) {
            $('#idAfi').val(id);
            $('#modalbody').text("¿Desea desafiliar al cliente " + texto + "?");
        }
    </script>
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
                                            <button onclick="desafiliarCliente('{{$solicitud->id}}','{{ $solicitud->ClienteNSolicitud->UsuarioNC->nombre}}'); "
                                                    data-toggle="modal" data-target="#desactivarActivarCasa">
                                                <span class="glyphicon glyphicon-remove p-red"></span></button>
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
    </div>

    <div class="modal fade" id="desactivarActivarCasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                {{Form::open(['route'=>'Afiliado.eliminar','method' =>'POST', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()']) }}

                {{ Form::hidden('id',null,['id'=>'idAfi','class'=>'form-control','required']) }}

                <div class="modal-body">
                    <p id="modalbody"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cancelar</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@stop