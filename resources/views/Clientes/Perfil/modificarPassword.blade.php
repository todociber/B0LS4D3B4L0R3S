@extends('layouts.ClientesLayout')

@section('title')
    <title>Modificar perfil</title>

@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Modificar contraseña</h3>
        </div><!-- /.login-logo -->
        <div class="box-body">

            @include('alertas.errores')
            @include('alertas.flash')
            {{Form::open(['route'=>'modificarpasswordupdate','method' =>'PUT', 'id'=>'form','onsubmit'=>'animatedLoading()'])  }}
            <div class="form-group">
                {!!   Form::label('Contraseña actual')!!}
                {!!   Form::password('passwordActual',['class'=>'form-control','placeholder'=>'Ingresa tu contraseña actual','required']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('Nueva contraseña') }}
                {{ Form::password('newPassword',['class'=>'form-control','placeholder'=>'Ingresa la contraseña nueva','required']) }}
            </div>

            <div class="form-group">
                {{ Form::label('Repita contraseña') }}
                {{ Form::password('repitaPassword',['class'=>'form-control','placeholder'=>'Repita la contraseña nueva','required']) }}
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat">Modificar password</button>
            </div>
            {{Form::close()}}

        </div><!-- /.login-box-body -->
    </div>
@stop