@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Usuarios</title>

@stop
@section('NombrePantalla')
    Usuarios
@stop

@section('content')
    <script>
        function ShowModalDesactivar(id, texto) {
            $('#modalbody').text(texto);
            $('#idusuario').val(id);
            $('#desactivarUsuario').modal('show');
        }
        function ShowModalActivar(id, texto) {
            $('#modalbodyR').text(texto);
            $('#idrestaurar').val(id);
            $('#activarUsuario').modal('show');
        }

    </script>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Usuarios</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('alertas.flash')
                            {!!link_to_route('UsuarioCasaCorredora.crear', $title = 'Crear Usuario ', $parameters = [], $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            <br><br>

                            <div class="table-responsive">
                                <table id="example1" class="table table-hover dt-responsive display nowrap"
                                       cellspacing="0">
                                <thead>
                                <tr>

                                    <th><p class="text-center">Nombre</p></th>
                                    <th><p class="text-center">Apellido</p></th>
                                    <th><p class="text-center">Correo</p></th>
                                    <th><p class="text-center">Roles</p></th>
                                    <th><p class="text-center">Estado</p></th>
                                    <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Usuarios as $users)
                                    <tr>

                                        <td>{{$users->nombre}}</td>
                                        <td>{{$users->apellido}}</td>
                                        <td>{{$users->email}}</td>
                                        <?php $roles = $users->UsuarioRoles ?>
                                        <td>@foreach($roles as $rolUsuario)
                                                {{$rolUsuario->RolN->nombre}}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($users->deleted_at == null)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif
                                        </td>
                                        <td>

                                            <a class="btn btn-primary background-pencil"
                                               href="{{route('UsuarioCasaCorredora.edit',["id"=>$users->id])}}"><em
                                                        class="fa fa-pencil"></em></a>
                                            @if($users->deleted_at == null)





                                                <button type="submit" onclick="">
                                                    <span class="glyphicon glyphicon-remove p-red"
                                                          onclick="ShowModalDesactivar('{{$users->id}}','¿Desea desactivar al usuario {{$users->nombre}}?')"></span>
                                                </button>


                                            @else

                                                <button onclick="ShowModalActivar('{{$users->id}}','¿Desea activar al usuario {{$users->nombre}}?')">
                                                    <span class="glyphicon glyphicon-ok p-green"></span>
                                                </button>


                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                <div>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="desactivarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                {{Form::open(['route'=>'UsuarioCasaCorredora.desactivar','method' =>'DELETE', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()']) }}

                {{ Form::hidden('id',null,['id'=>'idusuario','class'=>'form-control','required']) }}
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

    <div class="modal fade" id="activarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                {{Form::open(['route'=>'UsuarioCasaCorredora.restaurar','method' =>'PUT', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()']) }}

                {{ Form::hidden('id',null,['id'=>'idrestaurar','class'=>'form-control','required']) }}
                <div class="modal-body">
                    <p id="modalbodyR"></p>
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