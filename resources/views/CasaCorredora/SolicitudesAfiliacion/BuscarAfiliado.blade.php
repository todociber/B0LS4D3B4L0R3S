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

                            @if(Session::has('solicitud'))

                                <?php $solicitud = \Session::get('solicitud')?>
                            @endif

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
                                    <b>Telefonos</b>
                                    @foreach($cliente->TelefonosUsuario as $telefono)
                                        <li>
                                            Telefono: {{$telefono->numero}} {{$telefono->TipoTelefonoN->tipo}}
                                        </li>

                                    @endforeach

                                    <br>
                                    <b>Direccion: </b>
                                    @foreach($cliente->DireccionesUsuario as $direccion)
                                        <br>
                                        <li>
                                            <b>Departamento:</b> {{$direccion->MunicipioDireccion->Departamento->nombre}}
                                        </li>
                                        <li><b>Municipio:</b> {{$direccion->MunicipioDireccion->nombre}}</li>
                                        <li><b>Detalle: </b>{{$direccion->detalle}}</li>

                                    @endforeach
                                    @if($solicitud[0]>0)

                                    <h2> El Cliente ya se encuentra Afiliado</h2>
                                @else
                                        <?php $info = \Session::get('clienteInfo')?>
                                        <h4>{{$info[0]}}</h4>
                                @include('CasaCorredora.SolicitudesAfiliacion.formularios.AfiliarCliente')
                                @endif
                            @endforeach

                        @endif
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop