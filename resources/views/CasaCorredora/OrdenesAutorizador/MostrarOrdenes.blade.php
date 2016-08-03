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
                            @include('alertas.flash')
                            @include('alertas.errores')

                            <br><br>

                            <table id="example1" class="table table-hover">
                                <thead>
                                <tr>
                                    <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                                    <th><p class="text-center">Cliente</p></th>
                                    <th><p class="text-center">Monto</p></th>
                                    <th><p class="text-center">Tipo de Mercado</p></th>

                                    <th><p class="text-center">Estado</p></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ordenes as $orden)
                                    <tr>
                                        <td>

                                            {!!link_to_route('Ordenes.asignar', $title = 'Detalles', $parameters = $orden->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

                                        </td>
                                        <td>{{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->nombre}}  {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}</td>
                                        <td>{{$orden->monto}}</td>
                                        <td>{{$orden->TipoMercadoN->nombre}}</td>


                                        <td>
                                            {{$orden->EstadoOrden->estado}}
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop