@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Nuevo Usuario</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

    @foreach($information as $info)



        <?php

        $muns = $info->Municipio;
        ?>
        @foreach($muns as $dir)

            <?php $direccionActual = $dir->Direccione; ?>
            <br>
            {{$dir->nombre}}
            <br>

            @foreach($direccionActual as $direccionDetalle)
                <br>

                {{$direccionDetalle->ClienteDireccionN->dui}}
            <br>



            @endforeach

        @endforeach
        <br>
    @endforeach
    <br>


                            <table id="example1" class="table table-hover">
                                <thead>
                                <tr>
                                    <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                                    <th><p class="text-center">Correlativo</p></th>
                                    <th><p class="text-center">Tipo</p></th>
                                    <th><p class="text-center">Mercado</p></th>
                                    <th><p class="text-center">Monto</p></th>
                                    <th><p class="text-center">Fecha de vencimiento</p></th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>
                                        <a class="btn btn-primary" style="background-color:#444444; "><em
                                                    class="fa fa-pencil"></em></a>

                                    </td>
                                    <td>55667701</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:green;">Vigente</p></td>

                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive"
                                                    aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667702</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:red;">Anulada</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive"
                                                    aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:darkred;">Rechazada</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:green;">Pre-Vigente</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:blue;">Ejecutada</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:orangered;">Vencida</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:saddlebrown;">Finalizada</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:saddlebrown;">Finalizada</p></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><a class="btn-table" href="ordenes_detalle.html"> <i
                                                    class="fa fa-archive" aria-hidden="true"></i></a>

                                    </td>
                                    <td>55667703</td>
                                    <td>Compra</td>
                                    <td>Reportos</td>
                                    <td>$300</td>
                                    <td>01/06/2016</td>
                                    <td><p style="color:saddlebrown;">Finalizada</p></td>
                                </tr>


                                </tbody>

                            </table>


                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>
        </div>
@stop