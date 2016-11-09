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


    }
}
