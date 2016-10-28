<?php

use Illuminate\Database\Migrations\Migration;

class ProcedimientoAlmacenadoOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
      CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` PROCEDURE `NuevaOrden`(IN idCliente INT,IN FechaDeVigencia DATE,tipodeorden INT,titulo VARCHAR(250),
                                                            valorMinimo DECIMAL(64,2), casacorredora INT,valorMaximo DECIMAL(64,2),
                                                            monto DECIMAL(64,2),cuentacedeval INT,
                                                            emisor VARCHAR(250),mercado VARCHAR(25),tasaDeInteres DECIMAL(64,2))
BEGIN
    DECLARE contador INT(10);
    DECLARE codigo INT(10);
    DECLARE correlativo VARCHAR(14);
    SET contador = ( SELECT COUNT(*) FROM  ordenes WHERE idOrganizacion = casacorredora);
    SET codigo  = ( SELECT organizacion.codigo FROM  organizacion WHERE id = casacorredora);
    IF contador=0 THEN
      SET contador = 1;
    ELSE
      SET contador = contador +1;
    END IF;
    SET correlativo = (SELECT CONCAT(codigo,'-',contador ));
    INSERT INTO ordenes  (ordenes.correlativo,ordenes.idCliente,
    ordenes.FechaDeVigencia,ordenes.titulo,
    ordenes.valorMaximo, ordenes.valorMinimo,ordenes.monto,
    ordenes.emisor,ordenes.TipoMercado,ordenes.idTipoOrden,
    ordenes.idTipoEjecucion,ordenes.idEstadoOrden,ordenes.idOrganizacion,
    ordenes.idCuentaCedeval, ordenes.tasaDeInteres,ordenes.created_at)
    VALUES(correlativo,idCliente,FechaDeVigencia,
    titulo,valorMaximo,valorMinimo,
    monto,emisor,mercado,tipodeorden,3,1,
    casacorredora,cuentacedeval,tasaDeInteres,now());
  END;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::unprepared('DROP PROCEDURE `NuevaOrden`;');
    }
}
