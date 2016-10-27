@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Tu contraseña fue restaurada por un administrador
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            @include('beautymail::templates.minty.button', ['text' => 'Reactivar cuenta', 'link' => route('Token.Activacion',["tokenDeUsuario"=>$tokenDeUsuario])])

        </td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop