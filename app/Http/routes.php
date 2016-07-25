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


//-----BOLSA DE VALORES ROUTES---//


//------CASAS CRUD------//
Route::get('bolsa/NuevaCasa','BolsaController@NuevaCasa')->name('nuevaCasa');
Route::get('bolsa/EditarCasa/{id}','BolsaController@editarCasa')->name('editarCasa');
Route::get('bolsa/ListadoCasas','BolsaController@ListadoCasas')->name('listadoCasas');
Route::get('bolsa/EliminarCasa/{id}','BolsaController@eliminarCasa')->name('eliminarCasa');
Route::get('bolsa/RestaurarCasa/{id}','BolsaController@RestoreCasa')->name('restaurarcasa');
Route::resource('Bolsa','BolsaController');
Route::post('bolsa/Upload','BolsaController@Upload')->name('upload');

//------USUARIOS BOLSA CRUD------//
Route::get('bolsa/CatalogoUsuarios','UsuariosBolsaController@ListadoUsuario')->name('catalogoUsuarios');
Route::get('bolsa/NuevoUsuario','UsuariosBolsaController@NuevoUsuario')->name('nuevoUsuario');
Route::get('bolsa/ModificarUsuario/{id}','UsuariosBolsaController@ModificarUsuario')->name('modificarusuario');
Route::get('bolsa/MiPerfil','UsuariosBolsaController@MiPerfil')->name('miPerfil');
Route::get('bolsa/EliminarUsuario/{id}','UsuariosBolsaController@EliminarUsuario')->name('eliminarusuario');
Route::get('bolsa/RestaurarUsuario/{id}','UsuariosBolsaController@RestaurarUsuario')->name('restaurarusuario');
Route::resource('UsuarioBolsa','UsuariosBolsaController');

//------BOLSA DE VALORES ROUTES--//


Route::resource('Login','LoginController');


//------CLIENTES ROUTES----//

Route::get('clientes/NuevaOrden','ClientesController@NuevaOrden')->name('nuevaOrden');

//------CLIENTES ROUTES----//

//-----CASA CORREDORA ROUTES----//
Route::resource('UsuarioCasaCorredora','UsuarioCasaCorredoraController');


//-----CASA CORREDORA ROUTES----//
Route::resource('UsuarioCasaCorredora','UsuarioCasaCorredoraController');



