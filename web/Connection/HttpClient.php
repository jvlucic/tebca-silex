<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HttpClient
 *
 * @author jorge
 */
require_once __DIR__ . '/../vendor/Guzzle/guzzle.phar';
use Guzzle\Service\Client;

class HttpClient {

    //404 ERROR GENERAL DE APLICACION, INTENTE MAS TARDE
    //400 Error en solicitud de procesamiento
    //402 Usuario no conectado, Identificacion o clave INVALIDA,verificar la configuración de la Organización
    //401 Usuario no conectado, Identificacion o clave INVALIDA
    //500 Usuario no conectado, Identificacion o clave INVALIDA
    //503 Operacion no reconocida/implementada
            
    public static $base_url="http://ws.novopayment.com:443/NovoMovilWS/resources/novomovil";
    public static $headers=array(
            "Content-Type"=>"text/plain",
            "Accept"=>"application/json",
                        );
    const GENERAL_ERROR  =array("error"=>"session_expired", "error_code" =>"400" , "error_message"=> "Error en solicitud de procesamiento");
    const CONNECTION_FAIL=array("error"=>"connexion_fail", "error_code" =>"900" , "error_message"=> "Conexión Fallida");
    const BAD_ORG_PARAM  =array("error"=>"bad_org_param", "error_code" =>"402" , "error_message"=> "Usuario no conectado, Identificacion o clave INVALIDA,verificar la configuración de la Organización");
    const INVALID_LOGIN  =array("error"=>"invalid_login", "error_code" =>"401" , "error_message"=> "Usuario no conectado, Identificacion o clave INVALIDA");
    const INVALID_LOGIN2 =array("error"=>"invalid_login", "error_code" =>"500" , "error_message"=> "Usuario no conectado, Identificacion o clave INVALIDA");
    const BAD_OPER_PARAM =array("error"=>"bad_operation", "error_code" =>"503" , "error_message"=> "Operacion no reconocida/implementada");
    
    public static $errors = array(
        "400" => array("error"=>"session_expired", "error_code" =>"400" , "error_message"=> "Error en solicitud de procesamiento"),
        "900" => array("error"=>"connexion_fail", "error_code" =>"900" , "error_message"=> "Conexión Fallida"),
        "402" => array("error"=>"bad_org_param", "error_code" =>"402" , "error_message"=> "Usuario no conectado, Identificacion o clave INVALIDA,verificar la configuración de la Organización"),
        "401" => array("error"=>"invalid_login", "error_code" =>"401" , "error_message"=> "Usuario no conectado, Identificacion o clave INVALIDA"),
        "500" => array("error"=>"invalid_login", "error_code" =>"500" , "error_message"=> "Usuario no conectado, Identificacion o clave INVALIDA"),
        "503" => array("error"=>"bad_operation", "error_code" =>"503" , "error_message"=> "Operacion no reconocida/implementada")
    );
    

    public static function makeRequest($url, $body) {

        $client = new Client(HttpClient::$base_url.$url);

        try {
            $request = $client->post($url, HttpClient::$headers, $body);
            $response=$request->send();
            $data=json_decode(Security::decrypt($response->getBody()), true);
            if (array_key_exists('errorCode', $data)){
                $keys=array_keys(HttpClient::$errors);
                foreach ($key as $keys) {
                    if($key==$data["errorCode"]){
                        return HttpClient::$errors[$key];                        
                    }
                }
                return HttpClient::$errors["400"]; 
                 
            }
            return $data;
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            return HttpClient::$errors["900"];
        }        
    }
}

?>
