<script>
            <?php
            $tituloAct = '';
            $tipomercado = '';
            if (isset($orden)) {
                $tituloAct = $orden->titulo;
                $tipomercado = $orden->TipoMercado;

            }?>
    var titulos = <?php echo json_encode($titulos); ?>;


    //$('#pminimo').mask('###0.00', {reverse: true, maxlength: false});
    //$('#pmaximo').mask('###0.00', {reverse: true, maxlength: false});
    //$('#total').mask('###0.00', {reverse: true, maxlength: false});

    $(function () {
        $("#selectedTitulo").select2();
    });
    function getEmisorTasa(valor) {
        animatedLoading();
        var titulo = $('#selectedTitulo').find(":selected").text();
        $('#titulo').val(titulo);
        var arrSplit = valor.split("+");
        var title = titulos[arrSplit[1]];
        console.log('TITLE ' + JSON.stringify(title));
        $('#tasa').val(title.tasaDeInteres);
        $.ajax({


            // la URL para la petición
            url: '{{route('getemisor',['id'=>""])}}/' + arrSplit[0],

            // la información a enviar
            // (también es posible utilizar una cadena de datos)
            data: {_token: $('input[name=_token]').val()},

            // especifica si será una petición POST o GET
            type: 'GET',

            // el tipo de información que se espera de respuesta
            dataType: 'json',

            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success: function (json, textStatus, xhr) {
                console.log('SUCESS ');
                $('#emisor').val(json.datos.Emisor.nombreEmisor);
                waitingDialog.hide();


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
                console.log('FINISH');
                waitingDialog.hide();
                if (xhr.status == 450) {


                    var response = JSON.parse(xhr.responseText);
                    $('#modalbody').text(response.error);

                    $('#modal').modal('show');
                }

            }
        });
    }
</script>
<div class="form-group">
    <br><br>
    <label for="exampleInputEmail1">Cuenta CEDEVAL</label>
    {{Form::select('cuentacedeval',$cedeval,$cedeval = isset($orden) ? $orden->CuentaCedeval->cuenta: null,['class'=>'form-control','required', 'id'=>'cuenta', 'required'])}}
</div>
<div class="form-group">

    @if (!isset($orden))
    <label for="exampleInputEmail1">Seleccione la casa cual desea realizar la orden</label>
        {{Form::select('casacorredora',$casas,null,['class'=>'form-control', 'required', 'id'=>'estado'])}}
    @else


    @endif
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Seleccione el tipo de orden </label>
    {{Form::select('tipodeorden',$Tipoorden,$nombre = isset($orden) ? $orden->TipoOrdenN->nombre: null,['class'=>'form-control', 'required', 'id'=>'estado'])}}
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Seleccione el mercado</label>
    <select type="text" class="form-control" required id="mercado" name="mercado">
        @foreach($TipoMercado as $tipo_mercado)
            <option {{$tp = $tipomercado == $tipo_mercado->nombreMercado ? 'selected':''}} value="{{$tipo_mercado->nombreMercado}}">{{$tipo_mercado->nombreMercado}}</option>
        @endforeach
    </select>
</div>
<br>


<div class="form-group">
    <h5 class="text-center"><strong>Caracteristicas de valor</strong> </h5>
    <div class="form-group">
        <label for="exampleInputEmail1">Seleccione el titulo de valor a adquirir</label>
        <select type="text" class="form-control" id="selectedTitulo" onchange="getEmisorTasa(this.value)">
            <option value="" selected disabled>Elija un titulo de valor</option>
            {{$i =0}}
            @foreach($titulos as $titulo)

                <option {{$ts = $tituloAct == $titulo->nombreTitulo ? 'selected':''}} value="{{$titulo->id}}+{{$i}}">{{$titulo->nombreTitulo}}</option>

                {{$i++}}
            @endforeach
        </select>
    </div>
</div>
<div class="form-group" style="display: none;">
    {{ Form::text('titulo',null,['class'=>'form-control','readonly','placeholder'=>'Ingrese el emisor','required', 'id'=>'titulo']) }}
</div>
<div class="form-group">
    {{ Form::label('Emisor') }}
    {{ Form::text('emisor',null,['class'=>'form-control','readonly','placeholder'=>'Ingrese el emisor','required', 'id'=>'emisor']) }}
</div>
<div class="form-group">
    {{ Form::label('Tasa de interes') }}
    {{ Form::number('tasaDeInteres',$tsd = isset($orden) ? $orden->tasaDeInteres:null,['class'=>'form-control','readonly','placeholder'=>'Ingrese la tasa de interes','required', 'id'=>'tasa']) }}
</div>
<div class="form-group">
    {{ Form::label('Precio minimo el cual desea comprar/vender el valor') }}
    {{ Form::number('valorMinimo',null,['class'=>'form-control','step'=>'0.01','placeholder'=>'Ingrese el precio minimo', 'id'=>'pminimo','required']) }}
</div>
<div class="form-group">
    {{ Form::label('Precio máximo el cual desea comprar/vender el valor') }}
    {{ Form::number('valorMaximo',null,['class'=>'form-control','step'=>'0.01','placeholder'=>'Ingrese el precio maximo', 'id'=>'pmaximo','required']) }}
</div>
<div class="form-group" id="monto">
    {{ Form::label('Ingrese el monto de la inversion') }}
    {{ Form::number('monto',null,['class'=>'form-control','step'=>'0.01','id'=>'total','placeholder'=>'Ingrese el monto de la inversión','required']) }}
</div>

<div class="form-group">

    {{ Form::label('Fecha de vencimiento') }}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('FechaDeVigencia',null,['class'=>'form-control input-pointer','required','placeholder'=>'Ingresa la fecha de vigencia de la orden (dd/mm/yyyy)', 'id'=>'datepicker']) }}
    </div>
</div>


