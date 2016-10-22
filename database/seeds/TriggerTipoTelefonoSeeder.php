<?php

use Illuminate\Database\Seeder;

class TriggerTipoTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `TipoTelefonoInsert` BEFORE INSERT ON `tipo_telefonos` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `TipoTelefono_before_update` BEFORE UPDATE ON `tipo_telefonos` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_USERNAME') . "` TRIGGER `TipoTelefono_before_delete` BEFORE DELETE ON `tipo_telefonos` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
    }
}
