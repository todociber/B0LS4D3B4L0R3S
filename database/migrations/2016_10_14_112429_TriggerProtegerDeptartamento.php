<?php

use Illuminate\Database\Migrations\Migration;

class TriggerProtegerDeptartamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `ProtegerDepartamentosInsert`;');
        DB::unprepared('DROP TRIGGER `Departamentos_before_update`;');
        DB::unprepared('DROP TRIGGER `Departamentos_before_delete`;');
    }
}

                                                                                                                                                                                                                                                                                                                                                                                                            