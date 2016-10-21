@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Usuarios</title>

@stop
@section('NombrePantalla')
    Usuarios
@stop

@section('content')


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
                                        <td>
                                            <br><br>
                                            @if(Auth::user()->id== $users->id)
                                                <a class="btn btn-primary background-pencil"
                                                   href="{{route('UsuarioCasaCorredora.edit')}}"><em
                                                            class="fa fa-pencil"></em></a>
                                                {!!link_to_route('UsuarioCasaCorredora.edit', $title = ' Editar Usuario ', $parameters = $users->id, $attributes = ['class'=>'btn btn-primary  background-penci','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                            @else
                                                @if($users->deleted_at == null)
                                                    {!!link_to_route('UsuarioCasaCorredora.edit', $title = ' Editar Usuario ', $parameters = $users->id, $attributes = ['class'=>'btn btn-primary','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                                                    <br>
                                                    {!!Form::open(['route'=>['UsuarioCasaCorredora.destroy', $users->id], 'method'=>'DELETE'])!!}
                                                    <button class="btn " type="sumbit"><em
                                                                class="fa fa-pencil"></em></button>
                                                    {!!Form::close()!!}
                                                @else
                                                    {!!link_to_route('UsuarioCasaCorredora.restaurar', $title = 'Activar Usuario ', $parameters = $users->id, $attributes = ['class'=>'btn btn-warning','onclick'=>"waitingDialog.show('Activando Espere... ',{ progressType: 'warning'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
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
                                <div>
                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop