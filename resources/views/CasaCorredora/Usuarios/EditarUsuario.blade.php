@extends('layouts.ClientesLayout')

@section('title')
    <title>Nueva Usuario Casa Corredora</title>

@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Editar Usuario</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form accept-charset="UTF-8">

                                <label for="Nombre">Nombre</label>
                                <input class="form-control" placeholder="Ingrese el  Nombre del Usuario" name="nombre"
                                       type="text" value="Carlos Eduardo">
                                <label for="Apellido">Apellido</label>
                                <input class="form-control" placeholder="Ingrese el  Apellido del Usuario"
                                       name="apellido" type="text" value="Perez Perez">
                                <label for="Correo">Correo</label>
                                <input class="form-control" placeholder="Ingrese el  correo del Usuario" name="email"
                                       type="email" value="carlosPerez@hotmail.com">

                                <label for="Rol del usuario">Rol Del Usuario</label>
                                <br>
                                <input name="rolUsuario[]" type="checkbox" value="2">
                                <label for="Administrador Casa Corredora">Administrador Casa Corredora</label>
                                <br>
                                <input checked="checked" name="rolUsuario[]" type="checkbox" value="4">
                                <label for="Agente Corredor">Agente Corredor</label>
                                <br>
                                <br>
                                <input checked="checked" name="rolUsuario[]" type="checkbox" value="3">
                                <label for="Operador">Operador</label>
                                <br>
                                <br>
                                <input class="btn btn-primary btn-flat"
                                       onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"
                                       type="submit" value="Guardar">
                            </form>
                            <br>
                            <a class="btn btn-success"
                               onclick="waitingDialog.show('Actualizando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">Resetear
                                Contraseña </a>
                            <br><br>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>



@stop