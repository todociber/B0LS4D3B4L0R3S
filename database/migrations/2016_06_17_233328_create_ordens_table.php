<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('correlativo', 3)->unique();
            $table->date('FechaDeVigencia');
            $table->string('titulo',100);
            $table->decimal('valorMinimo', 65, 2);
            $table->decimal('valorMaximo', 65, 2);
            $table->decimal('monto', 65, 2);
            $table->decimal('tasaDeInteres', 65, 2)->nullable();
            $table->decimal('comision', 65, 2)->nullable();
            $table->string('emisor', 50);
            $table->string('TipoMercado', 30);
            $table->integer('idCliente')->unsigned();
            $table->integer('idCorredor')->unsigned()->nullable();
            $table->integer('idTipoOrden')->unsigned();
            $table->integer('idTipoEjecucion')->unsigned();
            $table->integer('idEstadoOrden')->unsigned();
            $table->integer('idOrganizacion')->unsigned();
            $table->integer('idOrden')->unsigned()->nullable();
            $table->integer('idCuentaCedeval')->unsigned();
            $table->foreign('idCorredor')
                ->references('id')->on('usuarios');
            $table->foreign('idCliente')
                ->references('id')->on('clientes');
            $table->foreign('idTipoOrden')
                ->references('id')->on('tipo_orden');
            $table->foreign('idTipoEjecucion')
                ->references('id')->on('tipo_ejecucion');
            $table->foreign('idEstadoOrden')
                ->references('id')->on('estado_orden');
            $table->foreign('idOrganizacion')
                ->references('id')->on('organizacion');
            $table->foreign('idCuentaCedeval')
                ->references('id')->on('cedevals');
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
