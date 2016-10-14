<?php

use Illuminate\Database\Seeder;

class TriggerTipoOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `TipoOganizacionInsert` BEFORE INSERT ON `tipo_organizacion` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `TipoOganizacion_before_update` BEFORE UPDATE ON `tipo_organizacion` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_USERNAME') . "` TRIGGER `TipoOganizacion_before_delete` BEFORE DELETE ON `tipo_organizacion` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
    }
}
