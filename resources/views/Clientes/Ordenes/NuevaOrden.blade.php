<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nueva orden</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/bootstrap.css">

    <!-- Font Awesome -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/font-awesome.css">

    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/dist/css/select2.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css">
    <!-- DataTables -->
    <link media="all" type="text/css" rel="stylesheet"
          href="http://localhost:8000/assets/plugins/datatables/dataTables.bootstrap.css">

    <!-- Theme style -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/dist/css/AdminLTE.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->
    <link media="all" type="text/css" rel="stylesheet"
          href="http://localhost:8000/assets/dist/css/skins/_all-skins.css">


    <!-- jQuery 2.1.4 -->
    <script src="http://localhost:8000/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>


    <script src="http://localhost:8000/dist/js/select2.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="http://localhost:8000/assets/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="http://localhost:8000/assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="http://localhost:8000/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="http://localhost:8000/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->
    <script src="http://localhost:8000/assets/plugins/fastclick/fastclick.min.js"></script>

    <!-- AdminLTE App -->
    <script src="http://localhost:8000/assets/dist/js/app.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="http://localhost:8000/assets/dist/js/demo.js"></script>


    <script src="http://localhost:8000/assets/plugins/datepicker/bootstrap-datepicker.js"></script>


    <script src="http://localhost:8000/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <script src="http://localhost:8000/assets/plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>


    <link media="all" type="text/css" rel="stylesheet"
          href="http://localhost:8000/assets/plugins/datepicker/datepicker3.css">

    <script src="http://localhost:8000/assets/js/loading.js"></script>

    <script src="http://localhost:8000/assets/js/SERO.js"></script>

    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/SERO.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->


</head>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>CLIENTES</b></span>
            </a>
            <!-- Sidebar toggle a-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="a">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <div class="margin-Div">
                            <a href="#" class="btn btn-danger">
                                Cerrar Sesión
                            </a>
                        </div>

                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left info">
                    <p>Rigoberto Gómez</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Menu</li>
                <li id="ordenes" class=" treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i> <span>Ordenes</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="listadoOrdenes"><a href="http://localhost:8000/Cliente/ListadoOrdenesV"><i
                                        class="fa fa-circle-o"></i>Ordenes</a></li>
                        <li id="nuevaOrden"><a href="http://localhost:8000/Cliente/NuevaOrden"><i
                                        class="fa fa-circle-o"></i> Nueva orden</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Afiliación</span>
                        <i class="fa fa-angle-left pull-right"></i>

                    </a>
                    <ul class="treeview-menu">
                        <li><a href="Solicitudes_Afiliacion.html"><i class="fa fa-circle-o"></i>Solicitudes de
                                afiliación</a></li>
                        <li><a href="afiliacion_form.html"><i class="fa fa-circle-o"></i> Afiliarse a una casa</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Listado de casas afiliado
                            </a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th-list"></i>
                        <span>Mi perfil</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i>Modificar información</a>
                        </li>
                        <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Cambio de contraseña</a>
                        </li>
                    </ul>
                </li>
                <li class="header">OTRAS OPCIONES</li>
                <!--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Solicitud de afiliación

            </h1>

        </section>


        <!-- Main content -->
        <section class="content">
            <script>
                $(function () {

                    //$.fn.datepicker.defaults.language = 'es';
                    $('#datepicker').datepicker({
                        pickTime: false,
                        autoclose: true,
                        language: 'es',
                        cursor: 'pointer'


                    });
                });
                $('#ordenes').addClass('active');
                $('#nuevaOrden').addClass('active');

            </script>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva orden</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="http://localhost:8000/Clientes" accept-charset="UTF-8"
                                      id="form" role="form"><input name="_token" type="hidden"
                                                                   value="j7hLFU5zEyeMZ0lRC0KNIJMlhwifGFwxaYYmfEmT">
                                    <div class="form-group">
                                        <br><br>
                                        <label for="exampleInputEmail1">Cuenta CEDEVAL</label>
                                        <select class="form-control" id="estado" name="cuentacedeval">
                                            <option value="1">12345678</option>
                                            <option value="2">87654321</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Seleccione la casa cual desea realizar la
                                            orden</label>
                                        <select class="form-control" required="required" id="estado"
                                                name="casacorredora">
                                            <option value="2">Casa Corredora Maxima Ganancia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Seleccione el tipo de orden </label>
                                        <select class="form-control" required="required" id="estado" name="tipodeorden">
                                            <option value="1">Compra</option>
                                            <option value="2">Venta</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Seleccione el mercado</label>
                                        <select type="text" class="form-control" id="mercado" name="mercado">
                                            <option>Accion Primario</option>
                                            <option>Accion Secundario</option>
                                            <option>Primario</option>
                                        </select>
                                    </div>
                                    <br>


                                    <div class="form-group">
                                        <h5 class="text-center"><strong>Caracteristicas de valor</strong></h5>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccione el titulo de valor a
                                                adquirir</label>
                                            <select type="text" class="form-control" name="titulo">
                                                <option>ASESUISA</option>
                                                <option>AACSA</option>
                                                <option>AASESUISAV</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Emisor</label>
                                        <label for="Emisor">Emisor</label>
                                        <input class="form-control" placeholder="Ingrese el emisor" id="emisor"
                                               name="emisor" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="Precio minimo el cual desea comprar/vender el valor">Precio Minimo
                                            El Cual Desea Comprar/vender El Valor</label>
                                        <input class="form-control" placeholder="Ingrese el precio minimo" id="pminimo"
                                               name="valorMinimo" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="Precio máximo el cual desea comprar/vender el valor">Precio M&aacute;ximo
                                            El Cual Desea Comprar/vender El Valor</label>
                                        <input class="form-control" placeholder="Ingrese el precio maximo" id="pmaximo"
                                               name="valorMaximo" type="text">
                                    </div>
                                    <div class="form-group" id="monto">
                                        <label for="Ingrese el monto de la inversion">Ingrese El Monto De La
                                            Inversion</label>
                                        <input class="form-control"
                                               placeholder="Ingrese el monto de la inversi&oacute;n" name="monto"
                                               type="text">
                                    </div>

                                    <div class="form-group">

                                        <label for="Fecha de vencimiento">Fecha De Vencimiento</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control input-pointer"
                                                   placeholder="Ingresa la fecha de vigencia de la orden (dd/mm/yyyy)"
                                                   id="datepicker" name="FechaDeVigencia" type="text">
                                        </div>
                                    </div>


                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat">Generar Orden</button>
                                    </div>
                                </form>
                            </div>
                        </div><!--row-->


                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
        </section>

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="https://bolsadevalores.com.sv">Bolsa de Valores de El Salvador</a>.</strong>
        Derechos reservados.
    </footer>


</div>

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    $(document).ready(function () {
    })
</script>
</body>
</html>
