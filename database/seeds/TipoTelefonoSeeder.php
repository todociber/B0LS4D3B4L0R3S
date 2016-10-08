<?php

use Illuminate\Database\Seeder;

class TipoTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_telefonos')->insert(array(
            'tipo' => 'Casa',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_telefonos')->insert(array(
            'tipo' => 'Celular',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
