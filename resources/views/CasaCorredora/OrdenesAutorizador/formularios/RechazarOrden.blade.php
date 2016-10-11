{!!Form::model($ordenes[0], ['route'=>['Ordenes.rechazar', $ordenes[0]->id], 'method'=>'POST'])!!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Rechazar orden</h4>
</div>
<div class="modal-body">
    {!! Form::textarea('comentario',null, ['class' => 'color: black;font-family: Arial;', 'placeholder'=>'Escriba aqui su motivo de rechazo para la orden','style'=>'width:100%']) !!}

</div>
<div class="modal-footer">


    {!!Form::submit('Rechazar ', ['class'=>'btn btn-info btn-flat','name'=>'btnComentar', 'onclick'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

</div>

<br>
{!!Form::close()!!}