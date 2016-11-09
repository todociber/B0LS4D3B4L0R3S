<?php

use Illuminate\Database\Migrations\Migration;

class ValidarTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('ALTER TABLE `ordenes`
	ALTER `valorMinimo` DROP DEFAULT,
	ALTER `valorMaximo` DROP DEFAULT,
	ALTER `monto` DROP DEFAULT;
ALTER TABLE `ordenes`
	CHANGE COLUMN `valorMinimo` `valorMinimo` DECIMAL(65,2) UNSIGNED NOT NULL AFTER `titulo`,
	CHANGE COLUMN `valorMaximo` `valorMaximo` DECIMAL(65,2) UNSIGNED NOT NULL AFTER `valorMinimo`,
	CHANGE COLUMN `monto` `monto` DECIMAL(65,2) UNSIGNED NOT NULL AFTER `valorMaximo`,
	CHANGE COLUMN `tasaDeInteres` `tasaDeInteres` DECIMAL(65,2) UNSIGNED NULL DEFAULT NULL AFTER `monto`,
	CHANGE COLUMN `comision` `comision` DECIMAL(65,2) UNSIGNED NULL DEFAULT NULL AFTER `tasaDeInteres`;
	
	ALTER TABLE `operacion_bolsas`
	ALTER `monto` DROP DEFAULT;
ALTER TABLE `operacion_bolsas`
	CHANGE COLUMN `monto` `monto` DECIMAL(65,2) UNSIGNED NOT NULL AFTER `id`;
	ALTER TABLE `organizacion`
	ADD UNIQUE INDEX `correo` (`correo`),
	ADD UNIQUE INDEX `telefono` (`telefono`);
	');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
