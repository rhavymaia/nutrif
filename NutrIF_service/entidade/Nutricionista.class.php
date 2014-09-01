<?php

require_once ('Usuario.class.php');

/**
 * Description of Nutricionista
 *
 * @author Rhavy
 */
class Nutricionista extends Usuario{
        
    private $crn;
    
    private $siape;
    
    private $instituicao;
    
    public function __construct(){}
    
    public function getCrn() {
        return $this->crn;
    }

    public function getSiape() {
        return $this->siape;
    }

    public function getInstituicao() {
        return $this->instituicao;
    }

    public function setCrn($crn) {
        $this->crn = $crn;
    }

    public function setSiape($siape) {
        $this->siape = $siape;
    }

    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }       
}
?>
