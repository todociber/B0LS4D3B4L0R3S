@extends('layouts.ClientesLayout')

@section('title')
    <title>Listado de ordenes</title>

@stop
@section('content')
<script>
    $('#ordenes').addClass('active');
    $('#listadoOrdenes').addClass('active')

</script>
<h2>
    Ordenes de compra y venta de acciones

</h2>
    <div class="row">
        <div class="col-xs-4">
            {{Form::open(['route'=>'filtrarOrden','method' =>'GET', 'id'=>'form'])  }}
            <div class="form-group">
                {{ Form::label('Filtra tus ordenes segun su estado') }}
                {!! Form::select('estado',$estadoOrdenes,$seleccionado=isset($selected) ? $selected: null,['class'=>'form-control', 'id'=>'casa']) !!}

            </div>
            {!!Form::submit('Filtrar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit', 'onclick'=>"animatedLoading()"])!!}

            {{Form::close()}}
        </div>
    <div class="col-xs-12">
        @include('alertas.errores')
        @include('alertas.flash')

        <br/>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Ordenes</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-hover">
                    <thead>
                    <tr>

                        <th><p class="text-center">Casa corredora</p></th>
                        <th><p class="text-center">Correlativo</p></th>
                        <th><p class="text-center">Tipo</p></th>
                        <th><p class="text-center">Mercado</p></th>
                        <th><p class="text-center">Monto de inversión</p></th>
                        <th><p class="text-center">Fecha de vencimiento</p></th>
                        <th><p class="text-center">Estado orden</p></th>
                        <th><p class="text-center">Fecha de creación</p></th>
                        <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ordenes as $orden)
                    <tr>

                        <td>{{$orden->OrganizacionOrdenN->nombre}}</td>
                        <td>{{$orden->correlativo}}</td>
                        <td>{{$orden->TipoOrdenN->nombre}}</td>
                        <td>{{$orden->TipoMercado}}</td>
                        <td>{{$orden->monto}}</td>
                        <td>{{$orden->FechaDeVigencia}}</td>
                        <td>{{$orden->EstadoOrden->estado}}</td>
                        <td>{{$orden->created_at}}</td>
                        <td class="text-center"><a class="btn-table" href="{{route('getOrdenes',['id'=>$orden->id])}}">
                                <i
                                        class="fa fa-archive" aria-hidden="true"></i></a>
                            @if($orden->idEstadoOrden == 1 || $orden->idEstadoOrden==2)
                                <a class="btn btn-primary background-pencil"
                                   href="{{route('modificarorden',['id'=>$orden->id])}}"><em class="fa fa-pencil"></em></a>
                            @endif
                        </td>

                    </tr>
                    @endforeach

                    </tbody>

                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    </div>
@stop