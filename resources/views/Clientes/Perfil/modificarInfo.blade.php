@extends('layouts.ClientesLayout')

@section('title')
    <title>Modificar perfil</title>

@stop

@section('content')
    <script>
        $('#casa').mask('00000000');
        $('#celular').mask('00000000');
        var contador = 0;
        var clonar;
        var departamento = '<?php echo $direccion->MunicipioDireccion->Departamento->id;?>';
        var municipio = '<?php echo $direccion->MunicipioDireccion->id;?>';
        $(function () {

            $('#department').val(departamento);
            $('#municipio').val(municipio);
            //$.fn.datepicker.defaults.language = 'es';
            $('#datepicker').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                cursor: 'pointer'


            });
            //$('#department').prepend('<option val="" disabled selected>Seleccione un departamento</option>')
        });

        function charge() {
            waitingDialog.show('Procesando... ', {progressType: 'info'})
        }
        function stop() {
            waitingDialog.hide();
        }

        function openModalInfo() {
            $('#modalAlerta').modal('show');

        }
        function submitForm() {
            animatedLoading();
            $('#formulario').submit();

        }

        function GetMunicipios(dep) {
            //FUNCION QUE DESPLIEGA LA ANIMACIÓN DE CARGANDO
            this.charge();
            $('#municipio').find('option').remove();
            //ELIMINANDO MUNICIPIOS DEL SELECT

            $('#divmun').removeClass('add-Active');
            $('#divmun').addClass('add-Innactive');

            $.ajax({
                // la URL para la petición
                url: '{{route('getMun')}}',

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data: {_token: $('input[name=_token]').val(), id: dep.value},

                // especifica si será una petición POST o GET
                type: 'POST',

                // el tipo de información que se espera de respuesta
                dataType: 'json',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function (json, textStatus, xhr) {

                    waitingDialog.hide();
                    console.log('status ' + xhr.status);
                    $('#divmun').removeClass('add-Innactive');
                    $('#divmun').addClass('add-Active');
                    json.forEach(function (entry) {
                        $("#municipio").append('<option value="' + entry.id + '">' + entry.nombre + '</option>');
                    });

                },

                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error: function (xhr, status) {
                    waitingDialog.hide();
                    //  this.stop();
                },

                // código a ejecutar sin importar si la petición falló o no
                complete: function (xhr, status, json) {
                    waitingDialog.hide();
                    if (xhr.status == 450) {


                        var response = JSON.parse(xhr.responseText);
                        $('#modalbody').text(response.error);

                        $('#modal').modal('show');
                    }

                }
            });
        }

        function addCedeval() {
            /*<a type="button">
             <i class="fa fa-minus-circle min-button" aria-hidden="true"></i>
             </a>*/
            console.log('addcedeval ' + contador);
            var numeroCuenta = $('.pivot');
            var general = $('.cdv');

            $(numeroCuenta[contador]).clone().appendTo('#cedeval');

            if (contador == 0) {


                var divcod = $('.margin-TopDiv');
                console.log('divcod length ' + divcod.length);
                $(divcod[1]).append('<a class="aPivot" type="button"> <i class="fa fa-minus-circle min-button" aria-hidden="true"></i> </a>');

            }
            contador++;

            var inputNumber = $('.inputNumber');
            $(inputNumber[contador]).val('');
            var aPivot = $('.aPivot');
            // console.log('pivot 1 ' +JSON.stringify(('.pivot'[contador])) );
            numeroCuenta = $('.pivot');
            $(numeroCuenta[contador]).attr('id', 't' + contador);
            $(aPivot[contador - 1]).attr('onclick', 'removeCedeval(' + contador + ')');


        }

        function removeCedeval(id) {
            var numeroCuenta = $('.pivot');
            if ($(numeroCuenta).length == 2) {

                contador = 0;
            }

            $('#t' + id).remove();

        }
    </script>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Modificar perfil</h3>
        </div><!-- /.login-logo -->
        <div class="box-body">

            @include('alertas.errores')
            @include('alertas.flash')
            {{Form::model($user,['route'=>'modificarinfo.store','method' =>'PUT', 'id'=>'formulario','onsubmit'=>'animatedLoading()'])  }}

            <div class="form-group">
                {{ Form::label('Número de teléfono casa') }}
                {{ Form::number('numeroCasa',$numeroCasa,['class'=>'form-control','placeholder'=>'Ingrese el número de casa','required','id'=>'casa']) }}
            </div>

            <div class="form-group">
                {{ Form::label('Número de teléfono  celular') }}
                {{ Form::number('numeroCelular',$numeroCelular,['class'=>'form-control','placeholder'=>'Número de celular','required','id'=>'celular']) }}
            </div>

            <div class="form-group">
                {{ Form::label('Departamento') }}
                {!! Form::select('departamento',$departamentos,$direccion->MunicipioDireccion->Departamento->nombre,['class'=>'form-control', 'id'=>'department', 'onchange'=>'GetMunicipios(this)']) !!}

            </div>

            <div id="divmun" class="form-group">
                {{ Form::label('Municipio') }}
                {!! Form::select('municipio',$municipios,$direccion->MunicipioDireccion->nombre,['class'=>'form-control', 'id'=>'municipio']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('Dirección') }}
                {{ Form::text('direccion',$direccion->detalle,['class'=>'form-control','placeholder'=>'Ingrese la dirección','hidden','required']) }}
            </div>

            {!!Form::submit('Modificar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit'])!!}
            {{Form::close()}}

        </div><!-- /.login-box-body -->
    </div>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                <div id="mdbText" class="modal-body">
                    <p id="modalbody"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAlerta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                <div id="mdbText" class="modal-body">
                    <p>
                        <b>Recuerda, si cambias tu información, tus afiliaciónes
                            quedaran deshabilitadas, mientras las casas corredoras verifican
                            La nueva información, por lo tanto no podras seguir realizando ordenes de inversión</b>

                        ¿Deseas continuar?

                    </p>
                </div>
                <div class="modal-footer">
                    <input type="submit" form="formulario" data-dismiss="modal" onclick="submitForm();"
                           class="btn btn-danger" value="Aceptar">
                    <button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop