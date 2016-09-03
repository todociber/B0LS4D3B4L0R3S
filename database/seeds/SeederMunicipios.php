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

        DB::table('municipios')->insert(array(
            'nombre' => 'Candelaria de la Frontera',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));


        DB::table('municipios')->insert(array(
            'nombre' => 'Chalchuapa',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Coatepeque',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Congo',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Masahuat',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Metapán',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Antonio Pajonal',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Sebastián Salitrillo',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Ana',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Rosa Guachipilín',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santiago de la Frontera',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Texistepeque',
            'id_departamento' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Ahuachapan

        DB::table('municipios')->insert(array(
            'nombre' => 'Ahuachapán ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Apaneca ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Atiquizaya ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Concepción de Ataco ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Refugio ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Guaymango ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Jujutla ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Francisco Menéndez ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Lorenzo ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Pedro Puxtla ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Tacuba ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Turín ',
            'id_departamento' => '2',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Sonsonate

        DB::table('municipios')->insert(array(
            'nombre' => 'Acajutla ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Armenia ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Caluco ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Cuisnahuat ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Izalco ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Juayúa ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nahuizalco ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nahulingo ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Salcoatitán ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Antonio del Monte ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Julián ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Catarina Masahuat ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Isabel Ishuatán ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santo Domingo de Guzmán ',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Sonsonate',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Sonzacate',
            'id_departamento' => '3',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Chalatenango

        DB::table('municipios')->insert(array(
            'nombre' => 'Agua Caliente',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Arcatao',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Azacualpa',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Cancasque',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Chalatenango',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Citalá',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Comapala',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Concepción Quezaltepeque',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Dulce Nombre de María',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Carrizal',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Paraíso',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'La Laguna',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'La Palma',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'La Reina',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Las Flores',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Las Vueltas',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nombre de Jesús',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nueva Concepción',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nueva Trinidad',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Ojos de Agua',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Potonico',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Antonio de la Cruz',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Antonio Los Ranchos',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Fernando',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Francisco Lempa',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Francisco Morazán',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Ignacio',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Isidro Labrador',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Luis del Carmen',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Miguel de Mercedes',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Rafael',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Rita',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Tejutla',
            'id_departamento' => '4',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de La Libertad

        DB::table('municipios')->insert(array(
            'nombre' => 'Antiguo Cuscatlán',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Chiltiupán',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Ciudad Arce',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Colón',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Comasagua',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Huizúcar',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Jayaque',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Jicalapa',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'La Libertad',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Tecla',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nuevo Cuscatlán',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Juan Opico',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Quezaltepeque',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Sacacoyo',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San José Villanueva',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Matías',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Pablo Tacachico',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Talnique',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Tamanique',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Teotepeque',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Tepecoyo',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Zaragoza',
            'id_departamento' => '5',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

            //Municipios de San Salvador
        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Aguilares',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Apopa',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Ayutuxtepeque',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Cuscatancingo',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Ciudad Delgado',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Paisnal',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Guazapa',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Ilopango',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Mejicanos',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Nejapa',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Panchimalco',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Rosario de Mora',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Marcos',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Martín',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Salvador',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santiago Texacuangos',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santo Tomás',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Soyapango',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Tonacatepeque',
            'id_departamento' => '6',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Cuscatlán


        DB::table('municipios')->insert(array(
            'nombre' => 'Candelaria',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Cojutepeque',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Carmen',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'El Rosario',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Monte San Juan',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Oratorio de Concepción',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Bartolomé Perulapía',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Cristóbal',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San José Guayabal',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Pedro Perulapán',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Rafael Cedros',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'San Ramón',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Cruz Analquito',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Cruz Michapa',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Suchitoto',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));
        DB::table('municipios')->insert(array(
            'nombre' => 'Tenancingo',
            'id_departamento' => '7',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Cabañas

        DB::table('municipios')->insert(array(
            'nombre' => 'Cinquera',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Dolores',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Guacotecti',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Ilobasco',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jutiapa',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Isidro',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Sensuntepeque',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Tejutepeque',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Victoria',
            'id_departamento' => '8',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        //Municipios de La Paz


        DB::table('municipios')->insert(array(
            'nombre' => 'Cuyultitán',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Rosario',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jerusalén',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Mercedes La Ceiba',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Olocuilta',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Paraíso de Osorio',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Antonio Masahuat',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Emigdio',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Francisco Chinameca',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Juan Nonualco',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Juan Talpa',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Juan Tepezontes',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Luis Talpa',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Luis La Herradura',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Migiuel Tepezontes',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Pedro Masahuat',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Pedro Nonualco',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Rafael Obrajuelo',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santa María Ostuma',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santiago Nonualco',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Tapalhuaca',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Zacatecoluca',
            'id_departamento' => '9',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de San Vicente


        DB::table('municipios')->insert(array(
            'nombre' => 'Apastepeque',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Guadalupe',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Cayetano Istepeque',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Esteban Catarina',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Ildefonso',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Lorenzo',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Vicente',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Clara',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santo Domingo',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Tecoluca',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Tepetitán',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Verapaz',
            'id_departamento' => '10',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de San Miguel


        DB::table('municipios')->insert(array(
            'nombre' => 'Carolina',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Chapeltique',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Chinameca',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Chirilagua',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Ciudad Barrios',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Comacarán',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Tránsito',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Lolotique',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Moncagua',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Nueva Guadalupe',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Nuevo Edén de San Juan',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Quelepa',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Antonio del Mosco',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Gerardo',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Jorge',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Luis de la Reina',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Miguel',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Rafael Oriente',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Sesori',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Uluazapa',
            'id_departamento' => '11',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Usulutan


        DB::table('municipios')->insert(array(
            'nombre' => 'Alegría',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Berlín',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'California',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Concepción Batres',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Triunfo',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Ereguayquín',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Estanzuelas',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jiquilisco',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jucuapa',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jucuarán',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Mercedes Umaña',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Nueva Granada',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Ozatlán',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Puerto El Triunfo',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Agustín',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Buenaventura',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Dionisio',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Francisco Javier',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Elena',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santa María',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santiago de María',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Tecapán',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Usulután',
            'id_departamento' => '12',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de La Unión


        DB::table('municipios')->insert(array(
            'nombre' => 'Anamorós',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Bolivar',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Concepción de Oriente',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Conchagua',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Carmen',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Sauce',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Intipucá',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'La Unión',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Lislique',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Meanguera del Golfo',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Nueva Esparta',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Pasaquina',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Polorós',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Alejo',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San José',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Santa Rosa de Lima',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Yayantique',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Yucuaciquín',
            'id_departamento' => '13',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        //Municipios de Morazán


        DB::table('municipios')->insert(array(
            'nombre' => 'Arambala',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Cacaopera',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Chilanga',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Corinto',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Delicias de Concepción',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Divisadero',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'El Rosario',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Gualocoti',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Guatajiagua',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Joateca',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jocoaitique',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Jocoro',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Lolotiquillo',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Meanguera',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Osicala',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Perquín',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Carlos',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Fernando',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Francisco Gotera',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Isidro',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'San Simón',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Sensembra',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Sociedad',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Torola',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Yamabal',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime

        ));

        DB::table('municipios')->insert(array(
            'nombre' => 'Yoloaiquín',
            'id_departamento' => '14',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

    }
}
