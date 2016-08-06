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
    return view('welcome');
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
    //-----BOLSA DE VALORES ROUTES---//


//------CASAS CRUD------//
    Route::get('bolsa/NuevaCasa','BolsaController@NuevaCasa')->name('nuevaCasa');
    Route::get('bolsa/EditarCasa/{id}', 'BolsaController@editarCasa')->name('editarCasa');
    Route::get('bolsa/ListadoCasas','BolsaController@ListadoCasas')->name('listadoCasas');
    Route::get('bolsa/EliminarCasa/{id}', 'BolsaController@eliminarCasa')->name('eliminarCasa');
    Route::get('bolsa/RestaurarCasa/{id}', 'BolsaController@RestoreCasa')->name('restaurarcasa');
    Route::resource('Bolsa', 'BolsaController');
    Route::post('bolsa/Upload', 'BolsaController@Upload')->name('upload');

//------USUARIOS BOLSA CRUD------//
    Route::get('bolsa/CatalogoUsuarios', 'UsuariosBolsaController@ListadoUsuario')->name('catalogoUsuarios');
    Route::get('bolsa/NuevoUsuario', 'UsuariosBolsaController@NuevoUsuario')->name('nuevoUsuario');
    Route::get('bolsa/ModificarUsuario/{id}', 'UsuariosBolsaController@ModificarUsuario')->name('modificarusuario');
    Route::get('bolsa/MiPerfil', 'UsuariosBolsaController@MiPerfil')->name('miPerfil');
    Route::get('bolsa/EliminarUsuario/{id}', 'UsuariosBolsaController@EliminarUsuario')->name('eliminarusuario');
    Route::get('bolsa/RestaurarUsuario/{id}', 'UsuariosBolsaController@RestaurarUsuario')->name('restaurarusuario');
    Route::get('bolsa/RestaurarPassword/{id}', 'UsuariosBolsaController@resetPassword')->name('restaurarpassword');
    
    Route::resource('UsuarioBolsa', 'UsuariosBolsaController');

//------BOLSA DE VALORES ROUTES--//

//------CLIENTES ROUTES--//

    Route::get('clientes/NuevaOrden','ClientesController@NuevaOrden')->name('nuevaOrden');
    Route::get('Cliente/ListadoOrdenesV', 'ClientesController@ListadoOrdenesVigentes')->name('listadoordenesclienteV');
    Route::resource('Clientes', 'ClientesController');
    //------CLIENTES ROUTES--//





});


Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'administradorCasaCorredora'], function () {
        Route::get('UsuarioCasaCorredora/crear', 'UsuarioCasaCorredoraController@crear')->name('UsuarioCasaCorredora.crear');
        Route::get('UsuarioCasaCorredora/{id}/editar', 'UsuarioCasaCorredoraController@editar')->name('UsuarioCasaCorredora.editar');
        Route::get('UsuarioCasaCorredora/{id}/restaurar', 'UsuarioCasaCorredoraController@restaurar')->name('UsuarioCasaCorredora.restaurar');
        Route::get('UsuarioCasaCorredora/{id}/resetear', 'UsuarioCasaCorredoraController@resetar')->name('UsuarioCasaCorredora.resetearpassword');
        Route::resource('UsuarioCasaCorredora', 'UsuarioCasaCorredoraController');
    });
    Route::group(['middleware' => 'OperadorCasaCorredora'], function () {

    });

    Route::get('SolicitudAfiliacion/{id}/detalle', 'SolicitudesCasaCorredora@detalle')->name('SolicitudAfiliacion.detalle');
    Route::get('SolicitudAfiliacion/{id}/aceptar', 'SolicitudesCasaCorredora@aceptar')->name('SolicitudAfiliacion.aceptar');
    Route::get('SolicitudAfiliacion/procesando', 'SolicitudesCasaCorredora@Procesando');
    Route::get('SolicitudAfiliacion/procesadas', 'SolicitudesCasaCorredora@Procesadas');
    Route::get('SolicitudAfiliacion/{id}/procesar', 'SolicitudesCasaCorredora@Procesar')->name('SolicitudAfiliacion.procesar');
    Route::get('Afiliados', 'SolicitudesCasaCorredora@afiliados');
    Route::get('Afiliados/{id}/eliminar', 'SolicitudesCasaCorredora@eliminar')->name('Afiliado.eliminar');

    Route::resource('SolicitudAfiliacion', 'SolicitudesCasaCorredora');




    Route::get('Ordenes/{id}/asignar', 'OrdenesCasaCorredoraAutorizador@asignar')->name('Ordenes.asignar');
    Route::get('Ordenes/{id}/detalles', 'OrdenesCasaCorredoraAutorizador@detalles')->name('Ordenes.detalles');
    Route::put('Ordenes/{id}/aceptar', 'OrdenesCasaCorredoraAutorizador@aceptar')->name('Ordenes.aceptar');
    Route::get('Ordenes/{id}/rechazar', 'OrdenesCasaCorredoraAutorizador@rechazar')->name('Ordenes.rechazar');
    Route::resource('Ordenes', 'OrdenesCasaCorredoraAutorizador');

});

Route::auth();
Route::get('admin', 'HomeController@index');
Route::get('/home', 'HomeController@index');