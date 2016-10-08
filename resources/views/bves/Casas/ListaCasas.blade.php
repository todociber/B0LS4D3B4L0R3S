@extends('layouts.bolsavalores')

@section('title')
    <title>Listado de casas inscritas</title>
@stop
@section('content')
    <script>
        $('#casas').addClass('active');
        $('#catalogoCasas').addClass('active');


        function desactivarActivarCasa(nombre, activar, id, accion) {
            $('#modalbody').text("¿Desea " + activar + "la casa " + nombre + " ?");
            $('#idcasa').val(id);
            $('#tipo').val(accion);

        }

    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @include('alertas.flash')
                    <h3 class="box-title">Lista de casas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover dataTable dt-responsive">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Télefono</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($organizaciones as $organizacion)
                            <tr>
                                <td>{{$organizacion->id}}</td>
                                <td>{{$organizacion->codigo}}</td>
                                <td>{{$organizacion->nombre}}</td>
                                <td>{{$organizacion->correo}}</td>
                                <td>{{$organizacion->direccion}}</td>
                                <td>{{$organizacion->telefono}}</td>
                                <td>{{$organizacion->created_at}}</td>
                                <td>@if($organizacion->deleted_at == null)
                                        <p class="p-green">
                                            Activo
                                        </p>
                                    @else
                                        <p class="p-red">
                                            Innactivo
                                        </p>
                                    @endif
                                </td>

                                <td><a class="btn btn-primary background-pencil"
                                       href="{!! route('editarCasa',['id'=>$organizacion->id])!!}"><em
                                                class="fa fa-pencil"></em></a>
                                    @if($organizacion->deleted_at == null)

                                        <button onclick="desactivarActivarCasa('{{$organizacion->nombre}}','Desactivar','{{$organizacion->id}}',0); "
                                                data-toggle="modal" data-target="#desactivarActivarCasa">
                                            <span class="glyphicon glyphicon-remove p-red"></span></button>

                                    @else

                                        <button onclick="desactivarActivarCasa('{{$organizacion->nombre}}','Activar','{{$organizacion->id}}',1);"
                                                data-toggle="modal" data-target="#desactivarActivarCasa">
                                            <span class="glyphicon glyphicon-ok p-green"></span></button>


                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.col -->

    <div class="modal fade" id="desactivarActivarCasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                {{Form::open(['route'=>'eliminarrestaurarcasas','method' =>'POST', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()']) }}

                {{ Form::hidden('id',null,['id'=>'idcasa','class'=>'form-control','required']) }}
                {{ Form::hidden('tipo',null,['id'=>'tipo','class'=>'form-control', 'required']) }}
                <div class="modal-body">
                    <p id="modalbody"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cancelar</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@stop