@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')




    @foreach($information as $info)


        <?php

        $municpio = $info->Municipio;




        ?>


        <br>
        <br>
        Departamento: <br>
        {{$info->nombre}}
        <br>
        Id Departamento:
        {{$info->id}}
        <br>
        <br>

        @foreach($municpio as $muni)
            <br>
            Municipio:
            {{$muni->nombre}}

            <br>

        @endforeach

        <br>
    @endforeach
    <br>
@stop