<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/login');
});



Route::resource('Login','LoginController');


//------CLIENTES ROUTES----//



//-----CASA CORREDORA ROUTES----//


//-----REGISTRO----//

Route::resource('Registro', 'RegistroController');


//----REGISTRO----//

Route::post('getMunicipios', 'RegistroController@getMunicipios')->name('getMun');
//---REGISTRO--//

Route::group(['middleware' => 'auth'], function () {

    Route::get('LatchSolicitud', 'LatchController@LatchSolicitud')->name('Latch.index');
    Route::post('Parear', 'LatchController@pair')->name('Latch.parear');
    Route::get('Desenparejar', 'LatchController@unpair')->name('Latch.desenparejar');

    Route::group(['middleware' => 'bolsa'], function () {
        Route::get('bolsa/NuevaCasa', 'BolsaController@NuevaCasa')->name('nuevaCasa');
        Route::get('bolsa/EditarCasa/{id}', 'BolsaController@editarCasa')->name('editarCasa');
        Route::get('bolsa/ListadoCasas', 'BolsaController@ListadoCasas')->name('listadoCasas');
        Route::get('bolsa/bitacoras', 'BolsaController@bitacoras')->name('bitacoras');
        Route::post('bolsa/EliminarRestaurar', 'BolsaController@eliminarRestaurarCasa')->name('eliminarrestaurarcasas');
        Route::resource('Bolsa', 'BolsaController');
        Route::post('bolsa/Upload', 'BolsaController@Upload')->name('upload');
        Route::get('bolsa/CatalogoUsuarios', 'UsuariosBolsaController@ListadoUsuario')->name('catalogoUsuarios');
        Route::get('bolsa/NuevoUsuario', 'UsuariosBolsaController@NuevoUsuario')->name('nuevoUsuario');
        Route::get('bolsa/ModificarUsuario/{id}', 'UsuariosBolsaController@ModificarUsuario')->name('modificarusuario');
        Route::get('bolsa/MiPerfil', 'UsuariosBolsaController@MiPerfil')->name('miPerfil');
        Route::post('bolsa/EliminarRestaurarUsuario', 'UsuariosBolsaController@EliminarRestaurarUsuario')->name('eliminarrestaurar');
        Route::get('bolsa/RestaurarUsuario/{id}', 'UsuariosBolsaController@RestaurarUsuario')->name('restaurarusuario');
        Route::get('bolsa/RestaurarPassword/{id}', 'UsuariosBolsaController@resetPassword')->name('restaurarpassword');
        Route::get('bolsa/ReinicarPasswordCasa/{id}', 'BolsaController@ResetPasswordCasa')->name('reiniciarpasswordcasa');
        Route::resource('UsuarioBolsa', 'UsuariosBolsaController');
    });

    Route::group(['middleware' => 'cliente'], function () {
        Route::get('Cliente/NuevaOrden', 'ClientesController@NuevaOrden')->name('nuevaOrden');
        Route::get('Cliente/ListadoOrdenesV', 'ClientesController@ListadoOrdenes')->name('listadoordenesclienteV');
        Route::get('Cliente/getOrdenes/{id}', 'ClientesController@OrdenesByID')->name('getOrdenes');
        Route::get('Cliente/ModificarOrden/{id}', 'ClientesController@modificarOrden')->name('modificarorden');
        Route::post('Cliente/setMensaje', 'ClientesController@storeMensajes')->name('setMensaje');
        Route::put('Cliente/AnularOrden/{id}', 'ClientesController@AnularOrden')->name('anularorden');
        Route::put('Cliente/EjecutarOrden', 'ClientesController@ejecutarOrden')->name('ejecutarorden');
        Route::get('Cliente/FiltrarOrden', 'ClientesController@ordenesbyEstado')->name('filtrarOrden');
        Route::get('Cliente/OrdenesPadre/{id}', 'ClientesController@ListadoOrdenesPadre')->name('listadordenespadre');
        Route::get('Cliente/Miperfil', 'ClientesController@miPerfilUsuario')->name('perfilcliente');
        Route::get('Cliente/ModificarPerfil', 'ClientesController@modificarPerfil')->name('modificarperfilCliente');
        Route::get('Cliente/ModificarInformacion', 'ClientesController@CambiarInfoNVpage')->name('modificarnorerelevante');
        Route::get('Cliente/ModificarEmail', 'ClientesController@modificarCorreoView')->name('modificaremailV');
        Route::post('Cliente/setModificarPerfil', 'ClientesController@modificarPerfilCliente')->name('setmodificarperfil');
        Route::put('Cliente/setModificarInformacion', 'ClientesController@modifcarInfoNVP')->name('modificarinfo.store');
        Route::put('Cliente/ModificarCorreo', 'ClientesController@modificarCorreoUpdate')->name('modificarcorreo.update');
        Route::get('Cliente/AfiliarseCasa', 'ClientesController@AfiliacionCliente')->name('afiliarsecasa');
        Route::post('Cliente/AfiliarseCasaStore', 'ClientesController@AfiliacionClienteStore')->name('afiliacioncasastore');
        Route::get('Cliente/ListadoAfiliaciones', 'ClientesController@ListadoAfiliaciones')->name('listadoafiliaciones');
        Route::get('Cliente/ListadoSolicitudes', 'ClientesController@ListadoSolicitudes')->name('listadsolicitudes');
        Route::get('Cliente/CuentasCedevales', 'ClientesController@CuentasCedevales')->name('cuentascedevales');
        Route::delete('Cliente/eliminarCedeval', 'ClientesController@EliminarCedeval')->name('eliminarcedeval');
        Route::post('Cliente/agregarCedeval', 'ClientesController@AgregarCedeval')->name('agregarcedeval');
        Route::get('Cliente/cambiarPassword', 'ClientesController@modificarPassword')->name('modificarpassword');
        Route::put('Cliente/cambiarPasswordUpdate', 'ClientesController@modificarPasswordUpdate')->name('modificarpasswordupdate');
        Route::get('Cliente/getEmisor/{id}', 'ClientesController@getEmisor')->name('getemisor');
        Route::resource('Clientes', 'ClientesController');
    });


    Route::group(['middleware' => 'UsuarioCasaCorredora'], function () {
        Route::group(['middleware' => 'administradorCasaCorredora'], function () {
            Route::get('UsuarioCasaCorredora/crear', 'UsuarioCasaCorredoraController@crear')->name('UsuarioCasaCorredora.crear');
            Route::get('UsuarioCasaCorredora/{id}/editar', 'UsuarioCasaCorredoraController@editar')->name('UsuarioCasaCorredora.editar');
            Route::put('UsuarioCasaCorredora/restaurar', 'UsuarioCasaCorredoraController@restaurar')->name('UsuarioCasaCorredora.restaurar');
            Route::get('UsuarioCasaCorredora/{id}/resetear', 'UsuarioCasaCorredoraController@resetar')->name('UsuarioCasaCorredora.resetearpassword');
            Route::delete('UsuarioCasaCorredora/desactivarusuario', 'UsuarioCasaCorredoraController@desactivarUsuario')->name('UsuarioCasaCorredora.desactivar');
            Route::resource('UsuarioCasaCorredora', 'UsuarioCasaCorredoraController');
            Route::get('Perfil', 'UsuarioCasaCorredoraController@perfil')->name('Perfil.UsuarioCasa');
            Route::get('Ordenes/Reasignacion', 'OrdenesController@reasignar')->name('Ordenes.Reasignacion');
            Route::put('Ordenes/{id}/ReAceptar', 'OrdenesCasaCorredoraAutorizador@ReAceptar')->name('Ordenes.ReAceptar');
            Route::get('Ordenes/{id}/detallesEliminar/', 'OrdenesCasaCorredoraAutorizador@detallesEliminar')->name('Ordenes.detallesEliminar');
            Route::get('Historial/Usuarios', 'BitacoraCasaCorredora@HistoricoUsuario')->name('Historial.UsuariosCasa');
        });
        Route::group(['middleware' => 'OperadorCasaCorredora'], function () {
            Route::get('Bitacora', 'BitacoraCasaCorredora@index')->name('bitacora');
            Route::get('SolicitudAfiliacion/{id}/detalle', 'SolicitudesCasaCorredora@detalle')->name('SolicitudAfiliacion.detalle');
            Route::get('SolicitudAfiliacion/{id}/aceptar', 'SolicitudesCasaCorredora@aceptar')->name('SolicitudAfiliacion.aceptar');
            Route::get('SolicitudAfiliacion/procesando', 'SolicitudesCasaCorredora@Procesando')->name('SolicitudAfiliacion.proceso');
            Route::get('SolicitudAfiliacion/procesadas', 'SolicitudesCasaCorredora@Procesadas');
            Route::get('SolicitudAfiliacion/{id}/procesar', 'SolicitudesCasaCorredora@Procesar')->name('SolicitudAfiliacion.procesar');
            Route::get('SolicitudAfiliacion/AfiliacionesCanceladas', 'SolicitudesCasaCorredora@AfiliacionesCanceladas')->name('SolicitudAfiliacion.canceladas');
            Route::get('Afiliados', 'SolicitudesCasaCorredora@afiliados')->name('Afiliados.index');
            Route::post('Afiliados/eliminar', 'SolicitudesCasaCorredora@eliminar')->name('Afiliado.eliminar');
            Route::resource('SolicitudAfiliacion', 'SolicitudesCasaCorredora');
            Route::get('Ordenes/{id}/asignar', 'OrdenesCasaCorredoraAutorizador@asignar')->name('Ordenes.asignar');
            Route::get('Ordenes/{id}/detalles', 'OrdenesCasaCorredoraAutorizador@detalles')->name('Ordenes.detalles');
            Route::get('Ordenes/{id}/detalles/Historial', 'OrdenesController@Historial')->name('Ordenes.historial');
            Route::get('Ordenes/{id}/detallesEliminar/', 'OrdenesCasaCorredoraAutorizador@detallesEliminar')->name('Ordenes.detallesEliminar');
            Route::put('Ordenes/{id}/aceptar', 'OrdenesCasaCorredoraAutorizador@aceptar')->name('Ordenes.aceptar');
            Route::put('Ordenes/{id}/ReAceptar', 'OrdenesCasaCorredoraAutorizador@ReAceptar')->name('Ordenes.ReAceptar');
            Route::get('Ordenes/{id}/rechazar', 'OrdenesCasaCorredoraAutorizador@rechazar')->name('Ordenes.rechazar');
            Route::post('Ordenes/{id}/comentar', 'OrdenesController@Comentar')->name('Ordenes.Comentar');
            Route::put('Ordenes/{id}/actualizar', 'OrdenesController@Actualizar')->name('Ordenes.actualizar');
            Route::get('Ordenes/{id}/Operaciones', 'OrdenesController@Operaciones')->name('Ordenes.operaciones');
            Route::post('Ordenes/{id}/Operaciones/Guardar', 'OrdenesController@OperacionesGuardar')->name('Ordenes.operacionesGuardar');
            Route::get('Ordenes/Reasignacion', 'OrdenesController@reasignar')->name('Ordenes.Reasignacion');
            Route::get('Ordenes/{id}/DetallePDF', 'OrdenesController@DetalleOrdenPDF')->name('OrdenesDetalles.PDF');
            Route::get('Ordenes/Reporte', 'OrdenesController@ReporteFecha')->name('OrdenesReporte.Fecha');
            Route::post('Ordenes/ReporteFecha', 'OrdenesController@ReporteFechaBuscar')->name('OrdenesReporte.FechaBuscar');
            Route::get('Ordenes/ReportePDF', 'OrdenesController@DetallesOrdenesPDF')->name('OrdenesReporte.PDF');
            Route::get('Order/ListadoGeneralAutorizador', 'OrdenesCasaCorredoraAutorizador@ListadoGeneralAutorizador')->name('ordenesautorizador');
            Route::get('Order/FiltrarOrdenAu', 'OrdenesController@ordenesbyEstadoAu')->name('ordenesbyestadoauth');
            Route::get('Ordenes/{id}/editarOrden', 'OrdenesController@Editar')->name('Ordenes.editar');
            Route::get('RegistrarClientes', 'RegistroController@index')->name('Registrar.Clientes');
            Route::get('BuscarCliente', 'SolicitudesCasaCorredora@buscarCliente')->name('Buscar.Cliente');
            Route::post('BuscarCliente', 'SolicitudesCasaCorredora@buscarClientePost')->name('Buscar.Cliente');
            Route::post('Afiliar/{id}/Cliente', 'SolicitudesCasaCorredora@afiliarCliente')->name('Afiliar.Cliente');
            Route::get('Perfil', 'UsuarioCasaCorredoraController@perfil')->name('Perfil.UsuarioCasa');
            Route::resource('Ordenes', 'OrdenesCasaCorredoraAutorizador');
            Route::get('Ordenes/Reasignacion/Usuario', 'OrdenesController@ReasignacionUsuario')->name('Ordenes.Reasignacion.Usuario');
            Route::get('Ordenes/Reasignacion/{id}/Orden', 'OrdenesController@ReasignacionOrdenes')->name('Ordenes.Reasignacion.Orden');
            Route::get('Ordenes/Reasignacion/{id}/Orden/NuevoAgente/{agente}', 'OrdenesController@ReasignacionAgente')->name('Ordenes.Reasignacion.NuevoAgente');
            Route::put('Ordenes/AceptarReasignacion/{id}', 'OrdenesController@AceptarReasignacion')->name('Ordenes.AceptarReasignacion');
        });
        Route::group(['middleware' => 'AgenteCorredor'], function () {
            Route::get('Ordenes/{id}/asignar', 'OrdenesCasaCorredoraAutorizador@asignar')->name('Ordenes.asignar');
            Route::get('Ordenes/{id}/detalles', 'OrdenesCasaCorredoraAutorizador@detalles')->name('Ordenes.detalles');
            Route::get('Ordenes/{id}/detalles/Historial', 'OrdenesController@Historial')->name('Ordenes.historial');
            Route::get('Ordenes/{id}/detallesEliminar/', 'OrdenesCasaCorredoraAutorizador@detallesEliminar')->name('Ordenes.detallesEliminar');
            Route::put('Ordenes/{id}/aceptar', 'OrdenesCasaCorredoraAutorizador@aceptar')->name('Ordenes.aceptar');
            Route::put('Ordenes/{id}/ReAceptar', 'OrdenesCasaCorredoraAutorizador@ReAceptar')->name('Ordenes.ReAceptar');
            Route::post('Ordenes/{id}/rechazar', 'OrdenesCasaCorredoraAutorizador@rechazar')->name('Ordenes.rechazar');
            Route::post('Ordenes/{id}/comentar', 'OrdenesController@Comentar')->name('Ordenes.Comentar');
            Route::put('Ordenes/{id}/actualizar', 'OrdenesController@Actualizar')->name('Ordenes.actualizar');
            Route::get('Ordenes/{id}/Operaciones', 'OrdenesController@Operaciones')->name('Ordenes.operaciones');
            Route::post('Ordenes/{id}/Operaciones/Guardar', 'OrdenesController@OperacionesGuardar')->name('Ordenes.operacionesGuardar');
            Route::get('Ordenes/{id}/editarOrden', 'OrdenesController@Editar')->name('Ordenes.editar');
            Route::get('Order/OrdenesAgente', 'OrdenesCasaCorredoraAutorizador@OrdenesAsignadasAgente')->name('ordenesagenteasignar');
            Route::get('Order/FiltrarOrden', 'OrdenesController@ordenesbyEstado')->name('ordenesbyestadoagent');
            Route::get('Order/ListadoGeneralAgente', 'OrdenesCasaCorredoraAutorizador@ListadoGeneralOrdenesAgente')->name('ordenesagente');
            Route::get('Ordenes/{id}/DetallePDF', 'OrdenesController@DetalleOrdenPDF')->name('OrdenesDetalles.PDF');
            Route::resource('Ordenes', 'OrdenesCasaCorredoraAutorizador');
            Route::get('Perfil', 'UsuarioCasaCorredoraController@perfil')->name('Perfil.UsuarioCasa');
        });
    });
});

//API
Route::group(['middleware' => ['api'], 'prefix' => 'api'], function () {
    Route::post('login', 'LoginAPI@LoginUser');
    Route::group(['middleware' => 'jwt-auth'], function () {
        Route::get('getOrdenes/{id}', 'OrdenesAPI@getOrdenes');
        Route::get('getOrdenesPadre/{id}/{idCliente}', 'OrdenesAPI@getOrdenesPadre');
        Route::post('makeOrder', 'OrdenesAPI@makeOrder');
        Route::put('modifyOrder', 'OrdenesAPI@ModifyOrder');
        Route::put('cancelOrder', 'OrdenesAPI@CancelOrder');
        Route::put('executeOrder', 'OrdenesAPI@ExecuteOrder');
        Route::post('makemessage', 'OrdenesAPI@makeMessage');
        Route::get('getCasasAfiliado/{idCliente}', 'OrdenesAPI@getCasasAfiliado');
        Route::get('getCasasProceso/{idCliente}', 'OrdenesAPI@getCasasAfiliadoProcess');
        Route::get('getCedevales/{idCliente}', 'OrdenesAPI@getCedevales');
        Route::get('getOrdenesByClienteCasa/{idCliente}/{idCasa}', 'OrdenesAPI@getOrdenesByCasa');
    });
});

Route::group(['middleware' => 'UsuarioNoLogueado'], function () {
    Route::get('/activacion/{tokenDeUsuario}/cuenta', 'Registrocontroller@activarCuenta')->name('Token.Activacion');
    Route::post('cambiar/password', 'Registrocontroller@cambiarPassword')->name('Cambiar.password');
});
Route::auth();
Route::get('confirmacionEmail/{tokenDeUsuario}', 'Registrocontroller@aceptarCambio')->name('Token.cambioemail');
Route::get('OlvidePassword', 'Registrocontroller@ForgotPassView')->name('forgotpassword');
Route::post('OlvidePassword/restore', 'Registrocontroller@recuperarPassUpdate')->name('forgotpassword.restore');
Route::get('/NoPermitido', function () {
    return view('errors.NotAllowed');
})->name("nopermitido");