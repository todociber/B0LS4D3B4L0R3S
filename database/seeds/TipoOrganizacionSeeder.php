<?php

use Illuminate\Database\Seeder;

class TipoOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_organizacion')->insert(array(
            'nombre'=>'Casa Corredora',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_organizacion')->insert(array(
            'nombre'=>'Bolsa de valores',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
