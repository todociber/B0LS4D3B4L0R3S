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


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Reasignar Ordenes</h3>
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
                                    <table id="example1" class="table table-hover dt-responsive display nowrap"
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

                                            <tr>
                                                <td>

                                                    {!!link_to_route('Ordenes.Reasignacion.NuevoAgente', $title = 'ReAsignar', $parameters = [$orden->id,$orden->idCorredor], $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}


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