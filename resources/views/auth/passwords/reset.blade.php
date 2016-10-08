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

                            <input name="password" type="password" value="" id="password"><br>
                            <br>
                            {!!Form::label('Repite la contraseña')!!}<br>
                            <input name="password2" type="password" value="" id="password2"><br>
                            <br><br>
                            {!!Form::submit('Cambiar Contraseña', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            {!!Form::close()!!}
                        </div>
                    @endif

                </div>
            </div>
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
