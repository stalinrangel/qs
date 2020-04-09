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

class MenuController extends Controller
{

    public function sp_02_editarPerfil(Request $request)
    {
        /*EXEC dbo.sp_02_editarPerfil
            @IdUsuario = 1
            ,@Idioma = 'ESP'
            ,@eMail = 'ep@mail.com'
            ,@entidad = 'edo. mex'
            ,@ciudad = 'ixtapaluca'*/

        if (/*$request->input('IdUsuario')*/true){
            $usuarios=DB::select(DB::raw("exec sp_02_editarPerfil :IdUsuario, :Idioma,:eMail,:entidad,:ciudad,:entidad,:ciudad,:passw"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':eMail' => $request->input('eMail'),
                    ':entidad' => $request->input('entidad'),
                    ':ciudad' => $request->input('ciudad')
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario', 'status'=>400], 404); 
        }

    }

    public function sp_02_sintomas(Request $request)
    {
        /*EXEC dbo.sp_02_sintomas
            @IdUsuario = 1
            ,@Idioma = 'ESP'
            ,@tos = 1
            ,@dGarganta = 1
            ,@flema = 1
            ,@sAliento = 1
            ,@fiebre = 1
            ,@fatiga = 1
            ,@aMedica1 = 1
            ,@aMedica2 = 1
            ,@aMedica3 = 1
            ,@aMedica4 = 1*/

        if (/*$request->input('IdUsuario')*/true){
            $usuarios=DB::select(DB::raw("exec sp_02_sintomas :IdUsuario, :Idioma,:tos,:dGarganta,:flema,:sAliento,:fiebre,:fatiga,:aMedica1,:aMedica2,:aMedica3,:aMedica4"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':tos' => $request->input('tos'),
                    ':dGarganta' => $request->input('dGarganta'),
                    ':flema' => $request->input('flema'),
                    ':sAliento' => $request->input('sAliento'),
                    ':fiebre' => $request->input('fiebre'),
                    ':fatiga' => $request->input('fatiga'),
                    ':aMedica1' => $request->input('aMedica1'),
                    ':aMedica2' => $request->input('aMedica2'),
                    ':aMedica3' => $request->input('aMedica3'),
                    ':aMedica4' => $request->input('aMedica4'),
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario', 'status'=>400], 404); 
        }

    }

    public function sp_02_detalle(Request $request)
    {
        /*EXEC dbo.sp_02_detalle
        @IdUsuario = 1
        ,@Idioma = 'ESP'
        ,@idContacto = '5'*/

        if (/*$request->input('IdUsuario')*/true){
            $usuarios=DB::select(DB::raw("exec sp_02_detalle :IdUsuario, :Idioma,:idContacto"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':idContacto' => $request->input('idContacto')
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario', 'status'=>400], 404); 
        }

    }


     public function sp_02_agregaContacto(Request $request)
    {
        /*EXEC dbo.sp_02_agregaContacto
            @IdUsuario =1
            ,@Idioma 'esp'
            ,@nombre = 'VALERIA ROMÁN JIMENEZ'
            ,@eMail = 'cp@mail.com'
            ,@telefono = '0987654321'
            ,@dia = 6
            ,@mes = 4
            ,@ayo = 2020*/

        if (/*$request->input('IdUsuario')*/true){
            $usuarios=DB::select(DB::raw("exec sp_02_agregaContacto :IdUsuario, :Idioma,:nombre,:eMail,:telefono,:dia,:mes,:ayo"),[
                    ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':nombre' => $request->input('nombre'),
                    ':eMail' => $request->input('eMail'),
                    ':telefono' => $request->input('telefono'),
                    ':dia' => $request->input('dia'),
                    ':mes' => $request->input('mes'),
                    ':ayo' => $request->input('ayo')
                ]);
            
            self::utf8_encode_deep($usuarios);
            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

        }else{
            return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario', 'status'=>400], 404); 
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
