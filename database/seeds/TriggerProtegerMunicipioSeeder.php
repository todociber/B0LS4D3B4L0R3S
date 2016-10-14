<?php

use Illuminate\Database\Seeder;

class TriggerProtegerMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `ProtegerMunicipiosInsert` BEFORE INSERT ON `municipios` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `Municipios_before_update` BEFORE UPDATE ON `municipios` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_USERNAME') . "` TRIGGER `Municipios_before_delete` BEFORE DELETE ON `municipios` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
    }
}
