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
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>BOLSA</b>DEVALORES</span>
            </a>
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">Nombre Usuario</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
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
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left info">
                    <p>Rigoberto Gómez</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li  class="header">MENU</li>
                <li id="usuarios"  class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul  class="treeview-menu">
                        <li id="catalogo" ><a href="{!! route('catalogoUsuarios') !!}"><i class="fa fa-circle-o"></i> Catalogo de Usuarios</a></li>
                        <li id="nuevoUsuario" ><a href="{!! route('nuevoUsuario') !!}"><i class="fa fa-circle-o"></i> Nuevo Usuario</a></li>
                    </ul>
                </li>
                <li id="casas" class="treeview">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Casas Corredoras</span>
                        <i class="fa fa-angle-left pull-right"></i>                    </a>
                    <ul class="treeview-menu">
                        <li id="catalogoCasas" ><a href="{!! route('listadoCasas') !!}"><i class="fa fa-circle-o"></i> Catalogo</a></li>
                        <li id="registrar"><a href="{!! route('nuevaCasa') !!}"><i class="fa fa-circle-o"></i>Registrar Casa</a></li>
                    </ul>
                </li>
                <li id="perfil"  class="treeview">
                    <a href="{!! route('miPerfil') !!}">
                        <i class="fa fa-th-list"></i>
                        <span>Mi Perfil</span>
                    </a>
                </li>
                <li id="bitacoras" class="treeview">
                    <a href="bitacora.html">
                        <i class="fa fa-home"></i>
                        <span>Bitacoras</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Administración
                <small>Casas</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Usuarios</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
          @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="https://bolsadevalores.com.sv">Bola de Valores de El Salvador</a>.</strong> Derechos reservados.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->

</div><!-- ./wrapper -->

<!-- page script -->
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

