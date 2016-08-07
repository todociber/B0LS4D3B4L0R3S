@extends('layouts.ClientesLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <div class="panel-body">
                        {!!Form::open(['route'=>'Latch.parear', 'method'=>'POST'])!!}

                        {!!Form::label('Token proporcionado por latch')!!}
                        {!!Form::text('token',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  token'])!!}

                        {!!Form::submit('Registrar Usuario', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                        {!!Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
