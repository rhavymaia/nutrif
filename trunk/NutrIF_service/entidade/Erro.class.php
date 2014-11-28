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
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function toArray() {
        return get_object_vars($this);
    }    
}
