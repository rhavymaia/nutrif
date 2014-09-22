<?php

require_once ('Usuario.class.php');

/**
 * Description of Nutricionista
 *
 * @author Rhavy
 */
class Nutricionista extends Usuario{
        
    private $nome;
    
    private $instituicao;
    
    public function __construct(){}
    
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
