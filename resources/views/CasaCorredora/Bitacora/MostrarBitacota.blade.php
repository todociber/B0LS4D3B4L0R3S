@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Usuarios</title>

@stop
@section('NombrePantalla')
    Usuarios
@stop

@section('content')
    <script>
        function ShowModalDesactivar(id, texto) {
            $('#modalbody').text(texto);
            $('#idusuario').val(id);
            $('#desactivarUsuario').modal('show');
        }
        function ShowModalActivar(id, texto) {
            $('#modalbodyR').text(texto);
            $('#idrestaurar').val(id);
            $('#activarUsuario').modal('show');
        }

    </script>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Usuarios</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('alertas.flash')
                            {!!link_to_route('UsuarioCasaCorredora.crear', $title = 'Crear Usuario ', $parameters = [], $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
                            <br><br>

                            <div class="table-responsive">
                                <table id="example1" class="table table-hover dt-responsive display nowrap"
                                       cellspacing="0">
                                    <thead>
                                    <tr>

                                        <th><p class="text-center">Tipo de cambio</p></th>
                                        <th><p class="text-center">Usuario</p></th>
                                        <th><p class="text-center">Descripcion del cambio</p></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bitacora as $bitacoras)
                                        <tr>

                                            <td>{{$bitacoras->tipoCambio}}</td>
                                            <td>{{$bitacoras->usuarioN->nombre}} {{$bitacoras->usuarioN->apelllido}}</td>
                                            <td>{{$bitacoras->descripcion}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div>
                                </div>
                            </div><!--row-->


                            <!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop