@extends('layouts.publico')

@section('title')
    <title>Nueva orden</title>

@stop


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>
                    @include('alertas.flash')
                    @include('alertas.errores')

                    @if (Session::has('flash_notification.message'))

                    @else
                        <div class="panel-body">
                            {!!Form::open(['route'=>'Cambiar.password', 'method'=>'POST'])!!}

                            {!!Form::label('Cambia tu contraseña para terminar el proceso')!!}<br>
                            {!!Form::password('password',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  token'])!!}
                            <br>
                            {!!Form::label('Repite la contraseña')!!}<br>
                            {!!Form::password('password2',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  token'])!!}
                            <br><br>
                            {!!Form::submit('Cambiar Contraseña', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            {!!Form::close()!!}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
