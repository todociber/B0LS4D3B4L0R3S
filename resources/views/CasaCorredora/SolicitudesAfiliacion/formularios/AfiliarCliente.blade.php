{!!Form::model($cliente, ['route'=>['Afiliar.Cliente', $cliente->id], 'method'=>'POST', 'onsubmit'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

<?php
$solicitud = null;
if (Session::has('solicitudN')) {

    $solicitud = \Session::get('solicitudN');
}



?>
<div class="form-group">
    {{ Form::label('Numero de Afiliacion ') }}
    {{ Form::text('numeroafiliacion',$n = $solicitud[0] ? $solicitud[0]->numeroDeAfiliado:'',['class'=>'form-control','placeholder'=>'Ingrese el código de afiliación','required','id'=>'numeroafiliacion','pattern'=>'[0-9]{5}','maxlength'=>'5', 'title'=>'Numero de afiliacion']) }}
</div>


{!!Form::submit('Afiliar Usuario', ['class'=>'btn btn-success btn-flat','name'=>'btnCrearUsuario'])!!}
{!!Form::close()!!}
