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
    
    public $sexo;
    
    public $idadeMeses;

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
    
    public function getSexo() {
        return $this->sexo;
    }

    public function getIdadeMeses() {
        return $this->idadeMeses;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setIdadeMeses($idadeMeses) {
        $this->idadeMeses = $idadeMeses;
    }


}
?>
