<?php

/**
 * Description of Imc
 *
 * @author NUTRIF
 */
class Imc {
    
    public $valor;
    
    public $anamnese;
    
    function __construct() {
    }
    
    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
    
    public function getAnamnese() {
        return $this->anamnese;
    }

    public function setAnamnese($anamnese) {
        $this->anamnese = $anamnese;
    }

}
?>
