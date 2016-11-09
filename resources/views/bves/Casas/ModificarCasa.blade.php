@extends('layouts.bolsavalores')
@section('title')
    <title>Modificar casa</title>
@stop


@section('content')
    <script>
        $(document).ready(function () {
            $('#casas').addClass('active');
            $('#registrar').addClass('active');
            $('#telefono').mask('00000000');
            $('#codigo').mask('00000');

            var buttonLada;
            var dataError;

            $('#modal').on('hidden.bs.modal', function () {
                if (dataError == '0') {

                    window.location.href = '{!! route('listadoCasas') !!}';
                }
            });
            // var btn = $('.ladda-button');
            //   var buttonLada = Ladda.create(btn);
        });

        var myDropzone;
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            paramName: "file",
            uploadMultiple: false,
            maxFilezise: 10,
            maxFiles: 1,
            addRemoveLinks: true,
            thumbnailWidth: 300,
            thumbnailHeight: 300,
            dictRemoveFile: "Quitar imagen",


            init: function () {
                console.log('init ');
                var submitBtn = document.querySelector("#clickable");
                myDropzone = this;


                var mockFile = {
                    name: "{{$organizacion->logo}}",
                    url: "{{asset('imgTemp/'.$organizacion->logo)}}.png",
                    file: "{{asset('imgTemp/'.$organizacion->logo)}}.png"

                };
                myDropzone.emit("addedfile", mockFile);

                mockFile.status = Dropzone.QUEUED;

                myDropzone.emit("thumbnail", mockFile, "{{asset('imgTemp/'.$organizacion->logo)}}.png");


                myDropzone.files.push(mockFile);


                submitBtn.addEventListener("click", function (e) {
                    console.log(JSON.stringify(myDropzone.files[0]));
                    if (myDropzone.files.length > 0) {

                        waitingDialog.show('Guardando Espere... ', {progressType: 'info'});
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();


                    }
                    else {
                        $('#modalbody').text('Debe subir una imagen');
                        $('#modal').modal('show');

                    }



                });
                this.on("addedfile", function (file) {
                    console.log(JSON.stringify(myDropzone.files[0]));

                });

                this.on("complete", function (file, response) {
                    myDropzone.removeFile(file);
                    // console.log('response ' + JSON.stringify(response));
                });

                this.on("success", function (file, data) {
                    console.log('success');
                    waitingDialog.hide();
                    //  waitingDialog.show('Guardando Espere... ',{ progressType: 'info'});
                    dataError = data.error;
                    if (data.error == '0') {
                        $('#modalbody').text('Datos guardados con exito');
                        window.location.href = '{{route('listadoCasas')}}'

                    }
                    else if (data.error == '2') {

                        var listadoError = "";
                        data.type.forEach(function (error) {
                            listadoError += error + "\n";
                        });
                        $('#modalbody').text(listadoError);
                    }
                    else if (data.error == '3') {

                        $('#modalbody').text('Ya exite una casa registrada con ese código');
                    } else if (data.error == '4') {

                        $('#modalbody').text('Ya exite una casa registrada con ese correo');
                    } else if (data.error == '5') {

                        $('#modalbody').text('La casa corredora tiene ordenes vigentes,por lo tanto no puede realizar ningun cambio');
                    }
                    else {

                        $('#modalbody').text('Ocurrio un problema al ingresar los datos');

                    }
                    $('#modal').modal('show');
                });
                this.on("error", function (file, error) {
                    waitingDialog.hide();
                    $('#modalbody').text('Ocurrio un problema al ingresar los datos');
                    $('#modal').modal('show');
                });


                this.on("success", myDropzone.processQueue.bind(myDropzone));


                // myDropzone.emit("complete", mockFile);

            }


        };


    </script>


    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Modificar Casas</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alertas.errores')
                                        @include('alertas.flash')
                                        {!! Form::model($organizacion,['route'=>['Bolsa.update', $organizacion->id],'method' =>'PUT', 'id'=>'my-dropzone','class' => 'dropzone', 'files' => true])   !!}
                                        @include('bves.Casas.Formulario.FormularioCasa')

                                    </div>

                                </div>
                            </div>
                            <br/>

                            <div class="box-footer">
                                {!!Form::button('Modificar', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'clickable','data-style'=>'expand-left'])!!}
                                <a class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalRestaurar">Reinicar
                                    contraseña administrador casa corredora </a>

                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div><!-- /.box -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                <div i class="modal-body">
                    <p id="modalbody"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRestaurar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                </div>
                <div i class="modal-body">
                    <p id="pd">¿Desea reinicar la contraseña del administrador de esta casa corredora?</p>
                </div>
                <div class="modal-footer">
                    <a data-dismiss="modal" class="btn btn-danger" href="#"
                       onclick="window.location.href='{{route('reiniciarpasswordcasa',["id"=>$organizacion->id])}}';animatedLoading()">Restaurar</a>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@stop