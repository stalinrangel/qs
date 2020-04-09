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
    
    public function sp_01_ingresarC(Request $request)
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
            

            $usuarios=DB::select(DB::raw("exec sp_01_ingresarC :IdUsuario, :Idioma, :telefono, :passw"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':telefono' => $request->input('telefono'),
                ':passw' => $request->input('password'),
            ]);
            $fecha=[];
            $band=false;
            for ($i=0; $i < count($usuarios); $i++) {
                if (count($fecha)==0) {
                        array_push($fecha,$usuarios[$i]->fecha);
                    }
                for ($j=0; $j < count($fecha); $j++) { 
                    if ($fecha[$j]==$usuarios[$i]->fecha) {
                        $band=true;
                    }
                }
                if ($band==false) {
                    array_push($fecha,$usuarios[$i]->fecha);
                }
                $band=false;

            }
            $fechas=[];
            for ($i=0; $i < count($fecha); $i++) { 
                $aux=array('fecha' => $fecha[$i],
                           'contactos' => []);
                array_push($fechas,$aux);
            }

            $fechas = json_decode(json_encode($fechas), true);
            return response()->json(['fechas'=>$fechas[0]], 200);
            for ($i=0; $i < count($fechas); $i++) { 
               for ($j=0; $j < count($usuarios); $j++) { 
                   if ($fechas[$i]->fecha==$usuarios[$j]->fecha) {
                       if ($usuarios[$j]->idContacto!=null) {
                           array_push($fechas[$i]->contactos,$usuarios[$j]);
                       }
                   }
               }
            }
            return response()->json(['fechas'=>$fechas,'usuarios'=>$usuarios], 200);

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
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':telefono' => $request->input('telefono'),
                ':passw' => $request->input('password'),
            ]);

            

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
