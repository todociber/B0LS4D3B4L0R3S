<?php

use Illuminate\Database\Migrations\Migration;

class TriggerTipoTelefono extends Migration
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
        DB::unprepared('DROP TRIGGER `TipoTelefonoInsert`;');
        DB::unprepared('DROP TRIGGER `TipoTelefono_before_update`;');
        DB::unprepared('DROP TRIGGER `TipoTelefono_before_delete`;');
    }
}
