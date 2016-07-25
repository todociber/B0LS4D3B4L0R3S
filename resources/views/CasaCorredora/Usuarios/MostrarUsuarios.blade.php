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
                            {!!link_to_route('UsuarioCasaCorredora.crear', $title = 'Crear Usuario ', $parameters = [], $attributes = ['class'=>'btn btn-success'])!!}
                            <br><br>

                            <table id="example1" class="table table-hover">
                                <thead>
                                <tr>
                                    <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                                    <th><p class="text-center">Nombre</p></th>
                                    <th><p class="text-center">Apellido</p></th>
                                    <th><p class="text-center">Correo</p></th>
                                    <th><p class="text-center">Roles</p></th>
                                    <th><p class="text-center">Estado</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Usuarios as $users)
                                    <tr>
                                        <td>{!!link_to_route('UsuarioCasaCorredora.edit', $title = ' Editar Usuario ', $parameters = $users->id, $attributes = ['class'=>'btn btn-primary'])!!}
                                            <br><br>
                                            @if(Auth::user()->id== $users->id)

                                            @else
                                                @if($users->deleted_at == null)
                                                    {!!Form::open(['route'=>['UsuarioCasaCorredora.destroy', $users->id], 'method'=>'DELETE'])!!}
                                                    {!!Form::submit('Desactivar  Usuario ', ['class'=>'btn btn-danger'])!!}
                                                    {!!Form::close()!!}
                                                @else
                                                    {!!link_to_route('UsuarioCasaCorredora.restaurar', $title = 'Activar Usuario ', $parameters = $users->id, $attributes = ['class'=>'btn btn-warning'])!!}
                                                @endif
                                            @endif


                                        </td>
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