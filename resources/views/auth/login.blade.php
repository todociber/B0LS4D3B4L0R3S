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
                    <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                                <input id="email" type="email" class="form-control"
                                       placeholder="Ingrese su correo electrónico" name="email"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input id="password" type="password" class="form-control"
                                       placeholder="Ingrese la contraseña" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group">

                                <div class="checkbox pull-left">
                                        <label>
                                            <input type="checkbox" name="remember"> Recordarme
                                        </label>
                                    </div>

                            </div>


                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                            Iniciar Sesion
                                    </button>


                </div>


                        </form>


            </div>
            </div>
        </div>
    </div>
@endsection
