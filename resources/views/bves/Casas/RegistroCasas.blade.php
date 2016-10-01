@extends('layouts.bolsavalores')
@section('title')
    <title>Nueva casa</title>
@stop


@section('content')
    <script>
        $(document).ready(function () {
            $('#casas').addClass('active');
            $('#registrar').addClass('active');
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


        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFilezise: 10,
            maxFiles: 1,
            addRemoveLinks: true,
            thumbnailWidth: 300,
            thumbnailHeight: 300,
            dictRemoveFile: "Quitar imagen",


            init: function () {
                var submitBtn = document.querySelector("#clickable");
                var myDropzone = this;

                submitBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                    if (myDropzone.files.length > 0) {
                        waitingDialog.show('Guardando Espere... ', {progressType: 'info'});
                    }
                    else {
                        $('#modalbody').text('Debe subir una imagen');
                        $('#modal').modal('show');

                    }
                });
                this.on("addedfile", function (file) {
                    //  alert("file uploaded");
                });

                this.on("complete", function (file, response) {
                    myDropzone.removeFile(file);
                    // console.log('response ' + JSON.stringify(response));
                });

                this.on("success", function (file, data) {
                    waitingDialog.hide();
                    dataError = data.error;
                    if (data.error == '0') {
                        $('#modalbody').text('Datos guardados con exito');


                    }
                    else if (data.error == '2') {

                        $('#modalbody').text('Faltan datos, asegure de llenar todos los campos del formulario o de escribir una dirección de correo eléctronica correctamente');
                    }
                    else if (data.error == '3') {

                        $('#modalbody').text('Ya exite una casa registrada con el código ingresado');
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


                this.on("success",
                        myDropzone.processQueue.bind(myDropzone)
                );
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
                            <h3 class="box-title">Registro de Casas</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alertas.errores')
                                        @include('alertas.flash')
                                        {{Form::open(['route'=>'Bolsa.store','method' =>'POST', 'id'=>'my-dropzone','class' => 'dropzone', 'files' => true])  }}
                                        @include('bves.Casas.Formulario.FormularioCasa')

                                </div>

                                </div>
                        </div>
                            <div class="box-footer">
                                {!!Form::submit('Registrar casa', ['class'=>'btn btn-primary btn-flat ladda-button','id'=>'clickable','data-style'=>'expand-left'])!!}
                            </div>
                            {{ Form::close() }}
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

@stop