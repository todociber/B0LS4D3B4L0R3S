@extends('layouts.bolsavalores')

@section('title')
    <title>Listado de casas inscritas</title>
@stop
@section('content')
    <script>
        $('#casas').addClass('active');
        $('#catalogoCasas').addClass('active');



    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @include('alertas.flash')
                    <h3 class="box-title">Lista de casas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Télefono</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($organizaciones as $organizacion)
                            <tr>
                                <td>{{$organizacion->id}}</td>
                                <td>{{$organizacion->codigo}}</td>
                                <td>{{$organizacion->nombre}}</td>
                                <td>{{$organizacion->correo}}</td>
                                <td>{{$organizacion->direccion}}</td>
                                <td>{{$organizacion->telefono}}</td>
                                <td>{{$organizacion->created_at}}</td>
                                <td>@if($organizacion->deleted_at == null)
                                        <p class="p-green">
                                            Activo
                                        </p>
                                        @else
                                        <p class="p-red">
                                        Innactivo
                                        </p>
                                    @endif
                                </td>

                                <td><a class="btn btn-primary background-pencil" href="{!! route('editarCasa',['id'=>$organizacion->id])!!}"><em class="fa fa-pencil"></em></a>
                                    @if($organizacion->deleted_at == null)

                                            <button onclick="window.location.href='{!! route('eliminarCasa',['id'=>$organizacion->id]) !!}';  waitingDialog.show('Procesando... ',{ progressType: 'info'});"><span class="glyphicon glyphicon-remove p-red"></span></button>

                                    @else

                                            <button onclick="window.location.href='{!! route('restaurarcasa',['id'=>$organizacion->id]) !!}';  waitingDialog.show('Procesando... ',{ progressType: 'info'}); "><span class="glyphicon glyphicon-ok p-green"></span></button>


                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.col -->
@stop