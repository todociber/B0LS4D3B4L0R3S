@extends('layouts.bolsavalores')

@section('title')
    <title>Listado de casas inscritas</title>
@stop
@section('content')
    <script>
        $('#bitacoras').addClass('active');
        $('#bitacora').addClass('active');




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
                            <th>Usuario</th>
                            <th>Descripción</th>
                            <th>Fecha de realización</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bitacoras as $bitacora)
                            <tr>
                                <td>{{$bitacora->id}}</td>
                                <td>{{$bitacora->nombre}}</td>
                                <td>{{$bitacora->descripcion}}</td>
                                <td>{{$bitacora->created_at}}</td>
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