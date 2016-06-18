<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacoraUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',100);
            $table->string('tipo Cambio');
            $table->integer('idOrganizacion')->unsigned();
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idOrganizacion')
                ->references('id')->on('organizacion');
            $table->foreign('idUsuario')
                ->references('id')->on('usuarios');
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
