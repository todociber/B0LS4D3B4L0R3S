
    {!!Form::label('Nombre')!!}
    {!!Form::text('nombre',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  Nombre del Usuario'])!!}
    {!!Form::label('Apellido')!!}
    {!!Form::text('apellido',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  Apellido del Usuario'])!!}
    {!!Form::label('Correo')!!}
    {!!Form::email('correo',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  correo del Usuario'])!!}

    {!! Form::label('Rol del Usuario') !!}
    {!! Form::select('rolUsuario', $roles, null, ['class' => 'form-control']) !!}
    <br>



