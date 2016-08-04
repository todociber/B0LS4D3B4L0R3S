<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contenido',500);
            $table->integer('idTipoMensaje')->unsigned();
            $table->foreign('idTipoMensaje')->references('id')->on('tipo_mensajes');
            $table->integer('idOrden')->unsigned();
            $table->foreign('idOrden')->references('id')->on('ordenes');
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('usuarios');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mensajes');
    }
}
