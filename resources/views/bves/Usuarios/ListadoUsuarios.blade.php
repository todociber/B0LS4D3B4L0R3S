@extends('layouts.bolsavalores')
@section('title')
    <title>Catálogo de usuarios</title>
@stop
@section('content')
    <script>
        $('#usuarios').addClass('active');
        $('#catalogo').addClass('active');


    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @include('alertas.flash')
                    <h3 class="box-title">Lista de Usuarios</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->created_at}}</td>
                                <td>@if($usuario->deleted_at == null)
                                        <p class="p-green">
                                            Activo
                                        </p>
                                    @else
                                        <p class="p-red">
                                            Innactivo
                                        </p>
                                    @endif
                                </td>

                                <td><a class="btn btn-primary background-pencil"
                                       href="{!! route('modificarusuario',['id'=>$usuario->id])!!}"><em
                                                class="fa fa-pencil"></em></a>
                                    @if($usuario->deleted_at == null)

                                        <button onclick="window.location.href='{!! route('eliminarusuario',['id'=>$usuario->id]) !!}';  waitingDialog.show('Procesando... ',{ progressType: 'info'});">
                                            <span class="glyphicon glyphicon-remove p-red"></span></button>

                                    @else

                                        <button onclick="window.location.href='{!! route('restaurarusuario',['id'=>$usuario->id]) !!}';  waitingDialog.show('Procesando... ',{ progressType: 'info'}); ">
                                            <span class="glyphicon glyphicon-ok p-green"></span></button>


                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

@stop

