@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Nuevo Usuario</title>

@stop
@section('NombrePantalla')
    Nuevo Usuario
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
                            {!!Form::open(['route'=>'UsuarioCasaCorredora.store', 'method'=>'POST', 'onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            @include('CasaCorredora.Usuarios.formularios.formularioUsuario')

                            {!!Form::submit('Registrar Usuario', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario'])!!}
                            {!!Form::close()!!}


                    </div>
                </div><!--row-->


                <!-- /.box -->
            </div>
        </div>
    </div>


        <script>


        </script>

@stop