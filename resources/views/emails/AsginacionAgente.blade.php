@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Asignacion de Agente Corredor
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Su orden {{$correlativo}} en la institucion {{$nombrecasa}} a sido completada y el agente {{$nombreAgente}}
            a sido asignado
        </td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop