<?php

namespace security;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Security
 *
 * @author jorge
 */
class Security {
    //put your code here
    public static $key="bjBWMG1PdjFMMjAxMg==";
    
    public static function encrypt( $string){
         $decodedKey=base64_decode("bjBWMG1PdjFMMjAxMg==");
         return base64_encode(mcrypt_encrypt( MCRYPT_DES , $decodedKey ,  $string , MCRYPT_MODE_CBC ,'\0\0\0\0\0\0\0\0'));

        }
    public static function decrypt( $string){
        $decodedKey=base64_decode("bjBWMG1PdjFMMjAxMg==");
        return mcrypt_decrypt( MCRYPT_DES , $decodedKey , base64_decode($string) , MCRYPT_MODE_CBC ,'\0\0\0\0\0\0\0\0');

        }
    public static function MD5decrypt($string){
         return md5($string);
        }        
    
}

?>
