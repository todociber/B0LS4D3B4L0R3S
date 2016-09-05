{!!Form::model($ordenes, ['route'=>['Ordenes.aceptar', $ordenes[0]->id], 'method'=>'PUT'])!!}

<br>
{!!Form::label('Comision')!!}
{!!Form::number('Comision',null, ['class'=>'form-control', 'placeholder'=>'Ingrese la Comision  a cobrar ','min'=>'0','step'=>'any'])!!}
<br>
{!!Form::submit('Completar', ['class'=>'btn btn-info btn-flat', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
{!!Form::close()!!}