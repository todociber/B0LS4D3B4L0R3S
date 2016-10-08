<?php

use Illuminate\Database\Seeder;

class SeederEstadoSolicitud extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_solicitud')->insert(array(
            'nombre' => 'Pendiente',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_solicitud')->insert(array(
            'nombre' => 'Aceptada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_solicitud')->insert(array(
            'nombre' => 'Rechazada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_solicitud')->insert(array(
            'nombre' => 'Procesando',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

    }
}
