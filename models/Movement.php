<?php

namespace models;

class Movement {

    public $fecha;
    public $concepto;
    public $monto;
    public $tipo;
    public $referencia;
    public $codigo;


    /**
     * Constructor.
     *
     * 
     */
    public function __construct($movementdata) {
	//{"fecha":"20/06/2011",
        //"concepto":"Abono",
        //"monto":"135",
        //"tipo":"ABONO",
        //"referencia":"17100415516",
        //"codigo":"20"}
        $this->fecha=$movementdata['fecha'];
        $this->concepto=$movementdata['concepto'];
        $this->monto=$movementdata['monto'];
        $this->tipo=$movementdata['tipo'];
        $this->referencia=$movementdata['referencia'];
        $this->codigo=$movementdata['codigo'];
        
    }
    
    
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getConcepto() {
        return $this->concepto;
    }

    public function setConcepto($concepto) {
        $this->concepto = $concepto;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }





}