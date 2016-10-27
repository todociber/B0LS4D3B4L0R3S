<div class="form-group">
    {!!Form::label('Nombre')!!}
    {!!Form::text('nombre',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  Nombre del Usuario', 'required'=>'true'])!!}
</div>
<div class="form-group">
    {!!Form::label('Apellido')!!}
    {!!Form::text('apellido',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  Apellido del Usuario'])!!}
</div>
<div class="form-group">
    {!!Form::label('Correo')!!}
    {!!Form::email('email',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el  correo del Usuario'])!!}
</div>
<div class="form-group">

    <label>Roles a asignar</label><br/>
    <ul class="list-inline">

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
                    <li>{!!  Form::checkbox('rolUsuario[]', $rol->id,true)!!}</li>
                @else
                    <li>{!!  Form::checkbox('rolUsuario[]', $rol->id)!!}</li>
            @endif


            {!! Form::label($rol->nombre) !!}
            <br>
        @endforeach
    @else

        @foreach($roles as $rol)
            <br>
                <li> {!!  Form::checkbox('rolUsuario[]', $rol->id)!!}
            {!! Form::label($rol->nombre) !!}
                </li>
            <br>
        @endforeach
    @endif
    </ul>
    <br>

</div>

