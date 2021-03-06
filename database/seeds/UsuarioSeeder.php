<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('usuarios')->insert(array(
            'idOrganizacion'=>1,
            'nombre'=>'admin',
            'apellido' =>'admin',
            'email' =>'admin@bves.com',
            'password' => bcrypt('12345'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        DB::table('usuarios')->insert(array(
            'idOrganizacion' => 2,
            'nombre' => 'Alexander ',
            'apellido' => 'Dominguez',
            'email' => 'alexlaley100@gmail.com',
            'password' => bcrypt('todociber'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        //
    }
}
