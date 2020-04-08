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
    Route::post('/sp_01_ingresar','LoginController@sp_01_ingresar');

    Route::group(['middleware' => 'jwt-auth'], function(){
    
       
    });
});
