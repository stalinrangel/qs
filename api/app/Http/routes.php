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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', function () {
    //return view('welcome');
    return 1;
    
});


/*Route::get('test', function () {
    \Log::info('Info log test');
});*/

Route::group(['middleware' =>'cors'], function(){

    Route::post('/sp_01_guardar','UsuarioController@sp_01_guardar');
    Route::post('/sp_02_editarFoto','UsuarioController@sp_02_editarFoto');
    
    Route::post('/sp_02_consultarPerfil','UsuarioController@sp_02_consultarPerfil');
    Route::post('/sp_02_alerta','UsuarioController@sp_02_alerta');
    Route::post('/sp_01_ingresar','LoginController@sp_01_ingresar');
    Route::post('/sp_01_ingresarC','LoginController@sp_01_ingresarC');
    Route::post('/contactos','ContactoController@contactos');

    Route::post('/sp_01_registros','UsuarioController@sp_01_registros');
    Route::post('/sp_02_paisCuota','UsuarioController@sp_02_paisCuota');

    Route::post('/sp_02_editarPerfil','MenuController@sp_02_editarPerfil');
    Route::post('/sp_02_sintomas','MenuController@sp_02_sintomas');
    Route::post('/sp_02_detalle','MenuController@sp_02_detalle');
    Route::post('/sp_02_agregaContacto','MenuController@sp_02_agregaContacto');

    Route::group(['middleware' => 'jwt-auth'], function(){
    
       
    });
});
