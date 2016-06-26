@extends('layouts.bolsavalores')
@section('title')
    <title>Mi Perfil</title>
@stop
@section('content')
    <script>
        $('#perfil').addClass('active');
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
                                            <label for="exampleInputEmail1">Fecha de Registro</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Correo Institucional</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Correo">
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat">Actualizar</button>
                            <button type="submit" class="btn btn-primary btn-flat">Cambiar contraseña</button>
                        </div>

                    </div>

                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->
@stop