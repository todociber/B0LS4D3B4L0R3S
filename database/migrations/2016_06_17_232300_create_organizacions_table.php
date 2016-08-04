<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo')->unique();
            $table->string('nombre',50);
            $table->string('logo',100);
            $table->string('correo',100);
            $table->string('direccion',100);
            $table->string('telefono',9);
            $table->integer('idTipoOrganizacion')->unsigned();
            $table->foreign('idTipoOrganizacion')->references('id')->on('tipo_organizacion');
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
        Schema::drop('organizacion');
    }
}
