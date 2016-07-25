<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',9);
            $table->integer('idTipoTelefono')->unsigned();
            $table->integer('idCliente')->unsigned();
            $table->foreign('idTipoTelefono')
                ->references('id')->on('tipo_telefonos');
            $table->foreign('idCliente')
                ->references('id')->on('clientes');
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
        Schema::drop('telefonos');
    }
}
