@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')
    <section class="content">
        <script>

            $(document).ready(function () {
                $('#agentes').select2();
            });
        </script>
        <script>


            function clikLog(boton) {
                var idAgenteCorredor = boton.name;
                var NombreAgenteCorredor = boton.id;
                console.log(idAgenteCorredor);
                document.getElementById("AgenteCorredor").value = idAgenteCorredor;
                document.getElementById("AgenteSeleccionado").innerHTML = NombreAgenteCorredor;
            }


        </script>


        <!-- PRUEBAS BVOOTSTRAP MODAL -->

        <div class="modal fade" role="dialog" id="SeleccionAgente" data-backdrop="static" data-keyboard="false"
             tabindex="-1" aria-labelledby="gridModalLabel"
             style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="gridModalLabel">Seleccion Agente Corredor</h4>
                    </div>
                    <table id="example1" class="table table-hover">
                        <thead>
                        <tr>

                            <th><p class="text-center">Nombre</p></th>
                            <th><p class="text-center">email</p></th>
                            <th><p class="text-center">Numero de Ordenes</p></th>
                            <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span></p></th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>

                            <td>Alexander Dominguez</td>
                            <td>alexlaley10@gmail.com</td>
                            <td>
                                0 ordenes asignadas
                            </td>


                            <td>
                                <input type="button" data-dismiss="modal" class="btn btn-primary"
                                       onclick="clikLog(this)" id="Alexander  Dominguez"
                                       name="2" value="Asignar orden"/>
                            </td>
                        </tr>


                        <tr>

                            <td>Carlos Eduardo Perez Perez</td>
                            <td>carlosPerez@hotmail.com</td>
                            <td>
                                0 ordenes asignadas
                            </td>


                            <td>
                                <input type="button" data-dismiss="modal" class="btn btn-primary"
                                       onclick="clikLog(this)" id="Carlos Eduardo Perez Perez"
                                       name="3" value="Asignar orden"/>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                    </div>
                </div>
            </div>
        </div>


        <!-- PRUEBAS BVOOTSTRAP MODAL -->


        <br><br>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice">
                        <h2 class="page-header">
                            <i class="fa fa-file-text-o"></i> Orden #201 <br><br>
                            Cliente: Karla Melgar
                            <small class="pull-right"><strong>Fecha de
                                    Registro:</strong> 2016-08-20
                            </small>
                            <br>
                            <small class="pull-right"><strong>Fecha de
                                    Vigencia:</strong>2016-08-20
                            </small>
                            <br>
                        </h2>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">


                                <b>Casa corredora: </b> Casa Corredora Maxima Ganancia<br>
                                <b>Tipo de mercado: </b>PRIVADO<br>
                                <b>Tipo de orden: </b> Compra <br>
                                <b>Titulo: </b>DAVIVIENDA<br>
                                <b>Cuenta cedeval: </b>5465313864 <br>
                                <b>Precio minimo: </b>100.00<br>
                                <b>Precio máximo: </b>2000.00<br>
                                <b>Monto: </b>100000.00<br>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <b>Tipo de ejecución:</b>Por definir<br>
                                <b>Estado:</b><span style="color:orangered"> Pre-Vigente</span>


                            </div>
                            <div class="col-sm-4 invoice-col">


                            </div>
                        </div><!-- /.box-info -->
                        <div class="row">
                            <div class="form-group col-md-6">

                                <form accept-charset="UTF-8"><input name="_method" type="hidden" value="PUT"><input
                                            name="_token" type="hidden"
                                            value="Pz4iTxP3d4SfdAoaWO6N5ImNDxM3Sts7mDf5vo3W">
                                    <label>Agente Corredor: </label>
                                    <label id="AgenteSeleccionado" value="Sin Seleccionar">Sin Seleccionar </label>

                                    <div class="bs-example bs-example-padded-bottom">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#SeleccionAgente">
                                            Seleccionar Agente Corredor
                                        </button>
                                    </div>
                                    <input name="AgenteCorredor" id="AgenteCorredor" value="" size="40"
                                           style="display:none">
                                    <br>
                                    <label for="Comision">Comision</label>
                                    <input class="form-control" placeholder="Ingrese la Comision  a cobrar " min="0"
                                           step="any" name="Comision" type="number" id="Comision">
                                    <br>
                                    <input class="btn btn-info btn-flat"
                                           onclick="waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"
                                           type="submit" value="Completar">
                                </form>
                                <div>
                                    <br>
                                    <a href="#" class="btn btn-danger"
                                       onclick="waitingDialog.show('Cargando... ',{ progressType: 'danger'});setTimeout(function () {waitingDialog.hide();}, 3000);">Rechazar</a>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 text-right">


                                    </div>
                                </div>
                            </div><!-- /.box -->


                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </div>
            </div>
        </section>
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="invoice">

                        <div class="invoice-info">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="page-header">
                                            <h3>
                                                <small class="pull-right">4 comentarios</small>
                                                Comentarios
                                            </h3>
                                        </div>
                                        <div class="comments-list">
                                            <div class="media">
                                                <p class="pull-right">
                                                    <small>12/12/12</small>
                                                </p>
                                                <a class="media-left" href="#">

                                                </a>

                                                <div class="media-body">

                                                    <h4 class="media-heading user_name">Casa corredora</h4>
                                                    Comentario


                                                </div>
                                            </div>
                                            <div class="media">
                                                <p class="pull-right">
                                                    <small>12/12/12</small>
                                                </p>
                                                <a class="media-left" href="#">

                                                </a>

                                                <div class="media-body">

                                                    <h4 class="media-heading user_name">Cliente</h4>
                                                    Comentario


                                                </div>
                                            </div>
                                            <div class="media">
                                                <p class="pull-right">
                                                    <small>12/12/12</small>
                                                </p>
                                                <a class="media-left" href="#">

                                                </a>

                                                <div class="media-body">

                                                    <h4 class="media-heading user_name">Casa corredora</h4>
                                                    Comentario


                                                </div>
                                            </div>
                                            <div class="media">
                                                <p class="pull-right">
                                                    <small>12/12/12</small>
                                                </p>
                                                <a class="media-left" href="#">

                                                </a>

                                                <div class="media-body">

                                                    <h4 class="media-heading user_name">Cliente</h4>
                                                    Comentario


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="widget-area no-padding blank">
                        <div class="status-upload">
                            <form>
                                <textarea style="color: black;font-family: Arial;"
                                          placeholder="Escriba aqui su comentario"></textarea>

                                <button type="button" class="btn btn-info "> Comentar</button>
                            </form>
                        </div><!-- Status Upload  -->
                    </div><!-- Widget Area -->
                </div>

            </div>

        </section>


    </section>








@stop