<?php

namespace models;

use models\Movement;

class Card {

    private $nroTarjeta;
    public $saldoDisponible;
    public $tipo;
    public $movimientos;
    public $nombreProducto;
    public $prefix;
    public $mask;
    public $id;
            
    private $numVisibleChars=6;
    /**
     * Constructor.
     *
     * 
     */
    public function __construct($carddata,$id) {
        //["tarjetas"]=> array(2) { 
        //[0]=> array(4){ 
        //["nro_tarjeta"]=> string(16) "6048411519603013" 
        //["tipo"]=> string(1) "P" 
        //["nombre_producto"]=> string(18) "Bonus Alimentacion" 
        //["prefix"]=> string(1) "B" 
        //} 
        //[1]=> array(4) 
        //{ ["nro_tarjeta"]=> string(16) "6048426000275618" ["tipo"]=> string(1) "P" ["nombre_producto"]=> string(14) "Maestro Nomina" ["prefix"]=> string(1) "D" } } 
        $this->nroTarjeta=$carddata['nro_tarjeta'];
        if (array_key_exists('saldo_disponible', $carddata)){
            $this->saldoDisponible=$carddata['saldo_disponible'];        
        }
        if (array_key_exists('movimientos', $carddata)){
            $this->movimientos=$this->buildMovements($carddata['movimientos']);        
        }        
        $this->tipo=$carddata['tipo'];
        $this->nombreProducto=$carddata['nombre_producto'];
        $this->prefix=$carddata['prefix'];
        $this->mask=  $this->buildMask();
        $this->id=$id;
    }
    

    public function buildMovements($movements){
        $result=array();
        foreach ($movements as $movement){
            array_push($result,new Movement($movement));
        }
        return $result;
    }

    public function buildMask() {
        return "******".substr($this->nroTarjeta,strlen($this->nroTarjeta)-$this->numVisibleChars,$this->numVisibleChars);
    }
    
    public function getIdentificacionCliente() {
        return $this->identificacionCliente;
    }
    public function getNroTarjeta() {
        return $this->nroTarjeta;
    }

    public function setNroTarjeta($nroTarjeta) {
        $this->nroTarjeta = $nroTarjeta;
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