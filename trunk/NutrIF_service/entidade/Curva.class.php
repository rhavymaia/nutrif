<?php
/**
 * Description of Curva
 *
 * @author Rhavy
 */
class Curva {
    
    public $entrevistado;
    
    public $imc;

    public $percentilMediano;
    
    public $percentilInferior;
    
    public $percentilSuperior;
    
    public $diagnostico;    

    function __construct() {}

    function getEntrevistado() {
        return $this->entrevistado;
    }

    function getImc() {
        return $this->imc;
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

    function setEntrevistado($entrevistado) {
        $this->entrevistado = $entrevistado;
    }

    function setImc($imc) {
        $this->imc = $imc;
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
    
    public function getDiagnostico() {
        return $this->diagnostico;
    }

    public function setDiagnostico($diagnostico) {
        $this->diagnostico = $diagnostico;
    }


}
