<?php

use Illuminate\Database\Migrations\Migration;

class TriggerEstadoOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `EstadoOrdenInsert`;');
        DB::unprepared('DROP TRIGGER `EstadoOrden_before_update`;');
        DB::unprepared('DROP TRIGGER `EstadoOrden_before_delete`;');
    }
}
