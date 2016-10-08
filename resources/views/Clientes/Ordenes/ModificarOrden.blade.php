@extends('layouts.ClientesLayout')

@section('title')
    <title>Modificar orden</title>

@stop
@section('content')
    <script>
        $(function () {
            var fecha = '<?php echo $orden->FechaDeVigencia?>';
            console.log('fecha ' + fecha);
            //$.fn.datepicker.defaults.language = 'es';
            $('#datepicker').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                cursor: 'pointer',
                setDate: fecha


            });

        });
        $('#ordenes').addClass('active');
        $('#nuevaOrden').addClass('active');
    </script>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Modificar orden</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        @include('alertas.errores')
                        @include('alertas.flash')
                        {{Form::model($orden,['route'=>['Clientes.update', $orden->id],'method' =>'PUT', 'id'=>'form','role' => 'form','onsubmit'=>'animatedLoading()'])  }}
                        @include('Clientes.Ordenes.FormularioOrden.FormularioOrden')

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">Modificar Orden</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div><!--row-->


                <!-- /.box -->
            </div>
        </div>
    </div>
@stop