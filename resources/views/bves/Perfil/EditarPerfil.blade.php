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
                                        {{Form::model($usuario,['route'=>['UsuarioBolsa.update', $usuario->id],'method' =>'PUT', 'id'=>'form','role' => 'form','onsubmit'=>'animatedLoading()'])  }}
                                            <div class="form-group">
                                                {!!   Form::label('Nombre')!!}
                                                {!!   Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa tu nombre','required']) !!}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('Apellido') }}
                                                {{ Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa tu apellido','required']) }}
                                            </div>
                                        {!!Form::submit('Modificar información', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit'])!!}
                                            {{ Form::close() }}


                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div><!-- /.box -->
                </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop