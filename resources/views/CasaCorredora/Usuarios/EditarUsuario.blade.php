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
                            <br>
                            @if($usuarios->id== Auth::user()->id)

                            @else
                                {!!link_to_route('UsuarioCasaCorredora.resetearpassword', $title = 'Resetear Contraseña ', $parameters = $usuarios->id, $attributes = ['class'=>'btn btn-success'])!!}

                            @endif



                            <br><br>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>



@stop