@extends('layouts.bolsavalores')
@section('title')
    <title>Nueva usuario</title>
@stop


@section('content')
    <script>
        $('#usuarios').addClass('active');
        $('#nuevoUsuario').addClass('active');

    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registro de Usuario</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Nombre">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Apellido</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Apellido">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Correo institucional</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Correo">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Estado</label>
                                                <select type="text" class="form-control" id="exampleInputEmail1" placeholder="Estado">
                                                    <option>Seleccionar Estado</option>
                                                    <option>Activo</option>
                                                    <option>Inactivo</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat">Registrar</button>
                            </div>

                        </div>

                    </div><!-- /.box -->
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop