@extends('layouts.publico')

@section('title')
    <title>Nueva orden</title>

@stop




@section('content')
    <div class="login-box">
        <div class="login-logo">
            <p><b>Reset Password</b></p>
        </div>
        <div class="login-box-body">


            @include('alertas.flash')
                    @include('alertas.errores')

                    @if (Session::has('flash_notification.message'))

                    @else

                            {!!Form::open(['route'=>'Cambiar.password', 'method'=>'POST'])!!}

                {!!Form::label('Ingresa tu nuevas credenciales')!!}<br>

                            <div id="pswd_info">
                                <h5>La contraseña debería cumplir con los siguientes requisitos:</h5>
                                <ul class="list-group">
                                    <li id="letter">Al menos debería tener <strong>una letra</strong></li>
                                    <li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong>
                                    </li>
                                    <li id="number">Al menos debería tener <strong>un número</strong></li>
                                    <li id="length">Debería tener <strong>8 carácteres</strong> como mínimo</li>
                                </ul>
                            </div>

                <div class="form-group">
                    {!!Form::label('Escriba la contraseña')!!}
                    <input name="password" type="password" value="" class="form-control" id="password"><br>
                </div>
                <div class="form-group">
                            {!!Form::label('Repite la contraseña')!!}<br>
                    <input name="password2" type="password" class="form-control" value="" id="password2"><br>
                </div>

                <div class="form-group">
                            {!!Form::submit('Cambiar Contraseña', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            {!!Form::close()!!}
                </div>

            @endif

                </div>

    </div>


    <script>


        $(document).ready(function ($) {

            $('#password').strength({
                strengthClass: 'strength'

            });


        });

    </script>
@endsection
