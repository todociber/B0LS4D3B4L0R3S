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
            Usuario: {{$usuario}}
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            {{$subtitulo}}
        </td>
    </tr>
    <br/>
    <tr>
        <td>
            @include('beautymail::templates.minty.button', ['text' => 'Active su cuenta', 'link' => route($ruta, ["tokenDeUsuario"=>$tokenDeUsuario])])
        </td>
    </tr>

    @include('beautymail::templates.minty.contentEnd')

@stop