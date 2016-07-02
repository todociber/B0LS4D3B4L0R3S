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
                            @include('alertas.errores')
                            {!!Form::model($usuarios, ['route'=>['UsuarioCasaCorredora.update', $usuarios->id], 'method'=>'PUT'])!!}
                            @include('CasaCorredora.Usuarios.formularios.formularioUsuario')

                            {!!Form::submit('Guardar', ['class'=>'btn btn-primary btn-flat'])!!}
                            {!!Form::close()!!}


                            <br><br>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>



@stop