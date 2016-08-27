@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Usuario</h3>
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

                            <table id="example1" class="table table-hover">
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







                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <a href="#" class="btn btn-danger" onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">Eliminar Afiliacion </a>
                                    </td>
                                    <td>

                                        Gustavo


                                    </td>
                                    <td>
                                        Campos
                                    </td>
                                    <td>
                                        guseducampos@gmail.com
                                    </td>
                                    <td>
                                        55646897
                                    </td>
                                    <td>
                                        Aceptada
                                    </td>

                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop