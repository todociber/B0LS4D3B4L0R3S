<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nueva casa</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/bootstrap.css">

    <!-- Font Awesome -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/font-awesome.css">

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


    <!--  DROPZONE CSS -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/dropzone.css">

    <!--  LADDA CSS -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/ladda-themeless.min.css">

    <!--  SERO CSS -->
    <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/assets/css/SERO.css">

    <!-- jQuery 2.1.4 -->
    <script src="http://localhost:8000/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

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

    <!--  DROPZONE JS -->
    <script src="http://localhost:8000/assets/js/dropzone.js"></script>

    <!--  loading JS -->
    <script src="http://localhost:8000/assets/js/loading.js"></script>


    <!--  SERO JS -->
    <script src="http://localhost:8000/assets/js/SERO.js"></script>

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
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left info">
                    <p>Rigoberto Gómez</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MENU</li>
                <li id="usuarios" class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Usuarios</span> <i
                                class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="catalogo"><a href="http://localhost:8000/bolsa/CatalogoUsuarios"><i
                                        class="fa fa-circle-o"></i> Catalogo de Usuarios</a></li>
                        <li id="nuevoUsuario"><a href="http://localhost:8000/bolsa/NuevoUsuario"><i
                                        class="fa fa-circle-o"></i> Nuevo Usuario</a></li>
                    </ul>
                </li>
                <li id="casas" class="treeview">
                    <a href="#">
                        <i class="fa fa-home"></i>
                        <span>Casas Corredoras</span>
                        <i class="fa fa-angle-left pull-right"></i> </a>
                    <ul class="treeview-menu">
                        <li id="catalogoCasas"><a href="http://localhost:8000/bolsa/ListadoCasas"><i
                                        class="fa fa-circle-o"></i> Catalogo</a></li>
                        <li id="registrar"><a href="http://localhost:8000/bolsa/NuevaCasa"><i
                                        class="fa fa-circle-o"></i>Registrar Casa</a></li>
                    </ul>
                </li>
                <li id="perfil" class="treeview">
                    <a href="http://localhost:8000/bolsa/MiPerfil">
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
            <script>
                $(document).ready(function () {
                    $('#casas').addClass('active');
                    $('#registrar').addClass('active');
                    var buttonLada;
                    var dataError;
                    $('#modal').on('hidden.bs.modal', function () {
                        if (dataError == '0') {

                            window.location.href = 'http://localhost:8000/bolsa/ListadoCasas';
                        }
                    });
                    // var btn = $('.ladda-button');
                    //   var buttonLada = Ladda.create(btn);
                });


                Dropzone.options.myDropzone = {
                    autoProcessQueue: false,
                    uploadMultiple: false,
                    maxFilezise: 10,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    thumbnailWidth: 300,
                    thumbnailHeight: 300,
                    dictRemoveFile: "Quitar imagen",


                    init: function () {
                        var submitBtn = document.querySelector("#clickable");
                        var myDropzone = this;

                        submitBtn.addEventListener("click", function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();
                            if (myDropzone.files.length > 0) {
                                waitingDialog.show('Guardando Espere... ', {progressType: 'info'});
                            }
                            else {
                                $('#modalbody').text('Debe subir una imagen');
                                $('#modal').modal('show');

                            }
                        });
                        this.on("addedfile", function (file) {
                            //  alert("file uploaded");
                        });

                        this.on("complete", function (file, response) {
                            myDropzone.removeFile(file);
                            // console.log('response ' + JSON.stringify(response));
                        });

                        this.on("success", function (file, data) {
                            waitingDialog.hide();
                            dataError = data.error;
                            if (data.error == '0') {
                                $('#modalbody').text('Datos guardados con exito');


                            }
                            else if (data.error == '2') {

                                $('#modalbody').text('Faltan datos, asegure de llenar todos los campos del formulario o de escribir una dirección de correo eléctronica correctamente');
                            }
                            else if (data.error == '3') {

                                $('#modalbody').text('Ya exite una casa registrada con el código ingresado');
                            }
                            else {

                                $('#modalbody').text('Ocurrio un problema al ingresar los datos');

                            }
                            $('#modal').modal('show');
                        });
                        this.on("error", function (file, error) {
                            waitingDialog.hide();
                            $('#modalbody').text('Ocurrio un problema al ingresar los datos');
                            $('#modal').modal('show');
                        });


                        this.on("success",
                                myDropzone.processQueue.bind(myDropzone)
                        );
                    }
                };

            </script>


            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Registro de Casas</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form accept-charset="UTF-8" id="my-dropzone" class="dropzone"
                                                      enctype="multipart/form-data"><input name="_token" type="hidden"
                                                                                           value="j7hLFU5zEyeMZ0lRC0KNIJMlhwifGFwxaYYmfEmT">
                                                    <div class="form-group">
                                                        <label for="Nombre">Nombre</label>
                                                        <input class="form-control"
                                                               placeholder="Ingresa el nombre de la organizaci&oacute;n"
                                                               name="nombre" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Codigo">Codigo</label>
                                                        <input class="form-control"
                                                               placeholder="Ingresa el c&oacute;digo asignado a la organizaci&oacute;n"
                                                               required="required" name="codigo" type="text">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Correo electrónico">Correo
                                                            Electr&oacute;nico</label>
                                                        <input class="form-control"
                                                               placeholder="Ingresa el correo de la organizaci&oacute;n"
                                                               required="required" name="correo" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Dirección">Direcci&oacute;n</label>
                                                        <input class="form-control"
                                                               placeholder="Ingresa la direcci&oacute;n de la organizaci&oacute;n"
                                                               required="required" name="direccion" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Teléfono">Tel&eacute;fono</label>
                                                        <input class="form-control"
                                                               placeholder="Ingresa el tel&eacute;fono de la organizaci&oacute;n"
                                                               required="required" name="telefono" type="text">
                                                    </div>

                                                    <div class="form-group">
                                                        <div id="dZUpload" class="dz-message drop-border">
                                                            <br/><br/>
                                                            Haz click para subir una imagen.
                                                        </div>
                                                        <div class="dropzone-previews">


                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="Seleccione un estado">Seleccione Un Estado</label>
                                                        <select class="form-control" required="required" id="estado"
                                                                name="Estado">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Innactivo</option>
                                                        </select>
                                                    </div>


                                            </div>

                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <input class="btn btn-primary btn-flat ladda-button" id="clickable"
                                               data-style="expand-left" type="submit" value="Registrar casa">
                                    </div>
                                    </form>
                                </div>

                            </div><!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                        </div>
                        <div i class="modal-body">
                            <p id="modalbody"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="https://bolsadevalores.com.sv">Bola de Valores de El
                Salvador</a>.</strong> Derechos reservados.
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


</script>
</body>
</html>

