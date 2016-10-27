<?php

use Illuminate\Database\Seeder;

class rolUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol_usuarios')->insert(array(
            'idUsuario' => 1,
            'idRol' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        DB::table('rol_usuarios')->insert(array(
            'idUsuario' => 2,
            'idRol' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('rol_usuarios')->insert(array(
            'idUsuario' => 2,
            'idRol' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('rol_usuarios')->insert(array(
            'idUsuario' => 2,
            'idRol' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
