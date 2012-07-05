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

class DetailService {

//    {"idOper":"0","cardId":"18190647","passwd":"81dc9bdb52d04dc20036dbd8313ed055", "token":"", "idC
//lient":"",”org”:”719”}

    public static function detail($cardid, $password,$token,$idclient) {

        try {
            $lo = new LoginObject();
            $lo->setcardId($cardid);
            $lo->setidClient($idclient);
            $lo->setidOper("1");
            $lo->setorg("719");
            $lo->setpasswd(Security::MD5decrypt(strtoupper($password)));
            $lo->token=$token;
            $body = Security::encrypt(json_encode($lo));
            $todecode='IePlh2SVRBShw1L4meazlyhrVU2I600AKShcpZMFqhjwTnIgjHP9xQTOUfgw8q0y/9r5scn24JsZZUfZlIHvtX7B31+AM+JvO6mWZ7THiclCKIk1pZtfdfNjuwDoRUiwJbkpx4LvVWpdoyf8i0/nvgcpCZxGW+0HrOP851tWJao=';
            return HttpClient::makeRequest("", $body);
        } catch (Guzzle\Http\Exception\BadResponseException $e) {
            return HttpClient::$errors["900"];
        }
    }

}

?>
