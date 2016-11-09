<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSolicitudRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCliente')->unsigned();
            $table->integer('idOrganizacion')->unsigned();
            $table->integer('idEstadoSolicitud')->unsigned();
            $table->integer('idUsuario')->nullable()->unsigned();
            $table->string('numeroDeAfiliado', 5);
            $table->string('comentarioDeRechazo', 500);
            $table->foreign('idCliente')
                ->references('id')->on('clientes');
            $table->foreign('idOrganizacion')
                ->references('id')->on('organizacion');
            $table->foreign('idEstadoSolicitud')
                ->references('id')->on('estado_solicitud');
            $table->foreign('idUsuario')
                ->references('id')->on('usuarios');
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
        Schema::drop('solicitud_registros');
    }
}
