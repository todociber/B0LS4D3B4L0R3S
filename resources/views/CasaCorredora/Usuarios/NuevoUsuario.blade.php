@extends('layouts.ClientesLayout')

@section('title')
    <title>Nueva Usuario Casa Corredora</title>

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
                            @include('alertas.errores')
                            <form>

                                <label for="Nombre">Nombre</label>
                                <input class="form-control" placeholder="Ingrese el  Nombre del Usuario" name="nombre"
                                       type="text">
                                <label for="Apellido">Apellido</label>
                                <input class="form-control" placeholder="Ingrese el  Apellido del Usuario"
                                       name="apellido" type="text">
                                <label for="Correo">Correo</label>
                                <input class="form-control" placeholder="Ingrese el  correo del Usuario" name="email"
                                       type="email">

                                <label for="Rol del usuario">Rol Del Usuario</label>


                                <br>
                                <input name="rolUsuario[]" type="checkbox" value="2">
                                <label for="Administrador Casa Corredora">Administrador Casa Corredora</label>
                                <br>
                                <br>
                                <input name="rolUsuario[]" type="checkbox" value="4">
                                <label for="Agente Corredor">Agente Corredor</label>
                                <br>
                                <br>
                                <input name="rolUsuario[]" type="checkbox" value="3">
                                <label for="Operador">Operador</label>
                                <br>
                                <br>


                                <input class="btn btn-primary btn-flat" name="btnCrearUsuario"
                                       onclick="waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"
                                       type="submit" value="Registrar Usuario">
                            </form>

                            <br><br>
                    </div>
                </div><!--row-->


                <!-- /.box -->
            </div>
        </div>
    </div>


        <script>


        </script>

@stop