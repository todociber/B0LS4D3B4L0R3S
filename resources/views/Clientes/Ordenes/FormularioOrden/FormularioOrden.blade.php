
<div class="form-group">
    <br><br>
    <label for="exampleInputEmail1">Cuenta CEDEVAL</label>
    {{Form::select('cedeval',$cedeval,null,['class'=>'form-control', 'id'=>'estado'])}}
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Seleccione la casa cual desea realizar la orden</label>
    {{Form::select('casas',$casas,null,['class'=>'form-control', 'required', 'id'=>'estado'])}}
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Seleccione el tipo de orden </label>
    {{Form::select('TipoOrden',$Tipoorden,$nombre = isset($orden) ? $orden->TipoOrdenN->nombre: null,['class'=>'form-control', 'required', 'id'=>'estado'])}}
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Seleccione el mercado</label>
    <select type="text" class="form-control" id="mercado" name="mercado">
        <option>Accion Primario</option>
        <option>Accion Secundario</option>
        <option>Primario</option>
    </select>
</div>
<br>


<div class="form-group">
    <h5 class="text-center"><strong>Caracteristicas de valor</strong> </h5>
    <div class="form-group">
        <label for="exampleInputEmail1">Seleccione el titulo de valor a adquirir</label>
        <select type="text" class="form-control" name="titulo">
            <option>ASESUISA</option>
            <option>AACSA</option>
            <option>AASESUISAV</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Emisor</label>
    {{ Form::label('Emisor') }}
    {{ Form::text('emisor',null,['class'=>'form-control','placeholder'=>'Ingrese el emisor', 'id'=>'emisor']) }}
</div>
<div class="form-group">
    {{ Form::label('Precio minimo el cual desea comprar/vender el valor') }}
    {{ Form::text('Pminimo',null,['class'=>'form-control','placeholder'=>'Ingrese el precio minimo', 'id'=>'pminimo']) }}
</div>
<div class="form-group">
    {{ Form::label('Precio máximo el cual desea comprar/vender el valor') }}
    {{ Form::text('PMaximo',null,['class'=>'form-control','placeholder'=>'Ingrese el precio maximo', 'id'=>'pmaximo']) }}
</div>
<div class="form-group" id="monto">
    {{ Form::label('Ingrese el monto de la inversion') }}
    {{ Form::text('monto',null,['class'=>'form-control','placeholder'=>'Ingrese el monto de la inversión']) }}
</div>

<div class="form-group">

    {{ Form::label('Fecha de nacimiento') }}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {{ Form::text('nacimiento',null,['class'=>'form-control input-pointer','placeholder'=>'Ingresa tu fecha de nacimiento (dd/mm/yyyy)', 'id'=>'datepicker']) }}
    </div>
</div>


