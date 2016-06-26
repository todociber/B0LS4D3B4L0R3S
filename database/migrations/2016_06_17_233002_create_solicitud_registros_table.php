<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('numero de afiliado',100);
            $table->string('comentario de rechazo',500);
            $table->foreign('idCliente')
                ->references('id')->on('clientes');
            $table->foreign('idOrganizacion')
                ->references('id')->on('organizacion');
            $table->foreign('idEstadoSolicitud')
                ->references('id')->on('estado_solicitud');
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
