@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')
    <tr>
        <td class="title">
            {{$titulo}} electrónico
        </td>
    </tr>

    <tr>
        <td class="paragraph">
            Confirme el cambio de correo electrónico dando click al botón, si usted no ha solicitado este cambio, ignore
            este correo y cambie su contraseña
        </td>
    </tr>
    <tr>
        <td class="paragraph">
            @include('beautymail::templates.minty.button', ['text' => 'Confirmar cambio de correo', 'link' => route('Token.cambioemail',["tokenDeUsuario"=>$token])])

        </td>
    </tr>


    @include('beautymail::templates.minty.contentEnd')

@stop