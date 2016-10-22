<?php

use Illuminate\Database\Migrations\Migration;

class TriggerTipoMensaje extends Migration
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
        DB::unprepared('DROP TRIGGER `TipoMensajeInsert`;');
        DB::unprepared('DROP TRIGGER `TipoMensaje_before_update`;');
        DB::unprepared('DROP TRIGGER `TipoMensaje_before_delete`;');
    }
}
