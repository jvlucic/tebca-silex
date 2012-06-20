<?php

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
    public static $key= "A";
    
    public static function encrypt(string $string){
         return base64_encode(mcrypt_encrypt( MCRYPT_DES , Security::$key ,  $string , MCRYPT_MODE_CBC ));

        }
    public static function decrypt(string $string){
         return mcrypt_decrypt( MCRYPT_DES , Security::$key , base64_decode($string) , MCRYPT_MODE_CBC );

        }
        
    
}

?>
