@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Afiliados</title>

@stop



@section('NombrePantalla')
    Afiliados
@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Afiliados</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('alertas.flash')
                            @include('alertas.errores')
                            <br><br>

                            <div class="table-responsive">
                                @include('CasaCorredora.SolicitudesAfiliacion.formularios.buscarC')
                            </div>
                        </div>


                        @if (Session::has('cliente'))

                            <?php $clientes = \Session::get('cliente')?>

                            @foreach($clientes as $cliente)
                                <h3>Datos del Cliente</h3>
                                <b>Nombre: </b>  {{ $cliente->UsuarioNC->nombre}} {{ $cliente->UsuarioNC->apellido}}
                                <br>
                                <b>Email :</b>     {{ $cliente->UsuarioNC->email}}
                                <br>
                                <b>DUI: </b>      {{$cliente->dui}}
                                <br>
                                <b>NIT</b>  {{$cliente->nit}}
                                <br><br>
                                @include('CasaCorredora.SolicitudesAfiliacion.formularios.AfiliarCliente')

                            @endforeach

                        @endif
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop