@extends('layouts.ClientesLayout')

@section('title')
    <title>Listado de ordenes</title>

@stop
@section('content')
<script>
    $('#ordenes').addClass('active');
    $('#listadoOrdenes').addClass('active')
</script>
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Ordenes</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-hover">
                    <thead>
                    <tr>

                        <th><p class="text-center">Correlativo</p></th>
                        <th><p class="text-center">Tipo</p></th>
                        <th><p class="text-center">Mercado</p></th>
                        <th><p class="text-center">Monto de inversión</p></th>
                        <th><p class="text-center">Fecha de vencimiento</p></th>
                        <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ordenes as $orden)
                    <tr>

                        <td>{{$orden->correlativo}}</td>
                        <td>{{$orden->TipoOrdenN->nombre}}</td>
                        <td>{{$orden->mercado}}</td>
                        <td>{{$orden->monto}}</td>
                        <td>{{$orden->FechaDeVigencia}}</td>
                        <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                        class="fa fa-archive" aria-hidden="true"></i></a>
                            <a class="btn btn-primary" style="background-color:#444444; "><em class="fa fa-pencil"></em></a>

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