<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionBolsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operacion_bolsas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('monto');
            $table->integer('idOden')->unsigned();
            $table->foreign('idOden')
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
        Schema::drop('operacion_bolsas');
    }
}
