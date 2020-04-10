<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\DB;
use Hash;
use DB;
use Mail;
use Session;
use Redirect;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{
    public function sp_02_editarFoto(Request $request)
    {
        /*EXEC dbo.sp_02_consultarPerfil
        @IdUsuario = 1
        ,@Idioma = 'ESP'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sp_02_editarFoto :IdUsuario, :Idioma, :rutaFoto"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':rutaFoto' => $request->input('rutaFoto'),
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de actualización de usuario', 'status'=>400], 404); 
        }

    }

    public function sp_02_alerta(Request $request)
    {
        /*EXEC dbo.sp_02_consultarPerfil
        @IdUsuario = 1
        ,@Idioma = 'ESP'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sp_02_alerta :IdUsuario, :Idioma"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP'
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de actualización de usuario', 'status'=>400], 404); 
        }

    }

    public function sp_02_consultarPerfil(Request $request)
    {
        /*EXEC dbo.sp_02_consultarPerfil
        @IdUsuario = 1
        ,@Idioma = 'ESP'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sp_02_consultarPerfil :IdUsuario, :Idioma"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP'
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de actualización de usuario', 'status'=>400], 404); 
        }

    }


    public function sp_01_guardar(Request $request)
    {
        /*EXEC dbo.sp_01_guardar 
        @IdUsuario = 1
        ,@Idioma = 'ESP'
        ,@nombre = 'NORA PATRICIA NOROÑA'
        ,@eMail = 'np@mail.com'
        ,@telefono = '5533873853'
        ,@entidad = 'NUEVO LEÓN'
        ,@ciudad = 'MONTEREY'
        ,@passw = 'T1234'*/

        if (/*$request->input('IdUsuario')*/true){
            $usuarios=DB::select(DB::raw("exec sp_01_guardar :IdUsuario, :Idioma,:nombre,:eMail,:telefono,:entidad,:ciudad,:passw"),[
                    ':IdUsuario' => 1,
                    ':Idioma' => 'ESP',
                    ':nombre' => $request->input('nombre'),
                    ':eMail' => $request->input('eMail'),
                    ':telefono' => $request->input('telefono'),
                    ':entidad' => $request->input('entidad'),
                    ':ciudad' => $request->input('ciudad'),
                    ':passw' => $request->input('passw'),
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario', 'status'=>400], 404); 
        }

    }


    public function sc_patronna_cuenta_actualiza(Request $request)
    {
        /*EXEC dbo.sc_patronna_cuenta_actualiza
        @IdUsuario = 1
        ,@Idioma = 'ESP'
        ,@nombre = 'juaquin'
        ,@apPaterno = 'valadez,
        ,@apMaterno = 'quintero'
        ,@eMail = 'elsquesea@mail.com'
        ,@telefono = '5544992266'
        ,@RFC = 'VAQJ750101E3J'
        ,@domicilio = 'Av. concordia 3, col. la joya, delegacion benito Juarez, CDMX, CP 06677'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sc_patronna_cuenta_actualiza :IdUsuario, :Idioma, :nombre, :apPaterno, :apMaterno, :eMail, :telefono, :RFC, :domicilio"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':nombre' => $request->input('nombre'),
                    ':apPaterno' => $request->input('apPaterno'),
                    ':apMaterno' => $request->input('apMaterno'),
                    ':eMail' => $request->input('eMail'),
                    ':telefono' => $request->input('telefono'),
                    ':RFC' => $request->input('RFC'),
                    ':domicilio' => $request->input('domicilio')
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de actualización de usuario', 'status'=>400], 404); 
        }

    }

    public function sc_patronna_cuenta_actualiza_passw(Request $request)
    {
        /*EXEC dbo.sc_patronna_cuenta_actualiza_passw
        @IdUsuario = 1
        ,@Idioma = 'esp'
        ,@passwAnt = 'T1234'
        ,@passwNuevo = '1234t'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sc_patronna_cuenta_actualiza_passw :IdUsuario, :Idioma, :passwAnt, :passwNuevo"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':passwAnt' => $request->input('passwAnt'),
                    ':passwNuevo' => $request->input('passwNuevo'),
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de actualización de contraseña', 'status'=>400], 404); 
        }

    }

    public function sc_patronna_login_guardar(Request $request)
    {
       /* EXEC dbo.sc_patronna_login_guardar 
         @IdUsuario = 1
        ,@Idioma = 'ESP'
        ,@nombre = 'juaquin'
        ,@apPaterno = 'valadez,
        ,@apMaterno = 'quintero'
        ,@eMail = 'elsquesea@mail.com'
        ,@passw 'T1234'
        ,@telefono = '5544992266'*/

        if ($request->input('nombre') && $request->input('apPaterno')&& $request->input('apMaterno')&& $request->input('eMail')&& $request->input('passw')&& $request->input('telefono')&& $request->input('IdTipoRegistro')) {
                
        		$facebook=0;
        		$google=0;

        		if ($request->input('IdFacebook')) {
        			$facebook=$request->input('IdFacebook');
        		}
        		if($request->input('IdGoogle')) {
        			$google=$request->input('IdGoogle');
        		}

                $usuarios=DB::select(DB::raw("exec sc_patronna_login_guardar :IdUsuario, :Idioma, :nombre, :apPaterno, :apMaterno, :eMail, :passw, :telefono, :IdTipoRegistro, :IdFacebook, :IdGoogle, :token"),[
                    ':IdUsuario' => '1',
                    ':Idioma' => 'ESP',
                    ':nombre' => $request->input('nombre'),
                    ':apPaterno' => $request->input('apPaterno'),
                    ':apMaterno' => $request->input('apMaterno'),
                    ':eMail' => $request->input('eMail'),
                    ':passw' => $request->input('passw'),
                    ':telefono' => $request->input('telefono'),
                    ':IdTipoRegistro' => $request->input('IdTipoRegistro'),
                    ':IdFacebook' => $facebook,
                    ':IdGoogle' => $google,
                    ':token' => '00',
                ]);

               self::utf8_encode_deep($usuarios);
                 
                if($usuarios[0]->computed == "Correo ya registrado"){
                    return response()->json(['error'=>'Correo ya registrado.', 'status'=>400], 404);          
                }else if($usuarios[0]->computed == "OK"){
                    return response()->json(['exito'=>'Registrado con Exito.', 'status'=>200], 200);
                } 
	    }else{

	        return response()->json(['error'=>'Faltan datos para el proceso de registro.', 'status'=>400], 404);       
	    } 
	}

    
    public function validar_registro(Request $request)
    {
        //return 1;
        $eMail=$request->input('eMail');

        $enlace=$this->generateRandomString();
        $data = array( 'enlace' => $enlace);
       

        try {
            //Enviamos el correo con el enlace para validar
            Mail::send('emails.validar_cuenta', $data, function($msj) use ($eMail){
                $msj->subject('Validar cuenta de registro Patronna');
                $msj->from('Patronna@gmail.com', 'Patronna');
                $msj->to($eMail);
            });

            return response()->json(['clave'=>$data, 'status'=>'correo enviado'], 200);
            
        } catch (Exception $e) {
            return response()->json(['error'=>'Rrror no se pudo enviar el mail.', 'status'=>400], 404);    
        }

        

        
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //$characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 
   
     public function st_patronna_elimina_usuarios(Request $request)
    {
        /*EXEC dbo.sc_patronna_cuenta_consulta
        @IdUsuario = 1
        ,@Idioma = 'esp'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec st_patronna_elimina_usuarios :IdUsuario"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                ]);
            self::utf8_encode_deep($usuarios);
             return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

            
        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario.', 'status'=>400], 404); 
        }

    }

     public function sc_patronna_login_recuperaPassw(Request $request)
    {
        /*
        EXEC dbo.sc_patronna_login_recuperaPassw
        @IdUsuario = 1
        ,@Idioma = 'ESP'
        ,@eMail = 'elsquesea@mail.com'*/

        if ($request->input('eMail')){
            $usuarios=DB::select(DB::raw("exec sc_patronna_login_recuperaPassw :IdUsuario, :Idioma, :eMail"),[
                    ':IdUsuario' => '1',
                    ':Idioma' => 'ESP',
                    ':eMail' => $request->input('eMail'),
                ]);
            self::utf8_encode_deep($usuarios);

            if ($usuarios[0]->PASSW==null) {
                return response()->json(['error'=>'Usuario no existe.', 'status'=>400], 404); 
            }else{

                $salt = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

                $rand = '';
                $i = 0;
                $length = 6;

                while ($i < $length) {
                    //Loop hasta que el string aleatorio contenga la longitud ingresada.
                    $num = rand() % strlen($salt);
                    $tmp = substr($salt, $num, 1);
                    $rand = $rand . $tmp;
                    $i++;
                }

                
                $correo=$request->input('eMail');

                if ($request->input('paso')==1) {
                    $data = array( 'codigo_verificacion' => $rand);
                         Mail::send('emails.contact', $data, function($msj) use ($correo){
                        $msj->subject('Código de verificación');
                        $msj->to($correo);
                    });
                }
                if ($request->input('paso')==2) {
                    $data = array( 'pass' => $usuarios[0]->PASSW);
                         Mail::send('emails.contrasena', $data, function($msj) use ($correo){
                        $msj->subject('Constraseña de patronna');
                        $msj->to($correo);
                    });
                }
                
               

                //Informar al cliente despues de enviar el correo con el codigo
                return response()->json(['status'=>'ok', 'message'=>'Código de verificación enviado a '.$correo,'codigo'=>$rand], 200);


                return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);
            }
            
        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario.', 'status'=>400], 404); 
        }

    }

     public function sc_patronna_login_genero(Request $request)
    {
        /*
        EXEC dbo.sc_patronna_login_genero
        @IdUsuario = 1
        ,@Idioma = 'ESP'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sc_patronna_login_genero :IdUsuario, :Idioma"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                ]);
            self::utf8_encode_deep($usuarios);
             return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

            
        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario.', 'status'=>400], 404); 
        }

    }   

     public function sc_patronna_login_actividades(Request $request)
    {
        /*
        @IdUsuario Int
        ,@Idioma Nvarchar(3)

        EXEC dbo.sc_patronna_login_actividades
        @IdUsuario = 1
        ,@Idioma = 'ESP'*/

        if ($request->input('IdUsuario')){
            $usuarios=DB::select(DB::raw("exec sc_patronna_login_actividades :IdUsuario, :Idioma"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                ]);
           // return $usuarios;
            //$data= $this->utf8_encode_deep($usuarios);
            self::utf8_encode_deep($usuarios);
            return response()->json(['actividades'=>$usuarios, 'status'=>200], 200);

            
        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario.', 'status'=>400], 404); 
        }

    }

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
}
