@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Cambio de estado de orden
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            La orden con correlativo : {{$corrletaivo}} ha cambiado de estado a: {{$estadoOrden}}
        </td>
    </tr>
    <br/>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop