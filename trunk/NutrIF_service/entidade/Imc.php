<?php

/**
 * Description of Imc
 *
 * @author NUTRIF
 */
class Imc {
    
    private $anamnese;
    
    function __construct() {
    }

    public function getAnamnese() {
        return $this->anamnese;
    }

    public function setAnamnese($anamnese) {
        $this->anamnese = $anamnese;
    }
}

?>
