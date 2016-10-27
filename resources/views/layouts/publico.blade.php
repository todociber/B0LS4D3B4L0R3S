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
    {!! Html::style('dist/css/select2.css') !!}
    {!! Html::style('pass/strength.css') !!}

            <!-- DataTables -->
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
            <!-- Theme style -->
    {!! Html::style('assets/dist/css/AdminLTE.css') !!}
            <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('assets/dist/css/skins/_all-skins.css') !!}


            <!-- jQuery 2.1.4 -->
    {!! Html::script('assets/plugins/jQuery/jQuery-2.1.4.min.js') !!}

    {!! Html::script('dist/js/select2.js') !!}
            <!-- Bootstrap 3.3.5 -->
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('pass/js.js') !!}

    {!! Html::script('pass/strength.js') !!}
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

    {!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}

    {!! Html::script('assets/plugins/timepicker/bootstrap-timepicker.min.js') !!}
    {!! Html::script('assets/plugins/datepicker/locales/bootstrap-datepicker.es.js') !!}

    {!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}
    {!! Html::script('assets/js/loading.js') !!}
    {!! Html::script('assets/js/SERO.js') !!}
    {!! Html::style('assets/css/SERO.css') !!}

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->


</head>
<body class="hold-transition login-page">

@yield('content')

<script>

</script>
</body>
</html>