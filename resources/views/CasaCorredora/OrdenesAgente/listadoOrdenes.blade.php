@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Ordenes</title>

@stop
@section('NombrePantalla')
    Ordenes asignadas
@stop
@section('content')

    <script>
        $(function () {
            /*  $('#casa').append($('<option>', {
             value: 0,
             text: 'Todas'
             }));*/
        });


    </script>
    <div class="row">
        <div class="col-xs-4">
            {{Form::open(['route'=>'ordenesbyestadoagent','method' =>'GET', 'id'=>'form'])  }}
            <div class="form-group">
                {{ Form::label('Filtra tus ordenes segun su estado') }}
                {!! Form::select('estado',$estadoOrdenes,$seleccionado=isset($selected) ? $selected: 0,['class'=>'form-control', 'id'=>'casa']) !!}

            </div>
            {!!Form::submit('Filtrar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit', 'onclick'=>"animatedLoading()"])!!}
            <br/>
            <br/>
            {{Form::close()}}
        </div>
        <div class="col-xs-12">

            @include('alertas.flash')
            @include('alertas.errores')

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ordenes Vigentes</h3>
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
                                                    <th><p class="text-center"><span
                                                                    class="glyphicon glyphicon-cog"></span>
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
        </div>
    </div>
@stop