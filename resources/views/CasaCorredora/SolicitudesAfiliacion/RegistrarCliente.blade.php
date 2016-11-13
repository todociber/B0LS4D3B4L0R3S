@extends('layouts.CasaCorredoraLayout')
@section('content')





    <script>
        var contador = 0;
        var clonar;
        $(function () {

            $("#department").select2();
            $("#municipio").select2();
            $('#dui').mask('000000000');
            $('#nit').mask('00000000000000');
            //$.fn.datepicker.defaults.language = 'es';
            $('#datepicker').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                cursor: 'pointer',
                maxDate: '-18Y',
                minDate: '-100Y',
                yearRange: '-100'
            });


            $('#department').prepend('<option val="" disabled selected>Seleccione un departamento</option>')
        });
        function charge() {
            waitingDialog.show('Procesando... ', {progressType: 'info'})
        }
        function stop() {
            waitingDialog.hide();
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
            if (contador < 4) {
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
            else {
                $('#modalbody').text("Solo puede agregar 5 cuentas cedevales");
                $('#modal').modal('show');
            }
        }
        function removeCedeval(id) {
            var numeroCuenta = $('.pivot');
            if ($(numeroCuenta).length == 2) {
                contador = 0;
            }
            $('#t' + id).remove();
        }
    </script>
    <title>Registro de clientes</title>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registro de cliente</h3>
                        </div>
                        <!-- /.login-logo -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
            @include('alertas.errores')
            @include('alertas.flash')
            {{Form::open(['route'=>'Registro.store','method' =>'POST', 'id'=>'form','onsubmit'=>'animatedLoading()'])  }}
            <div class="form-group">
                {!!   Form::label('Nombre')!!}
                {!!   Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del usuario','required','title'=>'Nombre del cliente']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('Apellido') }}
                {{ Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el apellido del usuario','required','title'=>'Apellido del cliente']) }}
            </div>

            <div class="form-group">
                {{ Form::label('DUI') }}
                {{ Form::text('dui',null,['class'=>'form-control','placeholder'=>'Ingresa número de DUI','required','id'=>'dui','maxlength'=>'9','title'=>'Numero de DUI sin guiones']) }}
            </div>

            <div class="form-group">
                {{ Form::label('NIT') }}
                {{ Form::text('nit',null,['class'=>'form-control','placeholder'=>'Ingresa número de NIT','required','id'=>'nit','maxlength'=>'14', 'title'=>'Numero de NIT sin guiones']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Email') }}
                {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingresa tu email','required']) }}
            </div>


            <div class="form-group">

                {{ Form::label('Fecha de nacimiento') }}
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>


                    {{ Form::text('nacimiento',null,['class'=>'form-control input-pointer','placeholder'=>'Ingresa tu fecha de nacimiento (dd/mm/yyyy)', 'id'=>'datepicker','required']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('Número de teléfono casa') }}
                {{ Form::text('numeroCasa',null,['class'=>'form-control','placeholder'=>'Ingrese el número de casa','required','id'=>'casa','pattern'=>'[0-9]{8}','maxlength'=>'8', 'title'=>'Numero de telefono sin guiones']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Número de teléfono  celular') }}
                {{ Form::text('numeroCelular',null,['class'=>'form-control','placeholder'=>'Número de celular','required', 'id'=>'celular','pattern'=>'[0-9]{8}','maxlength'=>'8', 'title'=>'Numero de telefono sin guiones']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Departamento') }}
                {!! Form::select('departamento',$departamentos,null,['class'=>'js-example-basic-single form-control ','required', 'id'=>'department', 'onchange'=>'GetMunicipios(this)', 'style'=>'width: 100%']) !!}
            </div>
            <div id="divmun" class="form-group" style="display: none;">
                <select id="municipio" name="municipio" class="form-control js-example-basic-single2"
                        style="width: 100%">

                </select>

            </div>
            <div class="form-group">
                {{ Form::label('Dirección') }}
                {{ Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la dirección', 'required']) }}
            </div>


            <div class="form-group">
                {{ Form::label('Cuenta cedeval') }}
                <a type="button" onclick="addCedeval()">
                    <i class="fa fa-plus-circle plus-button" aria-hidden="true"></i>
                </a>
                <div id="cedeval" class="cdv">
                    <div class="row pivot" id="numeroCuenta">
                        <div class="col-md-8 ">
                            <br/>
                            {{ Form::text('cedeval[][cuenta]',null,['class'=>'form-control inputNumber','placeholder'=>'Ingrese su cuenta cedeval','required','pattern'=>'[0-9]{10}','maxlength'=>'10', 'title'=>'Numero de cuenta cedeval  sin guiones']) }}
                        </div>
                        <div class="col-md-4 margin-TopDiv">

                        </div>
                    </div>

                    <!--<br/>-->
                </div>
            </div>


            <div class="form-group">
                {{ Form::label('Número de afiliación') }}
                {{ Form::text('numeroafiliacion',null,['class'=>'form-control','placeholder'=>'Ingrese el código de afiliación','required','id'=>'numeroafiliacion','pattern'=>'[0-9]{5}','maxlength'=>'5', 'title'=>'Numero de afiliacion']) }}
            </div>

                                    <div class="box-footer">
                                        {!!Form::submit('Registrar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit'])!!}
                                    </div>

            {{Form::close()}}
                                </div>
                            </div>
                        </div>
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
                <div id="mdbText" class="modal-body">
                    <p id="modalbody"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop