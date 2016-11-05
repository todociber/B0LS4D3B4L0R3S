<?php

use Illuminate\Database\Seeder;

class SeederRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            'nombre' => 'Administrador Bolsa de Valores',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('roles')->insert(array(
            'nombre' => 'Administrador Casa Corredora',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('roles')->insert(array(
            'nombre' => 'Autorizador',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('roles')->insert(array(
            'nombre' => 'Agente Corredor',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('roles')->insert(array(
            'nombre' => 'Cliente',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
