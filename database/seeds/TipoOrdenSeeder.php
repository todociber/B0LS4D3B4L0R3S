<?php

use Illuminate\Database\Seeder;

class TipoOrdenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_orden')->insert(array(
            'nombre'=>'Compra',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_orden')->insert(array(
            'nombre'=>'Venta',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
