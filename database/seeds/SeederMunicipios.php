<?php

use Illuminate\Database\Seeder;

class SeederMunicipios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ESTOS SON DE EJEMPLO


        /*San Marcos pertenece a San Salvador,
         San Salvador tiene el id 6 en la tabla departamentos por eso el idDepartamento es ese*/

        DB::table('municipios')->insert(array(
            'nombre' => 'San Marcos',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        /*Zacatecoluca pertenece a La Paz,
         La Paz tiene el id 9 en la tabla departamentos por eso el idDepartamento es ese*/
        DB::table('municipios')->insert(array(
            'nombre' => 'Zacatecoluca',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //FIN DEL EJEMPLO

        //Continuen debajo de esta linea --


    }
}
