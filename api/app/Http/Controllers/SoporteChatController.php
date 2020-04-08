<?php

namespace App\Http\Controllers;

use Hash;
use DB;
use App\Http\Requests;
use App\User;
use App\Usuario;
use App\Registro;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class SoporteChatController extends Controller
{

    public function utf8_encode_deep(&$input) {
            if (is_string($input)) {
                $input = iconv("ISO-8859-1", "UTF-8", $input);;
            } else if (is_array($input)) {
                foreach ($input as &$value) {
                    self::utf8_encode_deep($value);
                }

                unset($value);
            } else if (is_object($input)) {
                $vars = array_keys(get_object_vars($input));

                foreach ($vars as $var) {
                    self::utf8_encode_deep($input->$var);
                }
            }
        }

    public function sc_patronna_ayuda_operadores_activos(Request $request)
    {       
        //if ($request->input('email') && $request->input('password')) {
            

            $usuarios=DB::select(DB::raw("exec sc_patronna_ayuda_operadores_activos :IdUsuario, :Idioma "),[
	            ':IdUsuario' => $request->input('IdUsuario'),
	            ':Idioma' => 'ESP'
	        ]);
            return response()->json(['patronna_ayuda_operadores_activos'=>$usuarios], 200); 
       // }else{
         //   return response()->json(['error'=>'Faltan datos para el proceso del login.'], 404);   
        //}
    }
    public function sc_patronna_ayuda_chat_consulta_inicio(Request $request)
    {       
        //if ($request->input('email') && $request->input('password')) {
            

            $usuarios=DB::select(DB::raw("exec sc_patronna_ayuda_chat_consulta_inicio :IdUsuario, :Idioma "),[
	            ':IdUsuario' => $request->input('IdUsuario'),
	            ':Idioma' => 'ESP'
	        ]);
            self::utf8_encode_deep($usuarios); 
            return response()->json(['patronna_ayuda_chat_consulta_inicio'=>$usuarios], 200); 
       // }else{
         //   return response()->json(['error'=>'Faltan datos para el proceso del login.'], 404);   
        //}
    }
    public function sc_patronna_ayuda_chat_consulta_todo(Request $request)
    {       
        //if ($request->input('email') && $request->input('password')) {
            

            $usuarios=DB::select(DB::raw("exec sc_patronna_ayuda_chat_consulta_todo :IdUsuario, :Idioma "),[
	            ':IdUsuario' => $request->input('IdUsuario'),
	            ':Idioma' => 'ESP'
	        ]);
            self::utf8_encode_deep($usuarios);
            return response()->json(['sc_patronna_ayuda_chat_consulta_todo'=>$usuarios], 200); 
       // }else{
         //   return response()->json(['error'=>'Faltan datos para el proceso del login.'], 404);   
        //}
    }
    public function sc_patronna_ayuda_chat_guardar(Request $request)
    {       
        //if ($request->input('email') && $request->input('password')) {
            

            $usuarios=DB::select(DB::raw("exec sc_patronna_ayuda_chat_guardar :IdUsuario, :Idioma, :idEmisor, :idReceptor, :mensaje, :tokenNotificacionReceptor, :tokenNotificacionEmisor"),[
	            ':IdUsuario' => $request->input('IdUsuario'),
	            ':Idioma' => 'ESP',
	            ':idEmisor' => $request->input('idEmisor'),
				':idReceptor' => $request->input('idReceptor'),
				':mensaje' => $request->input('mensaje'),
				':tokenNotificacionReceptor' => $request->input('tokenNotificacionReceptor'),
				':tokenNotificacionEmisor' => $request->input('tokenNotificacionEmisor')
	        ]);
            return response()->json(['sc_patronna_ayuda_chat_guardar'=>$usuarios], 200); 
       // }else{
         //   return response()->json(['error'=>'Faltan datos para el proceso del login.'], 404);   
        //}
    }
    
    

}
