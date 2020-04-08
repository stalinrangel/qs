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

class NominaController extends Controller
{
     
    public function sc_patronna_nominas_inserta_contrato(Request $request)
    {

        //if ($request->input('IdUsuario')){

            $usuarios=DB::select(DB::raw("exec sc_patronna_nominas_inserta_contrato :IdUsuario, :Idioma, :nombre, :apPaterno, :apMaterno, :idGenero, :FNDia, :FNMes, :FNayo, :eMail, :telefono, :CURP, :RFC, :NSS, :domicilio, :idActividadP, :actividadOtro, :calle, :colonia, :idMunicipio, :idEntidad, :CP, :importe, :importeServicio, :impuestos, :total, :lunes, :horaEntradaL, :horaSalidaL, :martes, :horaEntradaM, :horaSalidaM, :miercoles, :horaEntradaMi, :horaSalidaMi, :jueves, :horaEntradaJ, :horaSalidaJ, :viernes, :horaEntradaV, :horaSalidaV, :sabado, :horaEntradaS, :horaSalidaS, :domingo, :horaEntradaD, :horaSalidaD, :idTarjeta"),[
                   ':IdUsuario' => $request->input('IdUsuario'),
                    ':Idioma' => 'ESP',
                    ':nombre' => $request->input('nombre'),
                    ':apPaterno' => $request->input('apPaterno'),
                    ':apMaterno' => $request->input('apMaterno'),
                    ':idGenero' => $request->input('idGenero'),
                    ':FNDia' => $request->input('FNDia'),
                    ':FNMes' => $request->input('FNMes'),
                    ':FNayo' => $request->input('FNayo'),
                    ':eMail' => $request->input('eMail'),
                    ':telefono' => $request->input('telefono'),
                    ':CURP' => $request->input('CURP'),
                    ':RFC' => $request->input('RFC'),
                    ':NSS' => $request->input('NSS'),
                    ':domicilio' => $request->input('domicilio'),
                    ':idActividadP' => $request->input('idActividadP'),
                    ':actividadOtro' => $request->input('actividadOtro'),
                    ':calle' => $request->input('calle'),
                    ':colonia' => $request->input('colonia'),
                    ':idMunicipio' => $request->input('idMunicipio'),
                    ':idEntidad' => $request->input('idEntidad'),
                    ':CP' => $request->input('CP'),
                    ':importe' => $request->input('importe'),
                    ':importeServicio' => $request->input('importeServicio'),
                    ':impuestos' => $request->input('impuestos'),
                    ':total' => $request->input('total'),
                    ':lunes' => $request->input('lunes'),
                    ':horaEntradaL' => $request->input('horaEntradaL'),
                    ':horaSalidaL' => $request->input('horaSalidaL'),
                    ':martes' => $request->input('martes'),
                    ':horaEntradaM' => $request->input('horaEntradaM'),
                    ':horaSalidaM' => $request->input('horaSalidaM'),
                    ':miercoles' => $request->input('miercoles'),
                    ':horaEntradaMi' => $request->input('horaEntradaMi'),
                    ':horaSalidaMi' => $request->input('horaSalidaMi'),
                    ':jueves' => $request->input('jueves'),
                    ':horaEntradaJ' => $request->input('horaEntradaJ'),
                    ':horaSalidaJ' => $request->input('horaSalidaJ'),
                    ':viernes' => $request->input('viernes'),
                    ':horaEntradaV' => $request->input('horaEntradaV'),
                    ':horaSalidaV' => $request->input('horaSalidaV'),
                    ':sabado' => $request->input('sabado'),
                    ':horaEntradaS' => $request->input('horaEntradaS'),
                    ':horaSalidaS' => $request->input('horaSalidaS'),
                    ':domingo' => $request->input('domingo'),
                    ':horaEntradaD' => $request->input('horaEntradaD'),
                    ':horaSalidaD' => $request->input('horaSalidaD'),
                    ':idTarjeta' => $request->input('idTarjeta')
   
                    /*':IdUsuario' => 5687,
                    ':Idioma' => "ESP",
                    ':nombre' => "María José",
                    ':apPaterno' => "Rodríguez",
                    ':apMaterno' => "Pérez",
                    ':idGenero' => 1,
                    ':FNDia' => 23,
                    ':FNMes' => 11,
                    ':FNayo' => 1989,
                    ':eMail' => "fatima@correo.com",
                    ':telefono' => (int)"2391283",
                    ':CURP' => "39ei320e9i2e11",
                    ':RFC' => "3R34R34R34R1",
                    ':NSS' => 121321312,
                    ':domicilio' => "urb la linda",
                    ':idActividadP' => 1,
                    ':actividadOtro' => 'prueba',
                    ':calle' => "urb la linda",
                    ':colonia' => "Geovillas de Santa Bárbara",
                    ':idMunicipio' => 15039,
                    ':idEntidad' => 15,
                    ':CP' => 56535,
                    ':importe' => 6800,
                    ':importeServicio' => 300,
                    ':impuestos' => 985,
                    ':total' => 8085,
                    ':lunes' => 1,
                    ':horaEntradaL' => "09:00",
                    ':horaSalidaL' => "23:00",
                    ':martes' => 0,
                    ':horaEntradaM' => "00:00",
                    ':horaSalidaM' => "00:00",
                    ':miercoles' => 0,
                    ':horaEntradaMi' => "00:00",
                    ':horaSalidaMi' => "00:00",
                    ':jueves' => 0,
                    ':horaEntradaJ' => "00:00",
                    ':horaSalidaJ' => "00:00",
                    ':viernes' => 0,
                    ':horaEntradaV' => "00:00",
                    ':horaSalidaV' => "00:00",
                    ':sabado' => 0,
                    ':horaEntradaS' => "00:00",
                    ':horaSalidaS' => "00:00",
                    ':domingo' => 0,
                    ':horaEntradaD' => "00:00",
                    ':horaSalidaD' => "00:00",
                    ':idTarjeta' => 123,*/
                ]);

            return response()->json(['usuario'=>$usuarios, 'status'=>200], 200);

           
        //}else{
          //  return response()->json(['error'=>'Faltan datos para el proceso de consulta de usuario.', 'status'=>400], 404);
        //}

    }

    public function sc_patronna_nominas_CP(Request $request)
    {    
       
        if ($request->input('IdUsuario') && $request->input('CP')) {
           

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_CP :IdUsuario, :Idioma, :CP"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':CP' => $request->input('CP'),
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);
            //return response()->json($nomina, 200);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de consultar la información', 'status'=>400], 404);  
       }
    }

   
    public function sc_patronna_nominas_consulta(Request $request)
    {    
        if ($request->input('IdUsuario')) {
           
            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_consulta :IdUsuario, :Idioma"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);
            //return response()->json($nomina, 200);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de consultar las nominas', 'status'=>400], 404);  
       }
    }
   
    public function sc_patronna_nominas_importes(Request $request)
    {    

        if ($request->input('IdUsuario')) {
           

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_importes :IdUsuario, :Idioma"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);
            //return response()->json($nomina, 200);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de consultar los importes', 'status'=>400], 404);  
       }
    }
   
    public function sc_patronna_nominas_inserta_persona_actividad(Request $request)
    {    

        if ($request->input('IdUsuario') && $request->input('idPersona') && $request->input('idActividadPersona')) {
           

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_inserta_persona_actividad :IdUsuario, :Idioma, :idPersona, :idActividadPersona, :otro"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idPersona' => $request->input('idPersona'),
                ':idActividadPersona' => $request->input('idActividadPersona'),
                ':otro' => $request->input('otro')
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de insertar al actividad', 'status'=>400], 404);  
       }
    }


    public function sc_patronna_nominas_inserta_bono(Request $request)
    {    

        if ($request->input('IdUsuario') && $request->input('idFactura') && $request->input('importe')) {
           

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_inserta_bono :IdUsuario, :Idioma, :idFactura, :importe, :motivo"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura'),
                ':importe' => $request->input('importe'),
                ':motivo' => $request->input('motivo'),
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);
            //return response()->json($nomina, 200);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de insertar el bono', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_nominas_inserta_descuento(Request $request)
    {    
        if ($request->input('IdUsuario') && $request->input('idFactura') && $request->input('importe')) {
           

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_inserta_descuento :IdUsuario, :Idioma, :idFactura, :importe, :motivo"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura'),
                ':importe' => $request->input('importe'),
                ':motivo' => $request->input('motivo'),
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);
            //return response()->json($nomina, 200);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de insertar el descuento', 'status'=>400], 404);  
       }
    }


    public function st_prueba(Request $request)
    {    
        /*
        EXEC dbo.st_prueba
        @prueba nvarchar(50)
        */
        if ($request->input('prueba')) {
            //$prueba='holá';
            //$prueba= self::encodeToUtf8($request->input('prueba'));
            $nomina=DB::select(DB::raw("exec st_prueba :prueba,:pruebaPersona"),[
                ':prueba' => $request->input('prueba'),
                ':pruebaPersona'  => $request->input('prueba')
            ]);
            //$nomina=json_decode($nomina);
            self::utf8_encode_deep($nomina);

            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de ejecutar la nomina.', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_nominas_consulta_factura(Request $request)
    {    

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_consulta_factura :IdUsuario, :Idioma, :idFactura"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura')
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de ejecutar la consulta de la factura.', 'status'=>400], 404);  
        }
    }

    public function sc_patronna_nominas_elimina_descuento(Request $request)
    {    

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_elimina_descuento :IdUsuario, :Idioma, :idFactura"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura')
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de eliminar el bono', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_nominas_elimina_bono(Request $request)
    {    

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_elimina_bono :IdUsuario, :Idioma, :idFactura"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura')
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de eliminar el descuento', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_nominas_consulta_terminaContrato(Request $request)
    {    

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_consulta_terminaContrato :IdUsuario, :Idioma, :idFactura"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura')
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de eliminar el descuento', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_nominas_termina_terminaContrato(Request $request)
    {    

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_nominas_termina_terminaContrato :IdUsuario, :Idioma, :idFactura, :importe, :impuestos, :importeServicio, :total, :token"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura'), 
                ':importe' => $request->input('importe'),  
                ':impuestos' => $request->input('impuestos'), 
                ':importeServicio' => $request->input('importeServicio'), 
                ':total' => $request->input('total'), 
                ':token' => $request->input('token'), 
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de registrar el pago', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_pagos_consulta(Request $request)
    {    
        /*EXEC dbo.sc_patronna_pagos_consulta
        @IdUsuario = 1
        ,@Idioma = 'esp'
        ,@meses = 1*/

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_pagos_consulta :IdUsuario, :Idioma, :meses"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':meses' => $request->input('meses')
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        }else{
            return response()->json(['error'=>'Error al momento de consultar los pagos', 'status'=>400], 404);  
       }
    }

    public function sc_patronna_pagos_facturaConsulta(Request $request)
    {    
        /*EXEC dbo.sc_patronna_pagos_facturaConsulta
        @IdUsuario = 1
        ,@Idioma = 'esp'
        ,@idFactura = 1*/

        if ($request->input('IdUsuario')) {

            $nomina=DB::select(DB::raw("exec sc_patronna_pagos_facturaConsulta :IdUsuario, :Idioma, :idFactura"),[
                ':IdUsuario' => $request->input('IdUsuario'),
                ':Idioma' => 'ESP',
                ':idFactura' => $request->input('idFactura')
            ]);

            self::utf8_encode_deep($nomina);
            return response()->json(['nomina'=>$nomina], 200);
             
        } else{
            return response()->json(['error'=>'Error al momento de ejecutar la consulta de la factura.', 'status'=>400], 404);  
        }
    }

    public function encodeToUtf8($string) {
     return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
    }


    public function utf8_encode_deep(&$input) {
        if (is_string($input)) {
            $input = iconv( "ISO-8859-1", "UTF-8", $input);
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