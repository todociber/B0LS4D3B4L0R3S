@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Detalle de afiliacion</title>

@stop
@section('NombrePantalla')
    Detalle de afiliacion
@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Detalle de afiliacion</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('alertas.flash')
                            @include('alertas.errores')
                            <div class="center-block"> @include('alertas.errores')
                                @foreach($solicitud as $solicituds)



                                    <b> {!!Form::label('Nombre del Cliente: ')!!}</b>
                                    {{ $solicituds->ClienteNSolicitud->UsuarioNC->nombre}} {{ $solicituds->ClienteNSolicitud->UsuarioNC->apellido}}
                                    <br>

                                    <b> {!!Form::label('email del cliente: ')!!}</b>
                                    {{ $solicituds->ClienteNSolicitud->UsuarioNC->email}}
                                    <br>
                                    <b> {!!Form::label('Numero de afiliado:')!!}</b>
                                    {{$solicituds->numeroDeAfiliado}}
                                    <br>
                                    <b> {!!Form::label('Cuentas Cedeval: ')!!}</b><br>

                                    <?php
                                    $cuentas = $solicituds->ClienteNSolicitud->CuentaCedeval
                                    ?>
                                    <ul>
                                        @foreach($cuentas as $cuenta)
                                            <li>{{$cuenta->cuenta}}</li>
                                        @endforeach
                                    </ul>
                                @endforeach


                                @if($solicituds->idEstadoSolicitud==5)

                                    {!!link_to_route('SolicitudAfiliacion.procesar', $title = 'Procesar Solicitud ', $parameters = $solicituds->id, $attributes = ['class'=>'btn btn-info','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                @elseif($solicituds->idEstadoSolicitud==4)
                                    {!!link_to_route('SolicitudAfiliacion.aceptar', $title = 'Aceptar Solicitud ', $parameters = $solicituds->id, $attributes = ['class'=>'btn btn-info','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                    {!!Form::open(['route'=>['SolicitudAfiliacion.update', $solicituds->id], 'method'=>'PUT'])!!}
                                    <br>
                                    <br>                                    {!!Form::label('Motivo de rechazo: ')!!}
                                    <br>
                                    {{ Form::textarea('motivoDeRechazo', null, ['size' => '40x5']) }}<br>

                                    {!!Form::submit('Rechazar Solicitud', ['class'=>'btn btn-warning btn-flat','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'warning'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                    {!!Form::close()!!}
                                @elseif($solicituds->idEstadoSolicitud==3)
                                    <b> {!!Form::label('Motivo de rechazo: ')!!}</b>
                                    {{$solicituds->comentarioDeRechazo}}
                                @endif


                            </div>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
@stop