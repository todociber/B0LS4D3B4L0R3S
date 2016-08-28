<title>Registro</title>


<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
{!! Html::style('assets/css/bootstrap.css') !!}
        <!-- Font Awesome -->
{!! Html::style('assets/css/font-awesome.css') !!}
        <!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.css">
<!-- DataTables -->
{!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
        <!-- Theme style -->
{!! Html::style('assets/dist/css/AdminLTE.css') !!}
        <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
{!! Html::style('assets/dist/css/skins/_all-skins.css') !!}

{!! Html::style('assets/css/SERO.css') !!}


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


{!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}

{!! Html::script('assets/plugins/timepicker/bootstrap-timepicker.min.js') !!}
{!! Html::script('assets/plugins/datepicker/locales/bootstrap-datepicker.es.js') !!}

{!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}
{!! Html::script('assets/js/loading.js') !!}


<script>
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
        console.log('addcedeval ' + contador);
        var numeroCuenta = $('.pivot');
        var general = $('.cdv');

        $(numeroCuenta[contador]).clone().appendTo('#cedeval');

        if(contador == 0){


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
        $(numeroCuenta[contador]).attr('id','t'+contador);
        $(aPivot[contador-1]).attr('onclick','removeCedeval('+contador+')');


    }

    function removeCedeval(id) {
        var numeroCuenta = $('.pivot');
        if($(numeroCuenta).length == 2){

            contador = 0;
        }

      $('#t'+id).remove();

    }
</script>

<div class="form-box">
    <div class="login-logo">
        <a href="#"><b>Registro de</b> Cliente</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Complete los siguientes datos, este formulario enviara automaticamente la solitud
            a la Casa Corredora Seleccionada</p>
        @include('alertas.errores')
        @include('alertas.flash')
        {{Form::open(['route'=>'Registro.store','method' =>'POST', 'id'=>'form'])  }}
        <div class="form-group">
            {!!   Form::label('Nombre')!!}
            {!!   Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del usuario']) !!}
        </div>
        <div class="form-group">
            {{ Form::label('Apellido') }}
            {{ Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el apellido del usuario']) }}
        </div>

        <div class="form-group">
            {{ Form::label('DUI') }}
            {{ Form::text('dui',null,['class'=>'form-control','placeholder'=>'Ingresa número de DUI']) }}
        </div>

        <div class="form-group">
            {{ Form::label('NIT') }}
            {{ Form::text('nit',null,['class'=>'form-control','placeholder'=>'Ingresa número de NIT']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Email') }}
            {{ Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa tu correo electrónico']) }}
        </div>


        <div class="form-group">

            {{ Form::label('Fecha de nacimiento') }}
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('nacimiento',null,['class'=>'form-control input-pointer','placeholder'=>'Ingresa tu fecha de nacimiento (dd/mm/yyyy)', 'id'=>'datepicker']) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('Número de teléfono casa') }}
            {{ Form::text('numeroCasa',null,['class'=>'form-control','placeholder'=>'Ingrese el número de casa']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Número de teléfono  celular') }}
            {{ Form::text('numeroCelular',null,['class'=>'form-control','placeholder'=>'Número de celular']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Departamento') }}
            {!! Form::select('departamento',$departamentos,null,['class'=>'form-control', 'id'=>'department', 'onchange'=>'GetMunicipios(this)']) !!}

        </div>

        <div id="divmun" class="form-group" style="display: none;">
            <select id="municipio" name="municipio" class="form-control">

            </select>

        </div>
        <div class="form-group">
            {{ Form::label('Dirección') }}
            {{ Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la dirección']) }}
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
                        {{ Form::text('cedeval[][cuenta]',null,['class'=>'form-control inputNumber','placeholder'=>'Ingrese su cuenta cedeval']) }}
                    </div>
                    <div class="col-md-4 margin-TopDiv">

                    </div>
                </div>

                <!--<br/>-->
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('Casa corredora a afiliarse') }}
            {!! Form::select('casaCorredora',$casas,null,['class'=>'form-control', 'id'=>'casa']) !!}

        </div>

        <div class="form-group">
            {{ Form::label('Número de afiliación') }}
            {{ Form::text('numeroafiliacion',null,['class'=>'form-control','placeholder'=>'Ingrese el código de afiliación']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Contraseña') }}
            {{ Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese su contraseña']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Repita la contraseña') }}
            {{ Form::password('password2',['class'=>'form-control','placeholder'=>'Repita la contraseña']) }}
        </div>

        {!!Form::submit('Registrar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'btnSubmit', 'onclick'=>"waitingDialog.show('Procesando... ',{ progressType: 'info'})"])!!}
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
