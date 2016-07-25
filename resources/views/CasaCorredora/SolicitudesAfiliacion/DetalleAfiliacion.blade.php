@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Usuario</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @if(Session::has('message'))
                                <div class="alert alert-{{Session::get('tipo')}} alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            <div class="center-block"> @include('alertas.errores')
                                @foreach($solicitud as $solicituds)

                                    <?php

                                    $roles = $solicituds->ClienteN->RolUsuarioNs;

                                    ?>

                                    @foreach($roles as $rol)
                                        <b> {!!Form::label('Nombre del Cliente: ')!!}</b>
                                        {{$rol->UsuarioN->nombre}} {{$rol->UsuarioN->apellido}}<br>

                                        <b> {!!Form::label('email del cliente: ')!!}</b>
                                        {{$rol->UsuarioN->email}}
                                        <br>
                                        <b> {!!Form::label('Numero de afiliado:')!!}</b>
                                        {{$solicituds->numeroDeAfiliado}}
                                        <br>
                                        <b> {!!Form::label('Cuentas Cedeval: ')!!}</b><br>
                                        {{$rol->UsuarioN->CuentaCedeval}}
                                        <?php
                                        $cuentas = $solicituds->ClienteN->CuentaCedeval
                                        ?>
                                        <ul>
                                            @foreach($cuentas as $cuenta)
                                                <li>{{$cuenta->cuenta}}</li>
                                            @endforeach
                                        </ul>
                                    @endforeach


                                    @if($solicituds->idEstadoSolicitud==1)
                                        {!!link_to_route('SolicitudAfiliacion.aceptar', $title = 'Aceptar Solicitud ', $parameters = $solicituds->id, $attributes = ['class'=>'btn btn-info'])!!}
                                        {!!Form::open(['route'=>['SolicitudAfiliacion.update', $solicituds->id], 'method'=>'PUT'])!!}
                                        <br>
                                        <br>                                    {!!Form::label('Motivo de rechazo: ')!!}
                                        <br>
                                        {{ Form::textarea('motivoDeRechazo', null, ['size' => '40x5']) }}<br>

                                        {!!Form::submit('Rechazar Solicitud', ['class'=>'btn btn-warning btn-flat'])!!}
                                        {!!Form::close()!!}
                                    @elseif($solicituds->idEstadoSolicitud==3)
                                        <b> {!!Form::label('Motivo de rechazo: ')!!}</b>
                                        {{$solicituds->comentarioDeRechazo}}
                                    @endif
                                @endforeach


                            </div>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop