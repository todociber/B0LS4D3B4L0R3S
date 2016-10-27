<?php

use Illuminate\Database\Migrations\Migration;

class EventoOrdenesVencidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('SET GLOBAL event_scheduler = ON;');
        DB::unprepared("CREATE EVENT `OrdenVencida`
	ON SCHEDULE
		EVERY 1 DAY STARTS '2016-10-01 23:55:00'
	ON COMPLETION PRESERVE
	ENABLE
	COMMENT ''
	DO BEGIN
DECLARE IDorden BIGINT;
DECLARE findelbucle INTEGER DEFAULT 0;
DECLARE cursor_ordenes CURSOR
FOR select id from ordenes where FechaDeVigencia = date_format(curdate(),'%Y-%m-%d') and (idEstadoOrden =1 or idEstadoOrden =2 or idEstadoOrden = 5);
DECLARE CONTINUE HANDLER FOR NOT FOUND SET findelbucle=1;
OPEN cursor_ordenes;
 bucle: LOOP
    FETCH cursor_ordenes INTO IDorden;
    IF findelbucle = 1 THEN
       LEAVE bucle;
    END IF;
 UPDATE ordenes SET idEstadoOrden=7 where id=IDorden;
  END LOOP bucle;
CLOSE cursor_ordenes;
END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::unprepared('DROP EVENT `OrdenVencida`;');
    }
}
