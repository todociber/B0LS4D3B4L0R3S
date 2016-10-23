<?php use Carbon\Carbon;?>

<html>
<head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Bootstrap 3.3.5 -->
    {!! Html::style('assets/css/bootstrap.css') !!}
            <!-- Font Awesome -->
    {!! Html::style('assets/css/font-awesome.css') !!}
            <!-- Ionicons -->
    <!-- Theme style -->
    {!! Html::style('assets/dist/css/AdminLTE.css') !!}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('assets/dist/css/skins/_all-skins.css') !!}

            <!--  SERO CSS -->
    {!! Html::style('assets/css/SERO.css') !!}
            <!-- jQuery 2.1.4 -->


</head>
<body>

<div class="col-xs-12">
    <div class="invoice">
        <h2 class="page-header">
            @foreach($ordenes as $orden)
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