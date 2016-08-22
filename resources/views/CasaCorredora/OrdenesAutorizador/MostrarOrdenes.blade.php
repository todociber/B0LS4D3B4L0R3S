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
                                    <th><p class="text-center">Cliente</p></th>
                                    <th><p class="text-center">Monto</p></th>
                                    <th><p class="text-center">Tipo de Mercado</p></th>

                                    <th><p class="text-center">Estado</p></th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <a href="../Ordenes/1/asignar" class="btn btn-success"
                                           onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">Asignar</a>


                                    </td>
                                    <td>Karla Melgar</td>
                                    <td>100000.00</td>
                                    <td>PRIVADO</td>


                                    <td>
                                        Pre-Vigente
                                    </td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">
                                        <a href="../Ordenes/1/asignar" class="btn btn-success"
                                           onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">Asignar</a>


                                    </td>
                                    <td>Roberto Espinoza</td>
                                    <td>50000.00</td>
                                    <td>PUBLICO</td>


                                    <td>
                                        Pre-Vigente
                                    </td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <a href="../Ordenes/1/asignar" class="btn btn-success"
                                           onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">Asignar</a>


                                    </td>
                                    <td>Alejando Dueñas</td>
                                    <td>50000.00</td>
                                    <td>PUBLICO</td>


                                    <td>
                                        Pre-Vigente
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