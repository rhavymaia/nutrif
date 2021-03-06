<?php

require_once ('Usuario.class.php');

/**
 * Description of Nutricionista
 *
 * @author Rhavy
 */
class Nutricionista extends Usuario{
        
    public $nome;
    
    public $instituicao;
    
    public function __construct(){}
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public function setNome($nome) { 
         $this->nome = $nome; 
    }
    
    public function getNome() { 
        return $this->nome; 
    }
    
    public function setInstituicao($instituicao) { 
         $this->instituicao = $instituicao; 
    }
    
    public function getInstituicao() { 
        return $this->instituicao; 
    }        
}

?>
