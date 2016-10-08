@extends('layouts.ClientesLayout')
@section('title')
    <title>Mi Perfil</title>
@stop
@section('content')
    <script>

    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">

                    @include('alertas.errores')
                    @include('alertas.flash')
                    <div class=" col-md-12 toppad">
                        <div class="row">

                            <div class=" col-md-12 ">

                                <table class="table table-user-information">
                                    <tbody>
                                    <th>Correlativo</th>
                                    <th>Fecha de orden</th>
                                    <th>Estado</th>
                                    <th>Ver</th>


                                    @foreach($ordenes as $orden)
                                        <tr>
                                            <td>{{$orden->correlativo}}</td>
                                            <td>{{\Carbon\Carbon::parse($orden->created_at)->format('m-d-Y')}}</td>
                                            <td>{{$orden->EstadoOrdenN->estado}}</td>
                                            <td><a class="btn btn-primary"
                                                   href="{{route('getOrdenes',['id'=>$orden->id])}}">
                                                    ver orden
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



@stop