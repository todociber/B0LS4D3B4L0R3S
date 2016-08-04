<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('organizacion')->insert(array(
            'idOrganizacion'=>1,
            'nombre'=>'admin',
            'apellido' =>'admin',
            'email' =>'admin@bves.com',
            'password' =>Hash::make('12345'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        //
    }
}
