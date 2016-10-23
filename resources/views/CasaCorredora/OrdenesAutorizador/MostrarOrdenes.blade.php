@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Ordenes</title>

@stop
@section('NombrePantalla')
    Ordenes
@stop
@section('content')
    <?php use App\Utilities\RolIdentificador;
    $rol = new RolIdentificador();
    ?>

    @include('alertas.flash')
    @include('alertas.errores')

    <div class="row">

        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$ordenesCount}}</h3>

                    <p>Ordenes vigentes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$ordenesVencer}}</h3>

                    <p>Ordenes a vencer en los proximos 6 dias</p>
                </div>
                <div class="icon">
                    <i class="fa fa-exclamation-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$CountSolicitudes}}</h3>

                    <p>Solicitudes de aprobación de información</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>

    </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ordenes pendientes de asignacion</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">


                <div role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">


                                <br><br>

                                <div style="width: 100%; padding-left: -10px; border: 0px;">
                                    <div class="table-responsive">
                                        <table id="example4" class="table table-hover dt-responsive display nowrap"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span>
                                                    </p></th>
                                                <th><p class="text-center">Correlativo</p></th>
                                                <th><p class="text-center">Cliente</p></th>
                                                <th><p class="text-center">Monto</p></th>
                                                <th><p class="text-center">Fecha de vigencia</p></th>
                                                <th><p class="text-center">Tipo de Mercado</p></th>

                                                <th><p class="text-center">Estado</p></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($ordenes as $orden)
                                                @if($orden->idEstadoOrden==1)
                                                    <tr>
                                                        <td>

                                                            {!!link_to_route('Ordenes.detalles', $title = 'Detalles', $parameters = $orden->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}


                                                        </td>
                                                        <td>{{$orden->correlativo}}</td>
                                                        <td> {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->nombre}}  {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}</td>
                                                        <td>{{$orden->monto}}</td>
                                                        <td>{{$orden->FechaDeVigencia}}</td>
                                                        <td>{{$orden->TipoMercado}}</td>


                                                        <td>
                                                            {{$orden->EstadoOrden->estado}}
                                                        </td>
                                                    </tr>
                                                @endif

                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div><!--row-->


                        <!-- /.box -->
                    </div>
                </div>

            </div>
        </div>
@stop