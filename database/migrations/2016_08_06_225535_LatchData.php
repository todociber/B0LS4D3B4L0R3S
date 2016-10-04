<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LatchData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LatchDataToken', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tokenLatch', 500);
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('usuarios');
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
        Schema::drop('LatchDataToken');
    }
}
