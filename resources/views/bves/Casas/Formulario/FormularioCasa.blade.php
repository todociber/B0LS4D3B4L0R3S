<div class="form-group">
    {!!   Form::label('Nombre')!!}
    {!!   Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre de la organización']) !!}
</div>
<div class="form-group">
    {{ Form::label('Codigo') }}
    {{ Form::text('codigo',null,['class'=>'form-control','placeholder'=>'Ingresa el código asignado a la organización','required']) }}
</div>

<div class="form-group">
    {{ Form::label('Correo electrónico') }}
    {{ Form::text('correo',null,['class'=>'form-control','placeholder'=>'Ingresa el correo de la organización','required']) }}
</div>
<div class="form-group">
    {{ Form::label('Dirección') }}
    {{ Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingresa la dirección de la organización','required']) }}
</div>
<div class="form-group">
    {{ Form::label('Teléfono') }}
    {{ Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Ingresa el teléfono de la organización','required']) }}
</div>

<div class="form-group">
    <div id="dZUpload"  class="dz-message drop-border">
    <br/><br/>
    @if(isset($organizacion))

        {!!   Html::image($organizacion->logo) !!}
    @endif
    Haz click para subir una imagen.
    </div>
    <div class="dropzone-previews">


    </div>
</div>


<div class="form-group">
    {{ Form::label('Seleccione un estado') }}
    @if(isset($organizacion))
        <select class="form-control" id="estado"  name="Estado">
            @if($organizacion->deleted_at == null)
                <option selected value="1">Activo</option>
                <option value="0">Innactivo</option>
            @else

                <option  value="1">Activo</option>
                <option selected value="0">Innactivo</option>
            @endif
        </select>

    @else
        {{Form::select('Estado', array('Activo' => '1', 'Innactivo' => '0'),['class'=>'form-control', 'required', 'id'=>'estado'])}}
    @endif
</div>





