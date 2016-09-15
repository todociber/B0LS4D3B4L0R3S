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

                            @if (Session::has('EditarUsuario'))

                            @else

                                <br>
                                <br>{!!Form::open(['route'=>['UsuarioCasaCorredora.destroy', $usuario[0]->id], 'method'=>'DELETE'])!!}
                                {!!Form::submit('Desactivar  Usuario ', ['class'=>'btn btn-danger','onclick'=>"waitingDialog.show('Desactivando Espere... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                {!!Form::close()!!}

                            @endif


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
                                            @if($orden->idEstadoOrden==1)
                                                {!!link_to_route('Ordenes.asignar', $title = 'Asignar', $parameters = $orden->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                            @else
                                                {!!link_to_route('Ordenes.detallesEliminar', $title = 'ReAsignar', $parameters = $orden->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                            @endif


                                        </td>
                                        <td> {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}</td>
                                        <td>{{$orden->monto}}</td>
                                        <td>{{$orden->TipoMercado}}</td>


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