<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('correlativo')->unique();
            $table->date('Fecha de vigencia');
            $table->string('titulo',100);
            $table->integer('cantidad de valores');
            $table->decimal('valor minimo');
            $table->decimal('valor maximo');
            $table->decimal('monto');
            $table->decimal('tasa de interes');
            $table->string('emisor');
            $table->integer('idTipoMercado')->unsigned();
            $table->integer('idCliente')->unsigned();
            $table->integer('idCorredor')->unsigned()->nuleable();
            $table->integer('idTipoOrden')->unsigned();
            $table->integer('idTipoEjecucion')->unsigned();
            $table->integer('idEstadoOrden')->unsigned();
            $table->integer('idOrganizacion')->unsigned();
            $table->integer('idOrden')->unsigned()->nuleable();

            $table->foreign('idTipoMercado')
                ->references('id')->on('tipo_mercados');
            $table->foreign('idCliente')
                ->references('id')->on('clientes');
            $table->foreign('idCorredor')
                ->references('id')->on('usuarios');
            $table->foreign('idTipoOrden')
                ->references('id')->on('tipo_orden');
            $table->foreign('idTipoEjecucion')
                ->references('id')->on('tipo_ejecucion');
            $table->foreign('idEstadoOrden')
                ->references('id')->on('estado_orden');
            $table->foreign('idOrganizacion')
                ->references('id')->on('organizacion');
            $table->foreign('idOrden')
                ->references('id')->on('ordenes');
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
        Schema::drop('ordenes');
    }
}
