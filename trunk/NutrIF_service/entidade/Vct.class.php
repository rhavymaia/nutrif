<?php

/**
 * Description of Erro
 *
 * @author Rhavy
 */
class Vct {
    
    public $valor;
    
    public $anamnese;
    
    function __construct() {}
    
    public function getValor() {
        return $this->valor;
    }

    public function getAnamnese() {
        return $this->anamnese;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setAnamnese($anamnese) {
        $this->anamnese = $anamnese;
    }   
}
