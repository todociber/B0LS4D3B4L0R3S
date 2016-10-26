@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            Active su cuenta: {{$nombre}}
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Usuario: {{$usuario}}
        </td>
    </tr>
    <br/>
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