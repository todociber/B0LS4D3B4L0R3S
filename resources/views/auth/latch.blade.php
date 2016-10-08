@extends('layouts.CasaCorredoraLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alertas.errores')
                @include('alertas.flash')
                <div class="panel panel-default">

                    <div class="panel-heading">Emparejar con Latch</div>

                    <div class="panel-body">
                        @if(Auth::user()->UsuariosLatchs->count()==0)
                        {!!Form::open(['route'=>'Latch.parear', 'method'=>'POST'])!!}

                        {!!Form::label('Token proporcionado por latch')!!}
                        {!!Form::text('token',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  token'])!!}
                        <br>
                        {!!Form::submit('Parear con latch', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                        {!!Form::close()!!}
                        @else
                            {!!link_to_route('Latch.desenparejar', $title = 'Desemparejar Latch ', $parameters = [], $attributes = ['class'=>'btn btn-warning','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'warning'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
