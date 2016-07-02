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

Route::get('bolsa/NuevaCasa','BolsaController@NuevaCasa')->name('nuevaCasa');
Route::get('bolsa/ListadoCasas','BolsaController@ListadoCasas')->name('listadoCasas');
Route::get('bolsa/CatalogoUsuarios','BolsaController@ListadoUsuario')->name('catalogoUsuarios');
Route::get('bolsa/NuevoUsuario','BolsaController@NuevoUsuario')->name('nuevoUsuario');
Route::get('bolsa/MiPerfil','BolsaController@MiPerfil')->name('miPerfil');
Route::post('bolsa/RegistrarNuevaCasa','BolsaController@RegistrarNuevaCasa')->name('nvoCasa');
//RegistrarNuevaCasa
//------BOLSA DE VALORES ROUTES--//


Route::resource('Login','LoginController');


//------CLIENTES ROUTES----//

Route::get('clientes/NuevaOrden','ClientesController@NuevaOrden')->name('nuevaOrden');

//------CLIENTES ROUTES----//