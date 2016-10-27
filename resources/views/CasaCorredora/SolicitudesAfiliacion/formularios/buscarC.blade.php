{!!Form::open(['route'=>'Buscar.Cliente', 'method'=>'POST', 'onsubmit'=>"waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}


<div class="form-group">
    {{ Form::label('Numero de DUI de cliente a buscar: ') }}
    {{ Form::text('dui',null,['class'=>'form-control','placeholder'=>'Ingresa número de DUI','required','id'=>'dui', 'pattern'=>'[0-9]{9}','maxlength'=>'9','title'=>'Numero de DUI sin guiones']) }}
</div>


{!!Form::submit('Buscar Usuario', ['class'=>'btn btn-primary btn-flat','name'=>'btnCrearUsuario'])!!}
{!!Form::close()!!}
