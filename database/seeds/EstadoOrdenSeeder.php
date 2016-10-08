<?php

use Illuminate\Database\Seeder;

class EstadoOrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_orden')->insert(array(
            'estado'=>'Pre-Vigente',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado'=>'Vigente',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado'=>'Cancelada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado'=>'Modificada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado'=>'Ejecutada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado'=>'Finalizada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado' => 'Vencida',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_orden')->insert(array(
            'estado' => 'Rechazada',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
      
    }
}
