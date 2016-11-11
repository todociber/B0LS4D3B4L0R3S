@extends('layouts.bolsavalores')
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
                        <br>

                        <br>
                        <img src="../assets/img/latch.png"/>
                        <br><br>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                Para utilizar esta opcion por favor descarga la aplicacion de Latch disponible para
                                Android e iOs y utilizalá para generar un codigo de pareado para proteger el
                                sistema.
                            </div>
                        </div>
                        <br>
                            <a href="https://itunes.apple.com/es/app/latch-by-elevenpaths/id744999016?mt=8"
                               target="_blank" style=""
                               class="btn btn-link"><img src="../assets/img/app1.jpg"></a>

                        <a href="https://play.google.com/store/apps/details?id=com.elevenpaths.android.latch&hl=es"
                           target="_blank" style="" class="btn btn-link"><img src="../assets/img/play.jpg"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection