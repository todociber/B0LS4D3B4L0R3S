{!!Form::model($ordenes, ['route'=>['Ordenes.operacionesGuardar', $ordenes[0]->id], 'method'=>'POST'])!!}
<br>
{!!Form::label('Monto de la Operacion')!!}
{!!Form::number('Monto',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el monto de la Operacion','min'=>'1','step'=>'any'])!!}
<br>
{!!Form::submit('Guardar', ['class'=>'btn btn-info btn-flat', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
{!!Form::close()!!}