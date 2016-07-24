
    {!!Form::label('Nombre')!!}
    {!!Form::text('nombre',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  Nombre del Usuario'])!!}
    {!!Form::label('Apellido')!!}
    {!!Form::text('apellido',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  Apellido del Usuario'])!!}
    {!!Form::label('Correo')!!}
    {!!Form::email('email',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  correo del Usuario'])!!}

    {!! Form::label('Rol del usuario') !!}

    @if(isset($rolSeleccionados))


        @foreach($roles as $rol)
            <?php

            $existe = 0;
            ?>

            @foreach($rolSeleccionados as $rolSelec)


                @if($rolSelec->idRol==$rol->id)
                    <?php
                    $existe = 1;
                    ?>
                @endif
            @endforeach
            <br>
            @if($existe==1)
                {!!  Form::checkbox('rolUsuario[]', $rol->id,true)!!}
            @else
                {!!  Form::checkbox('rolUsuario[]', $rol->id)!!}
            @endif


            {!! Form::label($rol->nombre) !!}
            <br>
        @endforeach
    @else

        @foreach($roles as $rol)
            <br>
            {!!  Form::checkbox('rolUsuario[]', $rol->id)!!}
            {!! Form::label($rol->nombre) !!}
            <br>
        @endforeach
    @endif
    <br>



