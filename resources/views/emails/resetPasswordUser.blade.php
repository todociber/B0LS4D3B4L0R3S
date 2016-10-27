@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Tu contraseña fue restaurada
        </td>
    </tr>
    <tr>
        <td class="paragraph">
            Da click al botón para restaurar tu contraseña
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            @include('beautymail::templates.minty.button', ['text' => 'Reactiva tu cuenta', 'link' => route('Token.Activacion',["tokenDeUsuario"=>$tokenDeUsuario])])

        </td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop