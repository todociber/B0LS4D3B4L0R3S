<?php

use Illuminate\Database\Seeder;

class SedderTipoEjecucionOrden extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_ejecucion')->insert(array(
            'forma' => 'Parcial',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_ejecucion')->insert(array(
            'forma' => 'Completa',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_ejecucion')->insert(array(
            'forma' => 'Por definir',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
