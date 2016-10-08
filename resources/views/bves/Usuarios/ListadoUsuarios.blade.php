@extends('layouts.bolsavalores')
@section('title')
    <title>Catálogo de usuarios</title>
@stop
@section('content')
    <script>
        $('#usuarios').addClass('active');
        $('#catalogo').addClass('active');
        function desactivarActivarCasa(nombre, activar, id, accion) {
            $('#modalbody').text("¿Desea " + activar + "la casa " + nombre + " ?");
            $('#idusuario').val(id);
            $('#tipo').val(accion);

        }

    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @include('alertas.flash')
                    <h3 class="box-title">Lista de Usuarios</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->created_at}}</td>
                                <td>@if($usuario->deleted_at == null)
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
                                       href="{!! route('modificarusuario',['id'=>$usuario->id])!!}"><em
                                                class="fa fa-pencil"></em></a>
                                    @if($usuario->deleted_at == null)

                                        <button onclick="desactivarActivarCasa('{{$usuario->nombre}}','Desactivar','{{$usuario->id}}',0); "
                                                data-toggle="modal" data-target="#desactivarActivarUsuario">
                                            <span class="glyphicon glyphicon-remove p-red"></span></button>


                                    @else

                                        <button onclick="desactivarActivarCasa('{{$usuario->nombre}}','Activar','{{$usuario->id}}',1); "
                                                data-toggle="modal" data-target="#desactivarActivarUsuario">
                                            <span class="glyphicon glyphicon-ok p-green"></span></button>

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
    <div class="modal fade" id="desactivarActivarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                {{Form::open(['route'=>'eliminarrestaurar','method' =>'POST', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()']) }}

                {{ Form::hidden('id',null,['id'=>'idusuario','class'=>'form-control','required']) }}
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

