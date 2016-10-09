{!!Form::open(['route'=>'OrdenesReporte.FechaBuscar', 'method'=>'POST', 'onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
<br>
Ingrese el rango de fechas que desea buscar:<br>
{{ Form::label('Fecha de inicial') }}
<div class="input-group date">
    <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
    </div>


    {{ Form::text('fechaInicial',null,['class'=>'form-control input-pointer','placeholder'=>'Ingresa tu fecha  incial (dd/mm/yyyy)', 'id'=>'datepicker','required']) }}
</div>
<br>

{{ Form::label('Fecha de final') }}
<div class="input-group date">
    <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
    </div>


    {{ Form::text('fechaFinal',null,['class'=>'form-control input-pointer','placeholder'=>'Ingresa tu fecha final (dd/mm/yyyy)', 'id'=>'datepicker2','required']) }}
</div>

<br><br>
Estado de Ordenes a Buscar:
{!! Form::select('estadoOrden',$estadosOrdenes,null,['class'=>'js-example-basic-single form-control ','required', 'id'=>'department', 'onchange'=>'GetMunicipios(this)', 'style'=>'width: 100%']) !!}

<br><br>

{!!Form::submit('Buscar', ['class'=>'btn btn-info btn-flat'])!!}
{!!Form::close()!!}