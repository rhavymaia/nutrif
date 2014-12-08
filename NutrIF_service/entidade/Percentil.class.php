<?php

/**
 * IMC por Idade do Percentil
 *
 * @author Rhavy
 */
class Percentil {

    public $codigo;
    
    public $imc;
    
    public $sexo;
    
    public $idadeMeses;
    
    public $valorPercentil;    

    function __construct() {}
    
    function getCodigo() {
        return $this->codigo;
    }

    function getImc() {
        return $this->imc;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getIdadeMeses() {
        return $this->idadeMeses;
    }

    function getValorPercentil() {
        return $this->valorPercentil;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setImc($imc) {
        $this->imc = $imc;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setIdadeMeses($idadeMeses) {
        $this->idadeMeses = $idadeMeses;
    }

    function setValorPercentil($valorPercentil) {
        $this->valorPercentil = $valorPercentil;
    }
}
?>
