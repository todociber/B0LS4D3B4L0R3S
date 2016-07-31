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

                                            botones


                                        </td>
                                        <td>{{$orden->ClientesN->RolUsuarioNs->UsuarioN->nombre}}  {{$orden->ClientesN->RolUsuarioNs->UsuarioN->apellido}}</td>
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