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
        $this->call(SeederMunicipios::class);
         $this->call(SeederRoles::class);
         $this->call(SeederEstadoSolicitud::class);
         $this->call(EstadoOrdenSeeder::class);
         $this->call(TipoOrdenSeeder::class);
         $this->call(TipoOrganizacionSeeder::class);
         $this->call(OrganizacionSeeder::class);
         $this->call(UsuarioSeeder::class);
         $this->call(rolUsuario::class);
         $this->call(SedderTipoEjecucionOrden::class);
        $this->call(TipoTelefonoSeeder::class);
        $this->call(TipoMensaje::class);
        $this->call(TriggerProtegerRoles::class);
        $this->call(TriggerProtegerDepartamento::class);
        $this->call(TriggerProtegerMunicipioSeeder::class);
        $this->call(TriggerEstadoOrdenSeeder::class);
        $this->call(TriggerEstadoSolicitudSeeder::class);
        $this->call(TriggerTipoOrdenSeeder::class);
        $this->call(TriggerTipoOrganizacionSeeder::class);
        $this->call(TriggerTipoOEjecucionSeeder::class);
        $this->call(TriggerTipoTelefonoSeeder::class);
        $this->call(TriggerTipoMensajeSeeder::class);
    }
}
