<?php

use Illuminate\Database\Seeder;

class TipoMensaje extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_mensajes')->insert(array(
            'nombre' => 'General',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_mensajes')->insert(array(
            'nombre' => 'Rechazo',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
