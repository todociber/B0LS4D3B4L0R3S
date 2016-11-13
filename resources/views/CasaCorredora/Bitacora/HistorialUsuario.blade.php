@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Usuarios</title>

@stop
@section('NombrePantalla')
    Usuarios
@stop

@section('content')
    <script>
        $('#bitacoras').addClass('active');
        $('#bitacora').addClass('active');


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
                    <h3 class="box-title">Lista de roles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover dataTable dt-responsive">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>nombre del rol</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de Finalizacion</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $rol)
                            <tr>
                                <td>{{$rol->NombreUsuario}} {{$rol->ApellidoUsuarios}}
                                <td>{{$rol->email}}</td>
                                <td>{{$rol->nombreRol}}</td>
                                <td>{{$rol->created_at}}</td>
                                <td>
                                    @if($rol->deleted_at==null)
                                        @if($rol->UsuarioBorrado==null)
                                            Rol Activo Actualmente
                                        @else
                                            {{$rol->UsuarioBorrado}}
                                        @endif
                                    @else
                                        {{$rol->deleted_at}}
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