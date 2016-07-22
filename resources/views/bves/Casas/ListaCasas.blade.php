@extends('layouts.bolsavalores')

@section('title')
    <title>Listado de casas inscritas</title>
@stop
@section('content')
    <script>
        $('#casas').addClass('active');
        $('#catalogoCasas').addClass('active');

    </script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @include('alertas.flash')
                    <h3 class="box-title">Lista de casas</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>NOMBRE</th>
                            <th>ESTADO</th>
                            <th>CORREO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SYS</td>
                            <td>Activo</td>
                            <td>sys@sys.com</td>
                        </tr>
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.col -->
@stop