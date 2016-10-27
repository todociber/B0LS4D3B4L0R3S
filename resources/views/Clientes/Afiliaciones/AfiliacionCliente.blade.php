@extends('layouts.ClientesLayout')

@section('title')
    <title>Detalle de orden</title>

@stop
@section('content')
    <script>
        $('#afiliaciones').addClass('active');
        $('#afiliarse').addClass('active')

    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nueva Afiliación</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alertas.errores')
                                        @include('alertas.flash')
                                        {{Form::open(['route'=>'afiliacioncasastore','method' =>'POST', 'onsubmit'=>'animatedLoading()', 'id'=>'form','role' => 'form'])  }}
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Casas corredors</label>
                                            {{Form::select('casas',$casas,null,['class'=>'form-control', 'id'=>'estado'])}}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('Codigo de afiliación') }}
                                            {{ Form::number('numeroafiliacion',null,['class'=>'form-control','placeholder'=>'Ingrese el codigo de afiliación', 'id'=>'afiliacion','required']) }}
                                        </div>

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary btn-flat">Afiliarse a una
                                                casa
                                            </button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div><!--row-->


                                <!-- /.box -->
                            </div>


                        </div>

                    </div><!-- /.box -->
                </div>
            </div>
        </div><!-- /.col -->
    </div>
@stop