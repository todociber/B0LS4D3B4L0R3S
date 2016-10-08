<html>
<head>
    <title>Restaurar Contrasña</title>

</head>
Tu contraséña fue reseteada por un administrador.
<br>
<h1>
    Para resetear tu contraseña sigue el siguiente link: </h1><br><br>


{!!link_to_route('Token.Activacion', $title = 'Restaurar Contraseña', $parameters = $tokenDeUsuario, $attributes = ['class'=>'btn btn-success','onclick'=>"waitingDialog.show('Cargando... ',{ progressType: 'info'});setTimeout(function () {waitingDialog.hide();}, 3000);"])!!}

</html>