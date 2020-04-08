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

class LoginController extends Controller
{

    /*Funcion para verificar la valides de un token que se pasa en el request*/
    public function validarToken(Request $request)
    {

        try {
            $user = JWTAuth::toUser($request->input('token'));
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return 0;
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return 0;
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException){
                return 0;
            }else{
                return 0;
            }
        }

        return 1;
    }
    

    
    public function sp_01_ingresar(Request $request)
    {    

        /*
            EXEC dbo.sp_01_ingresar
            @IdUsuario = 1
            ,@Idioma = 'ESP'
            ,@telefono = '5533873853'
            ,@passw = 'T1234'
        */

        $token = null;
        $user = null;
        $bandera = false;

        if ($request->input('telefono') && $request->input('password')) {
            

            $usuarios=DB::select(DB::raw("exec sp_01_ingresar :IdUsuario, :Idioma, :telefono, :passw"),[
	            ':IdUsuario' => 1,
	            ':Idioma' => 'ESP',
	            ':telefono' => $request->input('telefono'),
	            ':passw' => $request->input('password'),
	        ]);
            return response()->json(['usuarios'=>$usuarios], 200);

	        if($usuarios[0]->idUsuario == 'Correo inexistente'){
	            return response()->json(['error'=>'No existe el usuario.'], 404);          
	        }else if($usuarios[0]->idUsuario == 'Password erroneo'){
                return response()->json(['error'=>'Contraseña incorrecta.'], 404);          
            }else{
                $user = User::where('eMail', $request->input('email'))->first();
                $token = JWTAuth::fromUser($user);
	            return response()->json(['usuarios'=>$usuarios[0]->idUsuario,'token'=>$token], 200);
	        } 
        }else{
            return response()->json(['error'=>'Faltan datos para el proceso del login.'], 404);   
        }

    }
    

}
