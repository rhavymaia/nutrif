<?php

/**
 * Percentil
 *
 * @author Rhavy
 */
class Percentil {

    public $codigo;
    
    public $imc;
    
    public $usuario;
    
    public $vlPercentil;
    
    public $percentilMediano;
    
    public $percentilInferior;
    
    public $percentilSuperior;    

    function __construct() {}
    
    function getCodigo() {
        return $this->codigo;
    }

    function getImc() {
        return $this->imc;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getVlPercentil() {
        return $this->vlPercentil;
    }

    function getPercentilMediano() {
        return $this->percentilMediano;
    }

    function getPercentilInferior() {
        return $this->percentilInferior;
    }

    function getPercentilSuperior() {
        return $this->percentilSuperior;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setImc($imc) {
        $this->imc = $imc;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setVlPercentil($vlPercentil) {
        $this->vlPercentil = $vlPercentil;
    }

    function setPercentilMediano($percentilMediano) {
        $this->percentilMediano = $percentilMediano;
    }

    function setPercentilInferior($percentilInferior) {
        $this->percentilInferior = $percentilInferior;
    }

    function setPercentilSuperior($percentilSuperior) {
        $this->percentilSuperior = $percentilSuperior;
    }
}
?>
