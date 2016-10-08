@extends('layouts.ClientesLayout')

@section('title')
    <title>Listado de afiliaciones</title>

@stop
@section('content')
    <script>
        $('#afiliaciones').addClass('active');
        $('#afiliacionesC').addClass('active')

    </script>
    <h2>
        Listado de casas afiliado

    </h2>
    <div class="row">
        <div class="col-xs-12">
            @include('alertas.errores')
            @include('alertas.flash')

            <br/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Ordenes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-hover">
                        <thead>
                        <tr>

                            <th><p class="text-center">Id de registro</p></th>
                            <th><p class="text-center">Nombre de casa</p></th>
                            <th><p class="text-center">Número de afiliado</p></th>
                            <th><p class="text-center">Fecha de afiliación</p></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($solicitudes as $solicitud)
                            <tr>

                                <td>{{$solicitud->id}}</td>
                                <td>{{$solicitud->OrganizacionN->nombre}}</td>
                                <td>{{$solicitud->numeroDeAfiliado}}</td>
                                <td>{{$solicitud->updated_at}}</td>


                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
@stop