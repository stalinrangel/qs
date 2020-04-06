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

        
   
    //----Pruebas LoginController
    Route::post('/login/web','LoginController@loginWeb');
    Route::post('/login/app','LoginController@loginApp');
    Route::post('/login/repartidores','LoginController@loginRepartidores');
    Route::post('/sc_patronna_login_recuperaPassw','LoginController@sc_patronna_login_recuperaPassw');

    Route::get('/password/cliente/{correo}','PasswordController@generarCodigo');
    Route::get('/password/codigo/{codigo}','PasswordController@validarCodigo');

    Route::post('/sc_patronna_cuenta_consulta','UsuarioController@sc_patronna_cuenta_consulta');
    Route::post('/sc_patronna_cuenta_actualiza','UsuarioController@sc_patronna_cuenta_actualiza');
    
    Route::post('/sc_patronna_login_guardar','UsuarioController@sc_patronna_login_guardar');
    Route::post('/validar_registro','UsuarioController@validar_registro');

    Route::post('/sc_patronna_login_genero','UsuarioController@sc_patronna_login_genero');
    Route::post('/sc_patronna_login_actividades','UsuarioController@sc_patronna_login_actividades');
    Route::post('/sc_patronna_login_recuperaPassw','UsuarioController@sc_patronna_login_recuperaPassw');

    Route::group(['middleware' => 'jwt-auth'], function(){
    
       
        //----Pruebas UsuarioController
        
        Route::post('/st_patronna_elimina_usuarios','UsuarioController@st_patronna_elimina_usuarios');
        
        Route::post('/sc_patronna_cuenta_actualiza_passw','UsuarioController@sc_patronna_cuenta_actualiza_passw');
        
        


        //---- NominaController
        Route::post('/sc_patronna_nominas_inserta_contrato','NominaController@sc_patronna_nominas_inserta_contrato'); 
        Route::post('/sc_patronna_nominas_CP','NominaController@sc_patronna_nominas_CP');
        Route::post('/sc_patronna_nominas_inserta_persona_actividad','NominaController@sc_patronna_nominas_inserta_persona_actividad');
        Route::post('/sc_patronna_nominas_importes','NominaController@sc_patronna_nominas_importes');
        Route::post('/sc_patronna_nominas_consulta','NominaController@sc_patronna_nominas_consulta');  
        Route::post('/sc_patronna_nominas_inserta_bono','NominaController@sc_patronna_nominas_inserta_bono'); 
        Route::post('/sc_patronna_nominas_inserta_descuento','NominaController@sc_patronna_nominas_inserta_descuento');    
        Route::post('/st_prueba','NominaController@st_prueba');
        Route::post('/sc_patronna_nominas_consulta_factura','NominaController@sc_patronna_nominas_consulta_factura');   
        Route::post('/sc_patronna_nominas_elimina_descuento','NominaController@sc_patronna_nominas_elimina_descuento'); 
        Route::post('/sc_patronna_nominas_elimina_bono','NominaController@sc_patronna_nominas_elimina_bono'); 
        Route::post('/sc_patronna_nominas_consulta_terminaContrato','NominaController@sc_patronna_nominas_consulta_terminaContrato');
        Route::post('/sc_patronna_nominas_termina_terminaContrato','NominaController@sc_patronna_nominas_termina_terminaContrato');
        Route::post('/sc_patronna_pagos_consulta','NominaController@sc_patronna_pagos_consulta');
        Route::post('/sc_patronna_pagos_facturaConsulta','NominaController@sc_patronna_pagos_facturaConsulta');


         Route::post('/sc_patronna_ayuda_operadores_activos','SoporteChatController@sc_patronna_ayuda_operadores_activos');
         Route::post('/sc_patronna_ayuda_chat_consulta_inicio','SoporteChatController@sc_patronna_ayuda_chat_consulta_inicio');
         Route::post('/sc_patronna_ayuda_chat_consulta_todo','SoporteChatController@sc_patronna_ayuda_chat_consulta_todo');
         Route::post('/sc_patronna_ayuda_chat_guardar','SoporteChatController@sc_patronna_ayuda_chat_guardar');
    });
});
