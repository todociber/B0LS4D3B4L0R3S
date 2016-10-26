@extends('layouts.ClientesLayout')

@section('title')
    <title>Modificar perfil</title>

@stop

@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Modificar correo electrónico</h3>
        </div><!-- /.login-logo -->
        <div class="box-body">

            @include('alertas.errores')
            @include('alertas.flash')
            {{Form::model($user,['route'=>'modificarcorreo.update','method' =>'PUT', 'id'=>'formulario','onsubmit'=>'animatedLoading()'])  }}

            <div class="form-group">
                {{ Form::label('Email') }}
                {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingresa tu correo electrónico','required']) }}
            </div>


            {!!Form::submit('Modificar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit'])!!}
            {{Form::close()}}

        </div><!-- /.login-box-body -->
    </div>



@stop