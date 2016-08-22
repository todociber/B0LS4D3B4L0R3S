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
                            {!!link_to_route('UsuarioCasaCorredora.crear', $title = 'Crear Usuario ', $parameters = [], $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            <br><br>

                            <table id="example1" class="table table-hover">
                                <thead>
                                <tr>
                                    <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                                    <th><p class="text-center">Nombre</p></th>
                                    <th><p class="text-center">Apellido</p></th>
                                    <th><p class="text-center">Correo</p></th>
                                    <th><p class="text-center">Roles</p></th>
                                    <th><p class="text-center">Estado</p></th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <br><br>
                                        <a href="../UsuarioCasaCorredora/2/edit" class="btn btn-primary"
                                           onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">
                                            Editar Usuario </a>
                                        <br>

                                        <form><input name="_method" type="hidden" value="DELETE"><input name="_token"
                                                                                                        type="hidden"
                                                                                                        value="tXUoSGsFVuxvkNh4Xq0oYslYPxQXodDPfDC3bhis">
                                            <input class="btn btn-danger"
                                                   onclick="waitingDialog.show('Desactivando Espere... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);"
                                                   type="submit" value="Desactivar  Usuario ">
                                        </form>


                                    </td>
                                    <td>Juan Jose</td>
                                    <td>Hernandez</td>
                                    <td>josehernandez@yahoo.com</td>
                                    <td> Operador<br>
                                    </td>
                                    <td>
                                        Activo
                                    </td>
                                </tr>
                                <tr role="row" class="even">
                                    <td class="sorting_1">
                                        <br><br>
                                        <a href="#" class="btn btn-warning"
                                           onclick="waitingDialog.show('Activando Espere... ',{ progressType: 'warning'});setTimeout(function () {waitingDialog.hide();}, 3000);">Activar
                                            Usuario </a>


                                    </td>
                                    <td>Carlos Eduardo</td>
                                    <td>Perez Perez</td>
                                    <td>carlosPerez@hotmail.com</td>
                                    <td> Agente Corredor<br>
                                        Operador<br>
                                    </td>
                                    <td>
                                        Inactivo
                                    </td>
                                </tr>
                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <br><br>
                                        <a href="../UsuarioCasaCorredora/2/edit" class="btn btn-primary"
                                           onclick="waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);">
                                            Editar Usuario </a>


                                    </td>
                                    <td>Alexander</td>
                                    <td>Dominguez</td>
                                    <td>alexlaley10@gmail.com</td>
                                    <td> Administrador Casa Corredora<br>
                                        Agente Corredor<br>
                                        Operador<br>
                                    </td>
                                    <td>
                                        Activo
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