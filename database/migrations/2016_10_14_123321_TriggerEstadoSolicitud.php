<?php

use Illuminate\Database\Migrations\Migration;

class TriggerEstadoSolicitud extends Migration
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
        DB::unprepared('DROP TRIGGER `EstadoSolicitudInsert`;');
        DB::unprepared('DROP TRIGGER `EstadoSolicitud_before_update`;');
        DB::unprepared('DROP TRIGGER `EstadoSolicitud_before_delete`;');
    }
}
