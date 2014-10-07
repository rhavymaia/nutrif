<?php

/**
 * Description of Erro
 *
 * @author Rhavy
 */
class Erro {
    
    public $codigo;
    
    public $mensagem;
    
    function __construct() {}
    
     public function toArray() {
        return get_object_vars($this);
    }       
}
