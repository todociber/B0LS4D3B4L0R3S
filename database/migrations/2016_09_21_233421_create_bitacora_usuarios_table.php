<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBitacoraUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUsuario')->unsigned();
            $table->integer('idUsuarioAfectado')->unsigned();
            $table->integer('idOrden')->unsigned();
            $table->integer('idModuloAfectado')->unsigned();
            $table->foreign('idModuloAfectado')
                ->references('id')->on('ModuloAfectado');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bitacora_usuarios');
    }
}
