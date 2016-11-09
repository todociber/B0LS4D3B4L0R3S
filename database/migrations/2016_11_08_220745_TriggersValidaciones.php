<?php

use Illuminate\Database\Migrations\Migration;

class TriggersValidaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `bitacora_before_delete` BEFORE DELETE ON `bitacora` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `bitacora_before_update` BEFORE UPDATE ON `bitacora` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `clientes_before_delete` BEFORE DELETE ON `clientes` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "`TRIGGER `operacion_bolsas_before_insert` BEFORE INSERT ON `operacion_bolsas` FOR EACH ROW BEGIN
DECLARE estadoOrden INT ;
SET @estadoOrden= (select Count(*) from ordenes where idEstadoOrden = '5' or idEstadoOrden = '6' and id = new.idOrden);
IF(@estadoOrden =0) THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Operacion Bolsa No permitida';
END IF;

END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `rol_usuarios_before_delete` BEFORE DELETE ON `rol_usuarios` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");


        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `rol_usuarios_before_insert` BEFORE INSERT ON `rol_usuarios` FOR EACH ROW BEGIN
DECLARE rolComprobacion INT; 
DECLARE tipoUsuario INT; 
SET @rolComprobacion = (select COUNT(id) from rol_usuarios as ro where ro.idUsuario = new.idUsuario and ro.idRol = new.idRol and ro.deleted_at is null);
SET @tipoUsuario = (select u.idOrganizacion from usuarios as u where id = new.idUsuario);

IF(@rolComprobacion >0) THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ROL Duplicado';
END IF; 

IF(@tipoUsuario is null) THEN

IF(new.idRol <> 5 )THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL USUARIO NO PUEDE TENER ESTE ROL';
END IF; 

END IF;

IF (@tipoUsuario = 1) THEN

IF (new.idRol <> 1)THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL USUARIO NO PUEDE TENER ESTE ROL';
END IF;

END IF;

IF (@tipoUsuario>1)THEN
IF(new.idRol =1)THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL USUARIO NO PUEDE TENER ESTE ROL';
END IF;

IF(new.idRol =5)THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL USUARIO NO PUEDE TENER ESTE ROL';
END IF;

END IF;




END");


        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `rol_usuarios_before_update` BEFORE UPDATE ON `rol_usuarios` FOR EACH ROW BEGIN
DECLARE rolComprobacion INT; 
DECLARE tipoUsuario INT; 
IF (new.idRol != old.idRol) THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END IF; 

IF (new.idUsuario != old.idUsuario)THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END IF;

IF(new.deleted_at is null)THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END IF;


END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `solicitud_registros_before_insert` BEFORE INSERT ON `solicitud_registros` FOR EACH ROW BEGIN
DECLARE idCasa INT;
SET @idCasa = (select COUNT(id) from usuarios as u where u.id = new.idUsuario and u.idOrganizacion = new.idOrganizacion and u.deleted_at is null);
IF (@idCasa = 0) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ERROR EN RELACION DE DATOS';
END IF;
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `solicitud_registros_before_update` BEFORE UPDATE ON `solicitud_registros` FOR EACH ROW BEGIN

DECLARE idCasa INT;
SET @idCasa = (select COUNT(id) from usuarios as u where u.id = new.idUsuario and u.idOrganizacion = new.idOrganizacion and u.deleted_at is null);
IF (@idCasa = 0) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ERROR EN RELACION DE DATOS';
END IF;
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `usuarios_before_delete` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
END");
        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `usuarios_before_update` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
DECLARE idCliente INT; 
DECLARE idUsuario INT; 
IF (old.idOrganizacion is null) THEN
SET @idCliente = (select Count(id) from rol_usuarios as ru where ru.idUsuario = old.id and ru.idRol = 5 and deleted_at is null);
IF (new.idOrganizacion is not null) THEN
IF (@idCliente > 0) THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
 END IF;
 END IF; 
 ELSE 
 IF (new.idOrganizacion is null)THEN
 SET @idUsuario = (select Count(id) from rol_usuarios as ru where ru.idUsuario = old.id and ru.idRol < 5 and deleted_at is null);
 IF (@idUsuario >0) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se permiten cambios';
 END IF; 
 END IF;
 END IF; 
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `direcciones_before_insert` BEFORE INSERT ON `direcciones` FOR EACH ROW BEGIN
DECLARE contador  INT(2);
SET contador = (SELECT COUNT(*) from direcciones WHERE idCliente = new.idCliente AND deleted_at IS  NULL);
IF contador > 0 THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'UN CLIENTE NO PUEDE TENER DOS DIRECCIONES ACTIVAS';
END IF;
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `ordenes_BEFORE_INSERT` BEFORE INSERT ON `ordenes` FOR EACH ROW BEGIN

	
	DECLARE idCliente INT;
	DECLARE contadorAfiliacion INT;
 	SET idCliente = (SELECT idCliente FROM cedevals WHERE id = new.idCuentaCedeval);
 	SET contadorAfiliacion = (SELECT COUNT(*) FROM solicitud_registros WHERE idCliente = new.idCliente AND idEstadoSolicitud = 2 AND idOrganizacion =  new.idOrganizacion );
	IF new.idEstadoOrden = 2 OR new.idEstadoOrden = 3 OR new.idEstadoOrden = 5 OR new.idEstadoOrden = 6 OR new.idEstadoOrden = 7 OR new.idEstadoOrden = 8 THEN
     SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO PUEDE INGRESAR UNA ORDEN EN EL ESTADO COLOCADO';
    ELSEIF idCliente <> new.idCliente THEN
 	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO PUEDE GENERAR UNA ORDEN CON UNA CUENTA CEDEVAL QUE NO PERTENEZCA AL CLIENTE INGRESADO';
	   ELSEIF new.idOrganizacion = 1 THEN
 	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO PUEDE GENERAR ORDENES EN ESTA ORGANIZACION';
	  ELSEIF contadorAfiliacion = 0 THEN
 	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO PUEDE GENERAR ORDENES EN ESTA ORGANIZACION';
	END IF;
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `ordenes_before_update` BEFORE UPDATE ON `ordenes` FOR EACH ROW BEGIN

DECLARE contador INT(2);

SET contador = (SELECT COUNT(*) FROM ordenes WHERE id = old.id AND idEstadoOrden IN(3,4,5,6,7,8)); 

IF contador > 0 THEN
 SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO PUEDE MODIFICAR LAS ORDENES EN ESTADO VENCIDA,RECHAZADA,CANCELADA, MODIFICADA,EJECUTADA Y FINALIZADA';

END IF;

END");


        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "` TRIGGER `organizacion_before_delete` BEFORE DELETE ON `organizacion` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO SE PERMITE ELIMINAR DATOS';
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "`  TRIGGER `cedevals_before_delete` BEFORE DELETE ON `cedevals` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO SE PERMITE ELIMINAR DATOS';
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "`  TRIGGER `mensajes_before_delete` BEFORE DELETE ON `mensajes` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO SE PERMITE ELIMINAR DATOS';
END");

        DB::unprepared("CREATE DEFINER=`" . env('DB_USERNAME') . "`@`" . env('DB_HOST') . "`   TRIGGER `operacion_bolsas_before_delete` BEFORE DELETE ON `operacion_bolsas` FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'NO SE PERMITE ELIMINAR DATOS';
END");

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `bitacora_before_delete`;');
        DB::unprepared('DROP TRIGGER `bitacora_before_update`;');
        DB::unprepared('DROP TRIGGER `clientes_before_delete`;');
        DB::unprepared('DROP TRIGGER `operacion_bolsas_before_insert`;');
        DB::unprepared('DROP TRIGGER `rol_usuarios_before_delete`;');
        DB::unprepared('DROP TRIGGER `rol_usuarios_before_insert`;');
        DB::unprepared('DROP TRIGGER `rol_usuarios_before_update`;');
        DB::unprepared('DROP TRIGGER `solicitud_registros_before_insert`;');
        DB::unprepared('DROP TRIGGER `solicitud_registros_before_update`;');
        DB::unprepared('DROP TRIGGER `usuarios_before_delete`;');
        DB::unprepared('DROP TRIGGER `usuarios_before_update`;');
        DB::unprepared('DROP TRIGGER `direcciones_before_insert`;');
        DB::unprepared('DROP TRIGGER `ordenes_BEFORE_INSERT`;');
        DB::unprepared('DROP TRIGGER `organizacion_before_delete`;');
        DB::unprepared('DROP TRIGGER `cedevals_before_delete`;');
        DB::unprepared('DROP TRIGGER `mensajes_before_delete`;');
        DB::unprepared('DROP TRIGGER `operacion_bolsas_before_delete`;');





    }
}
