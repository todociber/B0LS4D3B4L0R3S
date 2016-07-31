<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(departamentos::class);
        $this->call(SeederRoles::class);
        $this->call(SeederEstadoSolicitud::class);
    }
}
