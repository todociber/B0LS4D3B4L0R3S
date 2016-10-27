@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            {{$nombre}}
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Informacion: {{$titulo}}
        </td>
    </tr>


    <tr>
        <td width="100%" height="25"></td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop