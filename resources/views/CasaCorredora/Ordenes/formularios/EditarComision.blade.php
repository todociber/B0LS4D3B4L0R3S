{!!Form::model($ordenes, ['route'=>['Ordenes.actualizar', $ordenes[0]->id], 'method'=>'PUT','onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

<br>
<input name="AgenteCorredor" id="AgenteCorredor" value="{{$ordenes[0]->idCorredor}}" size="40" style="display:none">
{!!Form::label('Comision')!!}
{!!Form::number('Comision',null, ['class'=>'form-control', 'placeholder'=>'Ingrese la Comision  a cobrar ','min'=>'0','step'=>'any', 'max'=>'100'])!!}
<br>
{!!Form::submit('Completar', ['class'=>'btn btn-info btn-flat'])!!}
{!!Form::close()!!}