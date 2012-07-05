<?php

namespace connection;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HttpClient
 *
 * @author jorge
 */
use Guzzle\Service\Client;
use \models\LoginObject;
use security\Security;

class LoginService {

    public static function login($username, $password) {

        try {
            $lo = new LoginObject();
            $lo->setcardId($username);
            $lo->setidClient($username);
            $lo->setidOper("0");
            $lo->setorg("719");
            $lo->setpasswd(Security::MD5decrypt(strtoupper($password)));
            $body = Security::encrypt(json_encode($lo));
            $todecode='IePlh2SVRBShw1L4meazlyhrVU2I600AKShcpZMFqhjwTnIgjHP9xQTOUfgw8q0y/9r5scn24JsZZUfZlIHvtX7B31+AM+JvO6mWZ7THiclCKIk1pZtfdfNjuwDoRUiwJbkpx4LvVWpdoyf8i0/nvgcpCZxGW+0HrOP851tWJao=';
            return HttpClient::makeRequest("", $body);
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            return HttpClient::$errors["900"];
        }
    }

}

?>
