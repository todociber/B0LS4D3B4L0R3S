<?php

use Illuminate\Database\Migrations\Migration;

class TriggerTipoOEjecucion extends Migration
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
        DB::unprepared('DROP TRIGGER `TipoEjecucionnsert`;');
        DB::unprepared('DROP TRIGGER `TipoEjecucion_before_update`;');
        DB::unprepared('DROP TRIGGER `TipoEjecucion_before_delete`;');
    }
}
