{!!Form::model($agentes, ['route'=>['Ordenes.aceptar', $orden->id], 'method'=>'PUT','onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
<label>Agente Corredor: </label>
<label id="AgenteSeleccionado" value="Sin Seleccionar">Sin Seleccionar </label>
<div class="bs-example bs-example-padded-bottom">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#SeleccionAgente">
        Seleccionar Agente Corredor
    </button>
</div>
<input name="AgenteCorredor" id="AgenteCorredor" value="" size="40" style="display:none">
<br>
{!!Form::label('Comision')!!}
{!!Form::number('Comision',null, ['class'=>'form-control', 'placeholder'=>'Ingrese la Comision  a cobrar ','min'=>'0','step'=>'any', 'max'=>'100'])!!}
<br>
{!!Form::submit('Completar', ['class'=>'btn btn-info btn-flat'])!!}
{!!Form::close()!!}