<?php

use Illuminate\Database\Migrations\Migration;

class TriggerTipoOrden extends Migration
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
        DB::unprepared('DROP TRIGGER `TipoOrdenInsert`;');
        DB::unprepared('DROP TRIGGER `TipoOrden_before_update`;');
        DB::unprepared('DROP TRIGGER `TipoOrden_before_delete`;');
    }
}
