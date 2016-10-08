@extends('layouts.publico')

@section('title')
    <title>Nueva orden</title>

@stop

<script>
    $(document).ready(function () {

        $('input[type=password]').keyup(function () {
            // set password variable
            var pswd = $(this).val();
            //validate the length
            if (pswd.length < 8) {
                $('#length').removeClass('valid').addClass('invalid');
            } else {
                $('#length').removeClass('invalid').addClass('valid');
            }

            //validate letter
            if (pswd.match(/[A-z]/)) {
                $('#letter').removeClass('invalid').addClass('valid');
            } else {
                $('#letter').removeClass('valid').addClass('invalid');
            }

            //validate capital letter
            if (pswd.match(/[A-Z]/)) {
                $('#capital').removeClass('invalid').addClass('valid');
            } else {
                $('#capital').removeClass('valid').addClass('invalid');
            }

            //validate number
            if (pswd.match(/\d/)) {
                $('#number').removeClass('invalid').addClass('valid');
            } else {
                $('#number').removeClass('valid').addClass('invalid');
            }

        }).focus(function () {
            $('#pswd_info').show();
        }).blur(function () {
            $('#pswd_info').hide();
        });

    });
</script>


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

                            <div id="pswd_info">
                                <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
                                <ul>
                                    <li id="letter">Al menos debería tener <strong>una letra</strong></li>
                                    <li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong>
                                    </li>
                                    <li id="number">Al menos debería tener <strong>un número</strong></li>
                                    <li id="length">Debería tener <strong>8 carácteres</strong> como mínimo</li>
                                </ul>
                            </div>

                            {!!Form::password('password',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  token','id'=>'password'])!!}
                            <br>
                            {!!Form::label('Repite la contraseña')!!}<br>
                            {!!Form::password('password2',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  token','id'=>'password2'])!!}
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
