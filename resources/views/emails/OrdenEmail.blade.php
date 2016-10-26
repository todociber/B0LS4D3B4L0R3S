@extends('beautymail::templates.minty')

@section('content')

    @include('beautymail::templates.minty.contentStart')

    <tr>
        <td class="paragraph">
            {{$titulo}}
        </td>
    </tr>
    <br/>

    <tr>
        <td>
            @include('beautymail::templates.minty.button', ['text' => 'Ver ordenes', 'link' => route('Ordenes.index')])
        </td>
    </tr>

    @include('beautymail::templates.minty.contentEnd')

@stop