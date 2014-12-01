<?php

/**
 * Percentil
 *
 * @author Rhavy
 */
class Percentil {

    public $cdPercentil;    
    
    public $imc;
    
    public $sexo;
    
    public $idadeMeses;
    
    public $vlPercentil;
    
    public $percentilMediano;
    
    public $percentilInferior;
    
    public $percentilSuperior;
    
    public $anamnese;

    function __construct() {}
    
    public function getPercentilInferior() {
        return $this->percentilInferior;
    }

    public function getPercentilSuperior() {
        return $this->percentilSuperior;
    }

    public function setPercentilInferior($percentilInferior) {
        $this->percentilInferior = $percentilInferior;
    }

    public function setPercentilSuperior($percentilSuperior) {
        $this->percentilSuperior = $percentilSuperior;
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getVlPercentil() {
        return $this->vlPercentil;
    }

    public function getCdPercentil() {
        return $this->cdPercentil;
    }

    public function getImc() {
        return $this->imc;
    }

    public function getIdadeMeses() {
        return $this->idadeMeses;
    }

    public function setVlPercentil($vlPercentil) {
        $this->vlPercentil = $vlPercentil;
    }

    public function setCdPercentil($cdPercentil) {
        $this->cdPercentil = $cdPercentil;
    }

    public function setImc($imc) {
        $this->imc = $imc;
    }

    public function setIdadeMeses($idadeMeses) {
        $this->idadeMeses = $idadeMeses;
    }
    
    public function getAnamnese() {
        return $this->anamnese;
    }

    public function setAnamnese($anamnese) {
        $this->anamnese = $anamnese;
    }

    public function getPercentilMediano() {
        return $this->percentilMediano;
    }

    public function setPercentilMediano($percentilMediano) {
        $this->percentilMediano = $percentilMediano;
    }

}

?>
