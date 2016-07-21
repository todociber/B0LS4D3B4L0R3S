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
                            {!!Form::open(['route'=>'UsuarioCasaCorredora.store', 'method'=>'POST'])!!}
                            @include('CasaCorredora.Usuarios.formularios.formularioUsuario')

                            {!!Form::submit('Registrar Usuario', ['class'=>'btn btn-primary btn-flat', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            {!!Form::close()!!}


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