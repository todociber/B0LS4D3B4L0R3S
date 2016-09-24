@extends('layouts.bolsavalores')
@section('title')
    <title>Mi Perfil</title>
@stop
@section('content')
    <script>
        $('#perfil').addClass('active');

    </script>

        <div class="row">
            <div class="col-xs-12">
            <div class="box">
            <div class="box-body">


            <div class=" col-md-12 toppad" >
                   <div class="row">

                       <div class=" col-md-12 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>{{$user->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Apellido:</td>
                                        <td>{{$user->apellido}}</td>
                                    </tr>
                                    <tr>
                                        <td>Correo</td>
                                        <td>{{$user->email}}</td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Fecha de registro</td>
                                        <td>{{$user->created_at}}</td>
                                    </tr>


                                    </tr>

                                    </tbody>
                                </table>

                                <!--<a href="#" class="btn btn-primary">Editar mi informacion</a>-->
                                <a href="{{url('/logout')}}" class="btn btn-danger">Cerrar sesión</a>
                            </div>
                        </div>

            </div>
        </div>
        </div>
        </div>
@stop