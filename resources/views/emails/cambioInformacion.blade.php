@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            {{$titulo}}
        </td>
    </tr>

    <tr>
        <td class="paragraph">


            @include('beautymail::templates.minty.button', ['text' => 'Ver cambios de información', 'link' => route('SolicitudAfiliacion.index')])

        </td>
    </tr>

    @include('beautymail::templates.minty.contentEnd')

@stop