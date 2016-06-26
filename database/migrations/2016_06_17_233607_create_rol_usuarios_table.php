<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUsuario')->unsigned();
            $table->integer('idRol')->unsigned();
            $table->integer('idCliente')->unsigned()->nuleable();
            $table->foreign('idUsuario')
                ->references('id')->on('usuarios');
            $table->foreign('idRol')
                ->references('id')->on('roles');
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
        Schema::drop('rol_usuarios');
    }
}
