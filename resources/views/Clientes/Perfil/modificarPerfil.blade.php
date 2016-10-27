@extends('layouts.ClientesLayout')

@section('title')
    <title>Modificar perfil</title>

@stop

@section('content')
    <script>
        $('#dui').mask('000000000');
        $('#nit').mask('00000000000000');
        var contador = 0;
        var clonar;

        $(function () {

          
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
            {{Form::model($user,['route'=>'setmodificarperfil','method' =>'POST', 'id'=>'formulario'])  }}
            <div class="form-group">
                {!!   Form::label('Nombre')!!}
                {!!   Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del usuario','required']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('Apellido') }}
                {{ Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el apellido del usuario','required']) }}
            </div>

            <div class="form-group">
                {{ Form::label('DUI') }}
                {{ Form::text('dui',$user->ClienteN->dui,['class'=>'form-control','placeholder'=>'Ingresa número de DUI','required', 'id'=>'dui']) }}
            </div>

            <div class="form-group">
                {{ Form::label('NIT') }}
                {{ Form::text('nit',$user->ClienteN->nit,['class'=>'form-control','placeholder'=>'Ingresa número de NIT','required','id'=>'nit']) }}
            </div>

            <div class="form-group">

                {{ Form::label('Fecha de nacimiento') }}
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {{ Form::text('fechaDeNacimiento',\Carbon\Carbon::parse($user->ClienteN->fechaDeNacimiento)->format("m/d/Y"),['class'=>'form-control input-pointer','placeholder'=>'Ingresa tu fecha de nacimiento (dd/mm/yyyy)', 'id'=>'datepicker']) }}
                </div>
            </div>




            {!!Form::button('Modificar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit','onclick'=>'openModalInfo()'])!!}
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
                        <b>Recuerda, si cambias esta información, tus afiliaciónes
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