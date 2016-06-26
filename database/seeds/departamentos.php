<?php

use Illuminate\Database\Seeder;

class departamentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert(array(
            'nombre'=>'Santa Ana',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Ahuachapan',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Sonsonate',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Chalatenango',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'La Libertad',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'San Salvador',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Cuscatlan',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Cabañas',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'La Paz',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'San Vicente',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'San Miguel',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Usulutan',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'La Union',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('departamentos')->insert(array(
            'nombre'=>'Morazan',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

    }
}
