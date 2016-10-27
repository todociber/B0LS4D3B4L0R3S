@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Operación de bolsa
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Una Operacion de bolsa respecto a la orden {{$correlativoOrden}} ha sido registrada.
            <br> En la casa corredora {{$nombreCasa}}
        </td>
    </tr>
    <br/>

    @include('beautymail::templates.minty.contentEnd')

@stop