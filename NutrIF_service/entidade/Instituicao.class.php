<?php

/**
 * Instituicao
 *
 * @author Rhavy
 */
class Instituicao {
    
    private $codigo;
    
    private $nome;
    
    private $campi;
    
    private $logradouro;
    
    private $cidade;
    
    private $estado;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCampi() {
        return $this->campi;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCampi($campi) {
        $this->campi = $campi;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
?>
