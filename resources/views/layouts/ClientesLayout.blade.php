<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
            <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    {!! Html::style('assets/css/bootstrap.css') !!}
            <!-- Font Awesome -->
    {!! Html::style('assets/css/font-awesome.css') !!}
            <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css">
    <!-- DataTables -->
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
            <!-- Theme style -->
    {!! Html::style('assets/dist/css/AdminLTE.css') !!}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('assets/dist/css/skins/_all-skins.css') !!}


            <!-- jQuery 2.1.4 -->
    {!! Html::script('assets/plugins/jQuery/jQuery-2.1.4.min.js') !!}
            <!-- Bootstrap 3.3.5 -->
    {!! Html::script('assets/js/bootstrap.min.js') !!}
            <!-- DataTables -->
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
            <!-- SlimScroll -->
    {!! Html::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') !!}
            <!-- FastClick -->
    {!! Html::script('assets/plugins/fastclick/fastclick.min.js') !!}
            <!-- AdminLTE App -->
    {!! Html::script('assets/dist/js/app.min.js') !!}
            <!-- AdminLTE for demo purposes -->
    {!! Html::script('assets/dist/js/demo.js') !!}

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
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs">Nombre del cliente</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <p>
                                    Cliente casa Corredora
                                    <small>Cliente</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle a -->

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
                <li class="header">MENU</li>
                <li id="ordenes" class=" treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i> <span>Ordenes</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li  id="listadoOrdenes" ><a href="ordenes_list.html"><i class="fa fa-circle-o"></i> Listado general de ordenes</a></li>
                        <li id="nuevaOrden"><a href="ordenes_form.html"><i class="fa fa-circle-o"></i> Nueva orden</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Afiliación</span>
                        <i class="fa fa-angle-left pull-right"></i>

                    </a>
                    <ul class="treeview-menu">
                        <li><a href="Solicitudes_Afiliacion.html"><i class="fa fa-circle-o"></i>Solicitudes de afiliación</a></li>
                        <li class="active"><a href="afiliacion_form.html"><i class="fa fa-circle-o"></i> Afiliarse a una casa</a></li>
                        <li ><a href="#"><i class="fa fa-circle-o"></i> Listado de casas afiliado
                            </a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th-list"></i>
                        <span>Mi perfil</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i>Modificar información</a></li>
                        <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Cambio de contraseña</a></li>
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
            @yield('content')
        </section>

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="https://bolsadevalores.com.sv">Bolsa de Valores de El Salvador</a>.</strong> Derechos reservados.
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