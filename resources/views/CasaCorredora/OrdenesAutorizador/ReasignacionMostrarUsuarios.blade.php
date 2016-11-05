@extends('layouts.CasaCorredoraLayout')

@section('title')
    <title>Ordenes</title>

@stop
@section('NombrePantalla')
    Ordenes
@stop
@section('content')
    <?php use App\Utilities\RolIdentificador;
    $rol = new RolIdentificador();
    ?>

    @include('alertas.flash')
    @include('alertas.errores')


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Reasignar Ordenes</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">


            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">


                            <br><br>

                            <div style="width: 100%; padding-left: -10px; border: 0px;">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover dt-responsive display nowrap"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span>
                                                </p></th>
                                            <th><p class="text-center">Nombre</p></th>
                                            <th><p class="text-center">Correo</p></th>
                                            <th><p class="text-center">Numero de Ordenes</p></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <?php
                                            $existenordenes = 0;
                                            $mostrar = false;
                                            for ($i = 0; $i < count($agentesCorredores); $i++) {

                                                if ($agentesCorredores[$i]->id == $usuario->id) {
                                                    $existenordenes = 1;
                                                    $mostrar = true;
                                                }

                                            }




                                            ?>
                                            @if($mostrar)
                                                <tr>
                                                    <td>{!!link_to_route('Ordenes.Reasignacion.Orden', $title = 'Re-Asignar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}</td>
                                                    <td>{{$usuario->nombre}} {{$usuario->apellido}}</td>
                                                    <td>{{$usuario->email}}</td>
                                                    <td><?php
                                                        $existenordenes = 0;

                                                        for ($i = 0; $i < count($agentesCorredores); $i++) {

                                                            if ($agentesCorredores[$i]->id == $usuario->id) {
                                                                $existenordenes = 1;
                                                                echo $agentesCorredores[0]->N;
                                                            }

                                                        }

                                                        if ($existenordenes == 0) {
                                                            echo '0';
                                                        }


                                                        ?> ordenes asignadas
                                                    </td>

                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>

        </div>
    </div>
@stop