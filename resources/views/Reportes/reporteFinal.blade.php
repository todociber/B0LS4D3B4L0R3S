<?php use Carbon\Carbon;?>

<html>
<head>
    <!-- Tell the browser to be responsive to screen width -->

    <!-- Bootstrap 3.3.5 -->
    <style>
        <?php include(public_path() . '/assets/css/bootstrap.min.css');?>

    </style>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

</head>
<style>

    .divSquare {

        border-style: solid;
        border-color: black;
        width: 25px;
        height: 25px;

    }

    .square-image {
        width: 60px;
        height: 60px;

    }

    body {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }

    ul {
        list-style-type: none;
    }

    .display-table {
        display: table;
        table-layout: fixed;
    }

    .display-cell {
        display: table-cell;
        vertical-align: middle;
        float: none;
    }

    .margin-bottom-div {
        margin-bottom: 50px;

    }

    .margin-bottom-col {
        margin-bottom: 40px;
        margin-top: 40px;

    }

    .margin-bottom-col-t {
        margin-top: 10px;

    }

    .p-format {
        border-bottom: 1px solid black;
        padding-left: 60px;
        width: 270px;
        margin-bottom: 1px !important;

    }

    .p-format-money {
        border-bottom: 1px solid black;
        padding-left: 80px;
        width: 270px;
        margin-bottom: 1px !important;

    }

    .p-format-tipo {
        border-bottom: 1px solid black;
        padding-left: 80px;
        width: 270px;
        margin-bottom: 1px !important;

    }

    .p-format-right {
        border-bottom: 1px solid black;
        padding-left: 10px;
        width: 70px;
        margin-bottom: 1px !important;

    }

    .p-format-cd {
        border-bottom: 1px solid black;
        padding-left: 10px;
        width: 100px;
        margin-bottom: 1px !important;

    }

    .vertical-align {
        display: flex !important;
        align-items: center !important;
    }

    .move-rigth {
        margin-left: 100px;
    }

    .move-left {
        margin-right: 220px !important;
        margin-left: 70px !important;
    }
</style>
<body>
<div class="div-border">
    <div class="row display-table">
        <div class="col-xs-4 display-cell">
            <img class="img-responsive" src="<?php echo public_path() . "/assets/img/bolsa_logo.png";?>"
                 alt="">
        </div>

        <div class="col-xs-4 text-center display-cell">

            <h4>Orden de compra y venta</h4>
        </div>
        <div class="col-xs-4 text-right display-cell">
            <h5>Correlativo: {{$orden->correlativo}}</h5>
        </div>

    </div>

    <div class="row display-table">
        <div class="col-xs-4 display-cell margin-bottom-div">
            <h5>Tipo de orden: </h5>

        </div>

        @include('Reportes.tipoOrden')


    </div>

    <div class="row">

        <div class="col-xs-9 margin-bottom-col">

            <div>
                <ul class="list-inline">
                    <li>Nombre del Cliente:</li>
                    <li>
                        <p class="p-format">{{$orden->ClientesN->UsuarioNC->nombre.' '.$orden->ClientesN->UsuarioNC->apellido}}</p>
                    </li>
                </ul>
            </div>
            <div class="inline-block margin-bottom-col">
                <ul class="list-inline">
                    <li>Monto:</li>
                    <li><p class="p-format-money">${{$orden->monto}}</p></li>
                </ul>
            </div>

        </div>

        <div class="col-xs-3 margin-bottom-col">
            <div class="inline-block">
                <ul class="list-inline">
                    <li>Fecha:</li>
                    <li class="p-format-right"><?php echo Carbon::parse($orden->created_at)->format('m-d-Y');?>
                    <li>
                </ul>
            </div>
            <br/>
            <div class="inline-block">
                <ul class="list-inline">
                    <li>Codigo de Cliente:</li>
                    <li class="p-format-right">{{$orden->ClientesN->id}}
                    <li>
                </ul>
            </div>
            <div class="inline-block">
                <ul class="list-inline">
                    <li>Cuenta CEDEVAL:</li>
                    <li class="p-format-cd">{{$orden->CuentaCedeval->cuenta}}
                    <li>
                </ul>
            </div>

        </div>


    </div>
    <div class="row margin-bottom-col-t">
        <div class="col-xs-12">
            <ul class="list-inline">
                <li>Forma de ejecutar la orden:</li>
                <li><p class="p-format-tipo">{{$orden->TipoEjecucionN->forma}}</p>
                <li>
            </ul>
        </div>

    </div>
    <br/>
    <div class="row margin-bottom-col-t">

        <div class="col-xs-7">
            Rendimieto:
            <ul class="list-inline">
                <li>Minimo:</li>
                <li><p class="p-format-right">N/A</p>
                <li>
                <li>Maximo:</li>
                <li><p class="p-format-right">N/A</p>
                <li>
            </ul>
            Precio:
            <ul class="list-inline">
                <li>Minimo:</li>
                <li><p class="p-format-right">${{$orden->valorMinimo}}</p>
                <li>
                <li>Maximo:</li>
                <li><p class="p-format-right">${{$orden->valorMaximo}}</p>
                <li>
            </ul>

            </ul>
        </div>
        <br/>
        <br/>
        <div class="col-xs-5">
            <ul class="list-inline">
                <li>Plazo de la operacion:</li>
                <li><p class="p-format-right">N/A</p>
                <li>
            </ul>
            <ul class="list-inline">
                <li>Cantidad de valores:</li>
                <li><p class="p-format-right">N/A</p>

            </ul>
        </div>


    </div>

    <br/>
    <div class="row margin-bottom-col-t">

        <div class="col-xs-9">
            <ul class="list-inline">
                <li>Mercado:</li>
                <li><p class="p-format">{{$orden->TipoMercado}}</p></li>


            </ul>
            <ul class="list-inline">
                <li>Titulo:</li>
                <li><p class="p-format">{{$orden->titulo}}</p></li>
            </ul>

            <ul class="list-inline">
                <li> Vigencia:</li>
                <li>
                    <p class="p-format"><?php echo Carbon::parse($orden->FechaDeVigencia)->format('m-d-Y');?></p>
                </li>
            </ul>

            <ul class="list-inline">
                <li>Emisor:</li>
                <li><p class="p-format">{{$orden->emisor}}</p></li>
            </ul>
            <ul class="list-inline">
                <li> Tasa de interes:</li>
                <li><p class="p-format">{{$orden->tasaDeInteres}}</p></li>
            </ul>

            <ul class="list-inline">
                <li> Periodicidad de pago:</li>
                <li><p class="p-format">N/A</p></li>
            </ul>
        </div>

        <div class="col-xs-3">
            <ul class="list-inline">
                <li> Comision:</li>
                <li><p class="p-format-right">{{$co = $orden->comision ? $orden->comision:'Por definir'}}</p></li>
            </ul>
            <ul class="list-inline">
                <li> Estado:</li>
                <li><p class="p-format-right"> {{$orden->EstadoOrden->estado}}</p></li>
            </ul>

        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="row text-center move-rigth">
        <div class="col-xs-12 text-center">
            <ul>
                <li><p class="p-format"></p></li>
                <li class="move-left"><p>Firma del receptor de la orden</p></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>