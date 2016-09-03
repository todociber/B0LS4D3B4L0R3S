{!!Form::model($mensajes, ['route'=>['Ordenes.Comentar', $mensajes[0]->idOrden], 'method'=>'POST'])!!}
{!! Form::textarea('comentario',null, ['class' => 'color: black;font-family: Arial;', 'placeholder'=>'Escriba aqui su comentario']) !!}
<br>{!!Form::submit('Comentar ', ['class'=>'btn btn-info btn-flat','name'=>'btnComentar', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}
{!!Form::close()!!}