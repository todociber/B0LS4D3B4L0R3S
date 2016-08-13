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
                        <tr>
                            <td>1</td>
                            <td>admin</td>
                            <td>admin@bves.com</td>
                            <td>2016-08-04 13:16:48</td>
                            <td>                                        <p class="p-green">
                                    Activo
                                </p>
                            </td>

                            <td><a class="btn btn-primary background-pencil" href="http://localhost:8000/bolsa/ModificarUsuario/1"><em class="fa fa-pencil"></em></a>

                                <button onclick="window.location.href='http://localhost:8000/bolsa/EliminarUsuario/1';  waitingDialog.show('Procesando... ',{ progressType: 'info'});">
                                    <span class="glyphicon glyphicon-remove p-red"></span></button>

                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

@stop

