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

class ContactoController extends Controller
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
    
    public function contactos(Request $request)
    {    

        /*
            EXEC dbo.sp_01_ingresar
            @IdUsuario = 1
            ,@Idioma = 'ESP'
            ,@telefono = '5533873853'
            ,@passw = 'T1234'
        */

        if ($request->input('telefono') && $request->input('password')) {

            $usuarios=DB::select(DB::raw("exec sp_01_ingresarC :IdUsuario, :Idioma, :telefono, :passw"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':telefono' => $request->input('telefono'),
                ':passw' => $request->input('password'),
            ]);

            self::utf8_encode_deep($usuarios);
            
            $aux=[];
            for ($j=0; $j < count($usuarios); $j++) { 
               
                   if ($usuarios[$j]->idContacto!=null) {
                       array_push($aux,$usuarios[$j]);
                   }
            }

            return response()->json(['usuario'=>$aux], 200);

            
        }else{
            return response()->json(['error'=>'Faltan datos para el proceso del login.'], 404);   
        }

    }
    
}
