<div class="form-group">
    {!!   Form::label('Nombre')!!}
    {!!   Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del usuario']) !!}
</div>
<div class="form-group">
    {{ Form::label('Apellido') }}
    {{ Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el apellido del usuario']) }}
</div>

<div class="form-group">
    {{ Form::label('Correo electrónico') }}
    {{ Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el correo institucional del usuario']) }}
</div>

<div class="form-group">
    {{ Form::label('Seleccione un estado') }}
    @if(isset($usuario))
        <select class="form-control" id="estado" name="Estado">
            @if($usuario->deleted_at == null)
                <option selected value="1">Activo</option>
                <option value="0">Inactivo</option>
            @else

                <option value="1">Activo</option>
                <option selected value="0">Innactivo</option>
            @endif
        </select>

    @else
        {{Form::select('Estado', array('1' => 'Activo', '0' => 'Innactivo'),null,['class'=>'form-control', 'required', 'id'=>'estado'])}}
    @endif
</div>





