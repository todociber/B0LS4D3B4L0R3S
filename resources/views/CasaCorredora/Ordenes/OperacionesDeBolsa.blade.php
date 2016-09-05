@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')


    <?php use Carbon\Carbon;?>


    @include('alertas.flash')
    @include('alertas.errores')



    @foreach($ordenes as $orden)
        <br><br>


        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice">
                        <h2 class="page-header">
                            <i class="fa fa-file-text-o"></i> Orden #{{$orden->correlativo}} <br/><br/>
                            Cliente: {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->nombre}} {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}
                            <small class="pull-right"><strong>Fecha de
                                    Registro:</strong> <?php $fecha = $orden->created_at;$fecha = $fecha->format('Y-m-d');?>{{$fecha}}
                            </small>
                            <br>
                            <small class="pull-right"><strong>Fecha de
                                    Vigencia:</strong><?php echo Carbon::createFromFormat('Y-m-d', $orden->FechaDeVigencia)->toDateString();?>
                            </small>
                            <br>
                        </h2>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">


                                <b>Tipo de orden: </b> {{$orden->TipoOrdenN->nombre}} <br>
                                <b>Titulo: </b>{{$orden->titulo}}<br>
                                <b>Cuenta cedeval: </b>{{$orden->CuentaCedeval->cuenta}} <br>
                                <b>Precio minimo: </b>{{$orden->valorMinimo}}<br>
                                <b>Precio máximo: </b>{{$orden->valorMaximo}}<br>
                                <b>Monto: </b>{{$orden->monto}}<br>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Tipo de ejecución:</b>{{$orden->TipoEjecucionN->forma}}<br>
                                <b>Estado:</b><span style="color:orangered"> {{$orden->EstadoOrden->estado}}</span>


                            </div>
                            <div class="col-sm-4 invoice-col">


                            </div>
                        </div><!-- /.box-info -->
                        <div class="row">
                            <div class="form-group col-md-6">


                                {!!Form::label('Agente Corredor: ')!!} {{$orden->Corredor_UsuarioN->nombre}} {{$orden->Corredor_UsuarioN->apellido}}
                                <br>{!! Form::label('Comision') !!} {{$orden->comision}}%


                                <div class="row">
                                    <div class="col-md-12 text-right">


                                    </div>
                                </div>
                            </div><!-- /.box -->


                        </div><!-- /.col -->
                    </div><!-- /.row -->

        </section>
    @endforeach

@stop