@extends('layouts.loginLayout')
@section('content')
    <title>Login</title>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="account-wall">
                    <img class="img-responsive" src="{{URL::asset("assets/img/bolsa_logo.png")}}"
                         alt="">


                    @include('alertas.flash')
                    @include('alertas.errores')
                    {!!Form::open(['route'=>'forgotpassword.restore', 'method'=>'POST','class'=>'form-signin', 'onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                        <input id="email" type="email" class="form-control"
                               placeholder="Ingrese su correo electrónico" name="email"
                               value="{{ old('email') }}" required autofocus>

                    </div>

                    {!!Form::submit('Recupere su contraseña', ['class'=>'btn btn-lg btn-primary btn-block','name'=>'btnCrearUsuario'])!!}
                    {!!Form::close()!!}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

