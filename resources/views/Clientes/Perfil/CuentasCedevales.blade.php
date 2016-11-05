@extends('layouts.ClientesLayout')
@section('title')
    <title>Mi Perfil</title>
@stop
@section('content')
    <script>
        $('#opcionesPerfil').addClass('active');
        $('#perfilUsuario').addClass('active');
        $('#cedeval').mask('0000000000');
        function addInfoEliminar(idCedeval, cuenta) {
            $("#cuentaCedeval").val(idCedeval);
            $("#parra").text("¿Desea eliminar esta cuenta cedeval? " + cuenta);
        }
    </script>
    <?php $cuenta = count($cedevales)?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">

                    @include('alertas.errores')
                    @include('alertas.flash')
                    <div class=" col-md-12 toppad">
                        <div class="row">

                            <div class=" col-md-12 ">
                                @if($cuenta < 5)
                                    <button class="btn btn-primary btn-flat" data-toggle="modal"
                                            data-target="#AgregarCedeval" onclick=" $('#cedeval').val('');"> Agregar
                                        Cuenta Cedeval
                                    </button><br/>
                                @endif
                                <table class="table table-user-information">
                                    <tbody>
                                    <th>Cuenta</th>
                                    <th>Opción</th>

                                    @foreach($cedevales as $cedeval)
                                        <tr>
                                            <td>{{$cedeval->cuenta}}</td>

                                            <td>@if($cuenta > 1)
                                                    <a href="#" data-toggle="modal" data-target="#modalEliminar"
                                                       onclick="addInfoEliminar('{{$cedeval->id}}','{{$cedeval->cuenta}}')">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($cuenta < 5)
        <div id="AgregarCedeval" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    {{Form::open(['route'=>'agregarcedeval','method' =>'POST', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()'])  }}


                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Cuenta cedeval</h4><br/>
                        <h5>*Recuerde que solo puede adicionar 5 cuentas cedevales</h5>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            {{ Form::label('Número de cuenta cedeval') }}
                            {{ Form::text('CuentaCedeval',null,['class'=>'form-control','placeholder'=>'Ingrese la cuenta cedeval', 'id'=>'cedeval', 'required']) }}
                        </div>


                    </div>
                    <div class="modal-footer">


                        <button type="submit" class="btn btn-info">Agregar</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    </div>
                    {{ Form::close() }}

                </div>

            </div>
        </div>
    @endif
    <div id="modalEliminar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                {{Form::open(['route'=>'eliminarcedeval','method' =>'DELETE', 'id'=>'form','role' => 'form', 'onsubmit'=>'animatedLoading()'])  }}
                <div style="display: none">

                    {{ Form::text('idCedeval',null,['class'=>'form-control','id'=>'cuentaCedeval', 'required','style']) }}


                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Eliminar cuenta cedeval</h4>
                </div>

                <div class="modal-body">
                    <p id="parra"></p>

                </div>
                <div class="modal-footer">


                    <button type="submit" class="btn btn-info">Eliminar</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>
                {{ Form::close() }}

            </div>

        </div>
    </div>

@stop