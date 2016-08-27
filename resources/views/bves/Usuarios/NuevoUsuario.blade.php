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


                        <div class="box-body">
                                                                <div class="content">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form  accept-charset="UTF-8" id="form" role="form"><input name="_token" type="hidden" value="p2Mh0xu03SINzn4WbjXpSa6ef3Tk7kDg61ARhf22">
                                                                                <div class="form-group">
                                                                                    <label for="Nombre">Nombre</label>
                                                                                    <input class="form-control" placeholder="Ingresa el nombre del usuario" name="nombre" type="text">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="Apellido">Apellido</label>
                                                                                    <input class="form-control" placeholder="Ingresa el apellido del usuario" name="apellido" type="text">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="Correo electrónico">Correo Electrónico</label>
                                                                                    <input class="form-control" placeholder="Ingresa el correo institucional del usuario" name="email" type="text">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="Seleccione un estado">Seleccione Un Estado</label>
                                                                                    <select class="form-control" required="required" id="estado" name="Estado"><option value="1">Activo</option><option value="0">Innactivo</option></select>
                                                                                </div>






                                                                            </form></div>

                                                                    </div>
                                                                </div>
                                                                <div class="box-footer">
                                                                    <input class="btn btn-primary btn-flat ladda-button" id="btnSubmit" type="submit" value="Registrar Usuario">
                                                                </div>


                                                            </div>

                                                        </div><!-- /.box -->
                                                    </div>
                                                </div>
                                            </div><!-- /.col -->
                                        </div><!-- /.row -->
                                        </section>

                        </div>

                    </div><!-- /.box -->
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop