<html>
<head>
    <title>Activacion de Cuenta</title>

</head>
<h1>
    Por favor activa tu cuenta de correo: </h1><br><br>


{!!link_to_route('Token.Activacion', $title = 'Activar Cuenta', $parameters = $tokenDeUsuario, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

</html>