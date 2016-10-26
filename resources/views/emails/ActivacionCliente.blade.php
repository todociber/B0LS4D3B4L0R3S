@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Active su cuenta
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Haga click en el botón para activar su cuenta
        </td>
    </tr>

    <tr>
        <td>
            @include('beautymail::templates.minty.button', ['text' => 'Active su cuenta', 'link' => route('Token.Activacion', ["tokenDeUsuario"=>$tokenDeUsuario])])
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop