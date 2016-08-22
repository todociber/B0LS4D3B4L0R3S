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
                            <div class="center-block"> @include('alertas.errores')
                                <div role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="center-block">


                                                    <b> <label for="Nombre del Cliente: ">Nombre Del
                                                            Cliente: </label></b>
                                                    Alejando Dueñas
                                                    <br>

                                                    <b> <label for="email del cliente: ">Email Del Cliente: </label></b>
                                                    Alejando159@outllok.com
                                                    <br>
                                                    <b> <label for="Numero de afiliado:">Numero De Afiliado:</label></b>
                                                    24553454557
                                                    <br>
                                                    <b> <label for="Cuentas Cedeval: ">Cuentas Cedeval: </label></b><br>

                                                    <ul>
                                                        <li>4545347817</li>
                                                    </ul>


                                                    <a href="#" class="btn btn-info"
                                                       onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">Procesar
                                                        Solicitud </a>


                                                </div>
                                            </div>
                                        </div><!--row-->


                                        <!-- /.box -->
                                    </div>
                                </div>


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop