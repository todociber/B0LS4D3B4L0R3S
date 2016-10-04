{!!Form::model($agentes, ['route'=>['Ordenes.ReAceptar', $orden->id], 'method'=>'PUT'])!!}
<label>Agente Corredor: </label>
<label id="AgenteSeleccionado" value="Sin Seleccionar">Sin Seleccionar </label>
<div class="bs-example bs-example-padded-bottom">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#SeleccionAgente">
        Seleccionar Agente Corredor
    </button>
</div>
<input name="AgenteCorredor" id="AgenteCorredor" value="" size="40" style="display:none">
<br>
<br>
{!!Form::submit('Completar', ['class'=>'btn btn-info btn-flat', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
{!!Form::close()!!}