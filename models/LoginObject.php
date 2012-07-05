<?php

namespace models;

class LoginObject {

    public $idOper;
    public $cardId;
    public $passwd;
    public $token;
    public $idClient;
    public $org;

    /**
     * Constructor.
     *
     * 
     */
    public function __construct() {
        
    }

    public function getidOper() {
        return $this->idOper;
    }

    public function setidOper($idOper) {
        $this->idOper = $idOper;
    }

    public function getcardId() {
        return $this->cardId;
    }

    public function setcardId($cardId) {
        $this->cardId = $cardId;
    }

    public function getpasswd() {
        return $this->passwd;
    }

    public function setpasswd($passwd) {
        $this->passwd = $passwd;
    }

    public function gettoken() {
        return $this->token;
    }

    public function settoken($token) {
        $this->token = $token;
    }

    public function getidClient() {
        return $this->idClient;
    }

    public function setidClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getorg() {
        return $this->org;
    }

    public function setorg($org) {
        $this->org = $org;
    }

}