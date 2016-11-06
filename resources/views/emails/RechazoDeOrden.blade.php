@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Rechazo de Orden {{$correlativo}}
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Su orden {{$correlativo}} en la institucion {{$nombrecasa}} a sido rechazada debido a : {{$motivoRechazo}}
        </td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop