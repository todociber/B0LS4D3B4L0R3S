<?php

use Illuminate\Database\Migrations\Migration;

class TriggerProtegerRol extends Migration
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
        DB::unprepared('DROP TRIGGER `ProtegerRolesInsert`;');
        DB::unprepared('DROP TRIGGER `roles_before_update`;');
        DB::unprepared('DROP TRIGGER `roles_before_delete`;');
    }
}
