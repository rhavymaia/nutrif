<?php

/**
 * Percentil
 *
 * @author Rhavy
 */
class Percentil {

    private $vlPercentil;
    private $cdPercentil;
    private $sexo;
    private $imc;
    private $idadeMeses;
   
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

    
    public function toArray() {
        return get_object_vars($this);
    }
}

?>