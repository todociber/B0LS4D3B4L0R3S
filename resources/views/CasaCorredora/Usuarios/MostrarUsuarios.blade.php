@extends('layouts.ClientesLayout')

@section('title')
    <title>Usuarios Casa Corredora</title>

@stop
@section('content')




    @foreach($information as $info)

        {{$info->nombre}}

        <?php

        $muns = $info->Municipio;
        ?>
        @foreach($muns as $dir)

            <?php $direccionActual = $dir->Direccione; ?>
            <br>
            {{$dir->nombre}}
            <br>

            @foreach($direccionActual as $direccionDetalle)
                <br>

                {{$direccionDetalle->ClienteDireccionN->dui}}
            <br>



            @endforeach

        @endforeach
        <br>
    @endforeach
    <br>
@stop