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
    <!-- DataTables -->
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
            <!-- Theme style -->
    {!! Html::style('assets/dist/css/AdminLTE.css') !!}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('assets/dist/css/skins/_all-skins.css') !!}

            <!--  DROPZONE CSS -->
    {!! Html::style('assets/css/dropzone.css') !!}
            <!--  LADDA CSS -->
    {!! Html::style('assets/css/ladda-themeless.min.css') !!}
            <!--  SERO CSS -->
    {!! Html::style('assets/css/SERO.css') !!}

    {!! Html::style('assets/css/Login.css') !!}
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
            <!--  DROPZONE JS -->
    {!! Html::script('assets/js/dropzone.js') !!}
            <!--  loading JS -->
    {!! Html::script('assets/js/loading.js') !!}


            <!--  SERO JS -->
    {!! Html::script('assets/js/SERO.js') !!}
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>


<!-- Main content -->
<section class="content">
    @yield('content')
    </div>
    <!-- /.content-wrapper -->


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->

    <!-- ./wrapper -->

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

