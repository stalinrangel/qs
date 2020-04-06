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
    

    public function loginWeb(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        $user = null;

        try {

            $user = User::where('email', $request->input('email'))->first();
            if (empty($user)) {
                return response()->json(['error' => 'Email inválido.'], 401);
            }

            //En el panel solo se logean usuarios administradores
            if ($user->tipo_usuario != 1 && $user->tipo_usuario != 4) {
                return response()->json(['error' => 'Credenciales inválidas.'], 401);
            }

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Password inválido.'], 401);
            }

            if ($request->input('token_notificacion') != '' && $request->input('token_notificacion') != null && $request->input('token_notificacion') != 'null') {
                if ($request->input('token_notificacion') != $user->token_notificacion) {
                    $user->token_notificacion = $request->input('token_notificacion');
                    $user->save();
                } 
            }

            $user = JWTAuth::toUser($token);
            

        } catch (JWTException $ex) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //return response()->json(compact('token', 'user'));

        if ($user->tipo_usuario == 4) {
            $user->establecimiento = $user->establecimiento;
        }

        return response()
            ->json([
                'token' => $token,
                'user' => $user
            ]);
    }

    public function loginApp(Request $request)
    {    
        $token = null;
        $user = null;
        $bandera = false;



        if ($request->input('email') && $request->input('password')) {
            

            $usuarios=DB::select(DB::raw("exec sc_patronna_login_ingresar :IdUsuario, :Idioma, :eMail, :passw"),[
	            ':IdUsuario' => 1,
	            ':Idioma' => 'ESP',
	            ':eMail' => $request->input('email'),
	            ':passw' => $request->input('password'),
	        ]);
            //return response()->json(['usuarios'=>$usuarios], 200);

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

    public function loginRepartidores(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        $user = null;

        try {

            $user = User::where('email', $request->input('email'))->first();

            if (empty($user)) {
                return response()->json(['error' => 'Email inválido.'], 401);
            }

            //Login solo para los repartidores
            if ($user->tipo_usuario != 3 || $user->tipo_usuario !=4) {
               // return response()->json(['error' => 'No eres un proveedor.'], 401);
            }

            if (!$token = JWTAuth::attempt($credentials)) {
               // return response()->json(['error' => 'Password inválido.'], 401);
            }

            if ($request->input('token_notificacion')) {
                $user->token_notificacion = $request->input('token_notificacion');
                $user->save();
            }

            if ($request->input('token_notificacion') != '' && $request->input('token_notificacion') != null) {
                if ($request->input('token_notificacion') != $user->token_notificacion) {
                    $user->token_notificacion = $request->input('token_notificacion');
                    $user->save();
                } 
            }

            if ($request->input('token_notificacion') != '' && $request->input('token_notificacion') != null) {
                if ($request->input('token_notificacion') != $user->token_notificacion) {
                    $user->token_notificacion = $request->input('token_notificacion');
                    $user->save();
                } 
            }else if(!$bandera && $request->input('email') && !$request->input('password')){

                $user = User::where('email', $request->input('email'))->first();
                if (empty($user)) {
                    return response()->json(['error' => 'Usuario no encontrado.'], 401);
                }

                //En la app solo se logean usuarios clientes
                if ($user->tipo_usuario == 2) {
                    return response()->json(['error' => 'Credenciales inválidas.'], 401);
                }

                $token = JWTAuth::fromUser($user);
                $bandera=true;
                
                if ($user->id_facebook == null && $request->input('id_facebook') != null && $request->input('id_facebook') != '') {

                    $user->id_facebook = $request->input('id_facebook');
                    $user->save();
                }
                if ($user->id_twitter == null && $request->input('id_twitter') != null && $request->input('id_twitter') != '') {

                    $user->id_twitter = $request->input('id_twitter');
                    $user->save();
                }
                if ($user->id_instagram == null && $request->input('id_instagram') != null && $request->input('id_instagram') != '') {

                    $user->id_instagram = $request->input('id_instagram');
                    $user->save();
                }

            }else if(!$bandera && $request->input('id_facebook')){

                $user = User::where('id_facebook', $request->input('id_facebook'))->first();
                if (empty($user)) {
                    return response()->json(['error' => 'Usuario no encontrado.'], 401);
                }

                //En la app solo se logean usuarios clientes
                if ($user->tipo_usuario != 2) {
                    return response()->json(['error' => 'Credenciales inválidas.'], 401);
                }

                $token = JWTAuth::fromUser($user);
                $bandera=true;

            }else if(!$bandera && $request->input('id_twitter')){

                $user = User::where('id_twitter', $request->input('id_twitter'))->first();
                if (empty($user)) {
                    return response()->json(['error' => 'Usuario no encontrado.'], 401);
                }

                //En la app solo se logean usuarios clientes
                if ($user->tipo_usuario != 2) {
                    return response()->json(['error' => 'Credenciales inválidas.'], 401);
                }

                $token = JWTAuth::fromUser($user);
                $bandera=true;

            }else if(!$bandera && $request->input('id_instagram')){

                $user = User::where('id_instagram', $request->input('id_instagram'))->first();
                if (empty($user)) {
                    return response()->json(['error' => 'Usuario no encontrado.'], 401);
                }

                //En la app solo se logean usuarios clientes
                if ($user->tipo_usuario != 2) {
                    return response()->json(['error' => 'Credenciales inválidas.'], 401);
                }

                $token = JWTAuth::fromUser($user);
                $bandera=true;
            }

            if ($request->input('token_notificacion') != '' && $request->input('token_notificacion') != null) {
                if ($request->input('token_notificacion') != $user->token_notificacion) {
                    $user->token_notificacion = $request->input('token_notificacion');
                    $user->save();
                } 
            }
            
            $user = JWTAuth::toUser($token);
            

        } catch (JWTException $ex) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //return response()->json(compact('token', 'user'));

        $user->repartidor = $user->repartidor;
        $users = \App\User::where('id',$user->id)->with('establecimiento')->get();
         $user->establecimiento=$users[0]->establecimiento;

        $info_registro=Registro::select('direccion','direccion_exacta','email','foto','tipo','usuario_id','id','estado','cedula')->where('usuario_id',$user->id)->first();
        $user->registro=$info_registro;

         $user->promedio_calificacion=5;
        return response()
            ->json([
                'token' => $token,
                'user' => $user,
                //'info_registro' => $info_registro,
            ]);
    }

    

}
