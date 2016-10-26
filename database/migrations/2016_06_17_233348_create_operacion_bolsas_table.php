<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->decimal('monto', 65, 2);
            $table->integer('idOrden')->unsigned();
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
        Schema::drop('operacion_bolsas');
    }
}
