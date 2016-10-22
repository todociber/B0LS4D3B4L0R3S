<?php

use Illuminate\Database\Seeder;

class TriggerTipoOEjecucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `TipoEjecucionnsert` BEFORE INSERT ON `tipo_ejecucion` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `TipoEjecucion_before_update` BEFORE UPDATE ON `tipo_ejecucion` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_USERNAME') . "` TRIGGER `TipoEjecucion_before_delete` BEFORE DELETE ON `tipo_ejecucion` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
    }
}
