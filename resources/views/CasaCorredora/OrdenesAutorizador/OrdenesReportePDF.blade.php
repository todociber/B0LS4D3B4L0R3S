<?php use Carbon\Carbon;?>

<html>
<head>
    <style>

        html {
            margin: 0;
        }

        body {
            font-family: "Times New Roman", serif;
            margin: 15mm 8mm 2mm 8mm;
        }

        hr {
            page-break-after: always;
            border: 0;
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body>
<style>

    html {
        margin: 0;
    }

    body {
        font-family: "Times New Roman", serif;
        margin: 15mm 8mm 2mm 8mm;
    }

    hr {
        page-break-after: always;
        border: 0;
        margin: 0;
        padding: 0;
    }

</style>
<?php $nVueltas = 0; ?>
@foreach($ordenes as $orden)

    @if($nVueltas==0)
        <?php $nVueltas = 1;?>
    @else
        <hr>
    @endif
    <div class="col-xs-12">
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
                <div class="col-sm-4 invoice-col">


                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="width:75%">
                        <tbody>
                        <tr>
                            <td><b>Casa corredora: </b></td>
                            <td>{{$orden->OrganizacionOrdenN->nombre}}</td>
                        </tr>
                        <tr>
                            <td><b>Tipo de mercado: </b></td>
                            <td>{{$orden->TipoMercado}}</td>
                        </tr>
                        <tr>
                            <td><b>Tipo de orden: </b></td>
                            <td>{{$orden->TipoOrdenN->nombre}}</td>
                        </tr>
                        <tr>
                            <td><b>Titulo: </b></td>
                            <td>{{$orden->titulo}}</td>
                        </tr>
                        <tr>
                            <td><b>Cuenta cedeval: </b></td>
                            <td> {{$orden->CuentaCedeval->cuenta}}</td>
                        </tr>
                        <tr>
                            <td><b>Precio minimo: </b></td>
                            <td> {{$orden->valorMinimo}}</td>
                        </tr>
                        <tr>
                            <td><b>Precio máximo: </b></td>
                            <td> {{$orden->valorMaximo}}<</td>
                        </tr>
                        <tr>
                            <td><b>Monto: </b></td>
                            <td>{{$orden->monto}}</td>
                        </tr>
                        <tr>
                            <td><b>Tipo de ejecución:</b></td>
                            <td> {{$orden->TipoEjecucionN->forma}}</td>
                        </tr>
                        <tr>
                            <td><b>Estado:</b></td>
                            <td><span style="color:orangered"> {{$orden->EstadoOrden->estado}}</span></td>
                        </tr>
                        @if($orden->Corredor_UsuarioN()->count()>0)
                        <tr>
                            <td><b>Agente Corredor: </b></td>
                            <td> {{$orden->Corredor_UsuarioN->nombre}} {{$orden->Corredor_UsuarioN->apellido}}</td>
                        </tr>

                        <tr>
                            <td><b>Comision </b></td>
                            <td> {{$orden->comision}}%</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>

                    @endforeach

                    <br><br>


                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

</body>
</html>