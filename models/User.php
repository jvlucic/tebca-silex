<?php

namespace models;
use models\Card;

class User {

    public $identificacionCliente;
    public $nombreCliente;
    public $tarjetas;
    public $token;
    public $idClient;
    public $org;

    public $principales;
    public $suplementarias;

    protected $hasPrincipales;
    protected $hasSuplementarias;

    /**
     * Constructor.
     *
     * 
     */
    public function __construct($userdata) {
        //{ ["identificacion_cliente"]=> string(8) "18828993" 
        //["nombre_cliente"]=> string(11) "LUCIC JORGE" 
        //["tarjetas"]=> array(2) { [0]=> array(4) { ["nro_tarjeta"]=> string(16) "6048411519603013" ["tipo"]=> string(1) "P" ["nombre_producto"]=> string(18) "Bonus Alimentacion" ["prefix"]=> string(1) "B" } [1]=> array(4) { ["nro_tarjeta"]=> string(16) "6048426000275618" ["tipo"]=> string(1) "P" ["nombre_producto"]=> string(14) "Maestro Nomina" ["prefix"]=> string(1) "D" } } 
        //["token"]=> string(32) "6f2ad34baac382cab2f5225f4eabd49a" ["org"]=> string(3) "719" } 
        $this->identificacionCliente=$userdata['identificacion_cliente'];
        $this->nombreCliente=$userdata['nombre_cliente'];
        $this->tarjetas= $this->buildCards($userdata['tarjetas']);
        $this->token=$userdata['token'];
        $this->idClient=$userdata['identificacion_cliente'];
        $this->org=$userdata['org'];
        
    }
    
    public function buildCards($cards){
        $result=array();
        $this->principales=array();
        $this->suplementarias=array();
        
        $i=0;
        foreach ($cards as $card){
            if ($card['tipo']=='P'){
                $this->hasPrincipales=true;
                array_push($this->principales,new Card($card,$i++));
            }else if ($card['tipo']=='S'){
                $this->hasSuplementarias=true;
                array_push($this->suplementarias,new Card($card,$i++));
            }
                
            array_push($result,new Card($card,$i));
        }
        return $result;
    }
    
    public function getIdentificacionCliente() {
        return $this->identificacionCliente;
    }

    public function setIdentificacionCliente($identificacionCliente) {
        $this->identificacionCliente = $identificacionCliente;
    }

    public function getNombreCliente() {
        return $this->nombreCliente;
    }

    public function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
    }

    public function getTarjetas() {
        return $this->tarjetas;
    }

    public function setTarjetas($tarjetas) {
        $this->tarjetas = $tarjetas;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getOrg() {
        return $this->org;
    }

    public function setOrg($org) {
        $this->org = $org;
    }

    public function getPrincipales() {
        return $this->principales;
    }

    public function setPrincipales($principales) {
        $this->principales = $principales;
    }

    public function getSuplementarias() {
        return $this->suplementarias;
    }

    public function setSuplementarias($suplementarias) {
        $this->suplementarias = $suplementarias;
    }

    public function getHasPrincipales() {
        return $this->hasPrincipales;
    }

    public function setHasPrincipales($hasPrincipales) {
        $this->hasPrincipales = $hasPrincipales;
    }

    public function getHasSuplementarias() {
        return $this->hasSuplementarias;
    }

    public function setHasSuplementarias($hasSuplementarias) {
        $this->hasSuplementarias = $hasSuplementarias;
    }




}