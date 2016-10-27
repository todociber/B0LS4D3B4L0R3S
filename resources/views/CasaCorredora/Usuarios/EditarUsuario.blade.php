@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title> Editar Usuario</title>

@stop
@section('NombrePantalla')
    Editar Usuario
@stop

@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Editar Usuario</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('alertas.errores')

                            {!!Form::model($usuarios, ['route'=>['UsuarioCasaCorredora.update', $usuarios->id], 'method'=>'PUT', 'onsubmit'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            @include('CasaCorredora.Usuarios.formularios.formularioUsuario')

                            <ul class="list-inline">
                                <li>{!!Form::submit('Guardar', ['class'=>'btn btn-primary btn-flat'])!!}</li>
                                @if($usuarios->id!= Auth::user()->id)

                                    <li>
                                        <button data-toggle="modal" data-target="#reiniciarPassword" type="button"
                                                class="btn btn-success">Restaurar contraseña
                                        </button>
                                    </li>

                            @endif
                                {!!Form::close()!!}
                            </ul>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reiniciarPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>

                <div class="modal-body">
                    <p id="modalbodyR">¿Desea restaurar la contraseña de este usuario?</p>
                </div>
                <div class="modal-footer">
                    <button onclick="window.location.href = '{{route('UsuarioCasaCorredora.resetearpassword',['id'=>$usuarios->id])}}';animatedLoading()"
                            class="btn btn-primary">Restaurar
                    </button>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@stop