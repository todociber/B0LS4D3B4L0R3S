@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Comentario en tu Orden{{$correlativo}}
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Se ha realizado un comentario en tu orden correlativo {{$correlativo}} en la institucion {{$nombrecasa}}

        </td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop