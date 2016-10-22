<?php

use Illuminate\Database\Migrations\Migration;

class TriggerTipoOrganizacion extends Migration
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
        DB::unprepared('DROP TRIGGER `TipoOganizacionInsert`;');
        DB::unprepared('DROP TRIGGER `TipoOganizacion_before_update`;');
        DB::unprepared('DROP TRIGGER `TipoOganizacion_before_delete`;');
    }
}
