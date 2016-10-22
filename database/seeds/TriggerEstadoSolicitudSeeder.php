<?php

use Illuminate\Database\Seeder;

class TriggerEstadoSolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `EstadoSolicitudInsert` BEFORE INSERT ON `estado_solicitud` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `EstadoSolicitud_before_update` BEFORE UPDATE ON `estado_solicitud` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_USERNAME') . "` TRIGGER `EstadoSolicitud_before_delete` BEFORE DELETE ON `estado_solicitud` FOR EACH ROW BEGIN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
    }
}
