<?php

use Illuminate\Database\Migrations\Migration;

class TriggerProtegerMunicipio extends Migration
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
        DB::unprepared('DROP TRIGGER `ProtegerMunicipiosInsert`;');
        DB::unprepared('DROP TRIGGER `Municipios_before_update`;');
        DB::unprepared('DROP TRIGGER `Municipios_before_delete`;');

    }
}
