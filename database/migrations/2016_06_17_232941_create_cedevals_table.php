<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCedevalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cedevals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cuenta', 50)->unique();
            $table->integer('idCliente')->unsigned();
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
        Schema::drop('cedevals');
    }
}
