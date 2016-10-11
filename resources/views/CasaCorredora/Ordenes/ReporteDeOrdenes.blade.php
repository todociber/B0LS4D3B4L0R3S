@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Ordenes</title>

@stop
@section('NombrePantalla')
    Ordenes
@stop
@section('content')
    @include('alertas.flash')
    @include('alertas.errores')
    <script>
        var contador = 0;
        var clonar;
        $(function () {
            //$.fn.datepicker.defaults.language = 'es';
            $('#datepicker').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                cursor: 'pointer',
                maxDate: '-18Y',
                minDate: '-100Y',
                yearRange: '-100'
            });

        });

    </script>

    <script>
        var contador = 0;
        var clonar;
        $(function () {
            //$.fn.datepicker.defaults.language = 'es';
            $('#datepicker2').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                cursor: 'pointer',
                maxDate: '-18Y',
                minDate: '-100Y',
                yearRange: '-100'
            });

        });

    </script>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Reporte de Ordenes</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">


            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            Descargar Reporte General : <br>
                            {!!link_to_route('OrdenesReporte.PDF', $title = 'Reporte General ', $parameters = [], $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            <br>


                            @include('CasaCorredora.Ordenes.formularios.ReporteFechas')
                            <h6>Puede especificar o no fechas para el rango de busqueda</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop