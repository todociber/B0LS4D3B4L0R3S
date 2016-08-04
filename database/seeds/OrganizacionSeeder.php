<?php

use Illuminate\Database\Seeder;

class OrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizacion')->insert(array(
            'nombre'=>'Bolsa de valores de El Salvador',
            'logo'=>'test',
             'codigo' =>'00',
            'correo' =>'bves@bves.com',
            'direccion' =>'bves',
            'direccion' =>'12345678',
            'idTipoOrganizacion' =>2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('organizacion')->insert(array(
            'nombre'=>'Casa Corredora Maxima Ganancia',
            'logo'=>'test',
             'codigo' =>'02',
            'correo' =>'alexlaley10@gmail.com',
            'direccion' =>'bves',
            'direccion' =>'12345678',
            'idTipoOrganizacion' =>1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}
