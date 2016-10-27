@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Respuesta de afiliación
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Tu Afiliacion a la casa corredora {{$nombreCasa}} ha sido {{$accionAfiliacion}}
        </td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop