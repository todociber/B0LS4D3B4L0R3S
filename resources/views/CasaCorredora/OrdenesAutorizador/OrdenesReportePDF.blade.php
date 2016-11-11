<?php use Carbon\Carbon;?>

<html>
<head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Bootstrap 3.3.5 -->
    <style>
        <?php include(public_path() . '/assets/css/bootstrap.css');?>
        <?php include(public_path() . '/assets/dist/css/AdminLTE.css');?>
        <?php include(public_path() . '/assets/dist/css/skins/_all-skins.css');?>
        <?php include(public_path() . '/assets/css/font-awesome.css');?>

        @page teacher {
            size: A4 portrait;
            margin: 2cm;
        }

        .teacherPage {
            page: teacher;
            page-break-after: always;
        }
    </style>
</head>
<body style="height: 300px;!important; background: white;">


<?php $nVueltas = 0; ?>
@foreach($ordenes as $orden)

    @if($nVueltas==0)
        <?php $nVueltas = 1;?>
    @else
        <hr>
    @endif
    <div class="row teacherPage">
        <div class="col-md-12">
            <div class="invoice">
                <h2 class="page-header">
                    <i class="fa fa-file-text-o"></i> Orden #{{$orden->correlativo}} <br><br>
                    Cliente: {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->nombre}} {{$orden->CuentaCedeval->clientesCuenta->UsuarioNC->apellido}}
                    <br>
                    <small class="pull-right"><strong>Fecha de
                            Registro:</strong> <?php $fecha = $orden->created_at;$fecha = $fecha->format('Y-m-d');?>{{$fecha}}
                    </small>
                    <br>
                    <small class="pull-right"><strong>Fecha de
                            Vigencia:</strong><?php echo Carbon::createFromFormat('Y-m-d', $orden->FechaDeVigencia)->toDateString();?>
                    </small>
                    <br>
                </h2>

                <div class="row invoice-info">
                    <div class="col-md-4 invoice-col">
                        <b>Casa corredora: </b> {{$orden->OrganizacionOrdenN->nombre}}<br>

                        <b>Tipo de mercado: </b> {{$orden->TipoMercado}}<br>

                        <b>Tipo de orden: </b> {{$orden->TipoOrdenN->nombre}}<br>

                        <b>Titulo: </b>{{$orden->titulo}}<br>

                        <b>Cuenta cedeval: </b> {{$orden->CuentaCedeval->cuenta}}<br>


                        <b>Precio minimo: </b> {{$orden->valorMinimo}}<br>

                        <b>Precio máximo: </b> {{$orden->valorMaximo}}<br>

                        <b>Monto: </b> {{$orden->monto}} <br>



                    </div>

                </div>
                <div class="row invoice-info">
                    <div class="col-md-8">

                        <div class="text-right">
                            <b>Tipo de ejecución:</b> {{$orden->TipoEjecucionN->forma}} <br>

                            <b>Estado:</b> <span style="color:orangered"> {{$orden->EstadoOrden->estado}}</span><br>

                            @if($orden->Corredor_UsuarioN()->count()>0)
                                <b>Agente
                                    Corredor: </b> {{$orden->Corredor_UsuarioN->nombre}} {{$orden->Corredor_UsuarioN->apellido}}
                                <br>
                                <b>Comision: </b>{{$orden->comision}}%<br>
                            @endif


                        </div>
                    </div><!-- /.col -->
                </div><!-- /.col -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    </div>

    <!-- /.row -->
@endforeach



</body>
</html>