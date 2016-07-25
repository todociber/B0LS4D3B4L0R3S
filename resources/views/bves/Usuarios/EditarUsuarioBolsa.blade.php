@extends('layouts.bolsavalores')
@section('title')
    <title>Modificar usuario</title>
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
                            <h3 class="box-title">Modificar de Usuario</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alertas.errores')
                                        @include('alertas.flash')
                                        {{Form::model($usuario,['route'=>['UsuarioBolsa.update', $usuario->id],'method' =>'PUT', 'id'=>'form','role' => 'form'])  }}
                                        @include('bves.Usuarios.FormularioUserBolsa.FormularioUserBolsa')

                                    </div>

                                </div>
                            </div>
                            <div class="box-footer">
                                {!!Form::submit('Modificar Usuario', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit', 'onclick'=>"waitingDialog.show('Procesando... ',{ progressType: 'info'})"])!!}
                            </div>
                            {{ Form::close() }}

                        </div>

                    </div><!-- /.box -->
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop