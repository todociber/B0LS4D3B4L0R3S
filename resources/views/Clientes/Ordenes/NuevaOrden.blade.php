@extends('layouts.ClientesLayout')

@section('title')
    <title>Nueva orden</title>

@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Nueva orden</h3>
    </div><!-- /.box-header -->
    <!-- form start -->

    <div class="box-body">
        <div role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <br><br>
                        <label for="exampleInputEmail1">Cuenta CEDEVAL</label>
                        <select type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de cuenta">
                            <option>12345678</option>
                            <option>12345678</option>
                            <option>12345678</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione la casa cual desea realizar la orden</label>
                        <select type="text" class="form-control" id="exampleInputEmail1" placeholder="Casa">
                            <option>Prival Security</option>
                            <option>SYSVALORES</option>
                            <option>Accival</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione el tipo de orden </label>
                        <select type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de cuenta">
                            <option>Compra</option>
                            <option>Venta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione el mercado</label>
                        <select type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de cuenta">
                            <option>Accion Primario</option>
                            <option>Accion Secundario</option>
                            <option>Primario</option>
                        </select>
                    </div>
                    <br>


                    <div class="form-group">
                        <h5 class="text-center"><strong>Caracteristicas de valor</strong> </h5>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Seleccione el titulo de valor a adquirir</label>
                            <select type="text" class="form-control" id="exampleInputEmail1" placeholder="Titulo">
                                <option>ASESUISA</option>
                                <option>AACSA</option>
                                <option>AASESUISAV</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Emisor</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Emisor">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio mínimo</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Precio mínimo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio máximo</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Precio máximo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Monto</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Monto">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de Vencimiento</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Fecha de vencimiento">
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Generar Orden</button>
                    </div>

                </div>
            </div><!--row-->


            <!-- /.box -->
        </div>
    </div>
</div>
@stop