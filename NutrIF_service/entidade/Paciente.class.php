<?php

/**
 * Description of Paciente
 *
 * @author Rhavy
 */
class Paciente {

    public $codigo;
    
    public $matricula;
    
    public $nome;
    
    public $nascimento;
    
    public $nivelEscolar;
    
    public $dataRegistro;

    public function __construct() {}

    function getCodigo() {
        return $this->codigo;
    }

    function getMatricula() {
        return $this->matricula;
    }

    function getNome() {
        return $this->nome;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function getNivelEscolar() {
        return $this->nivelEscolar;
    }

    function getDataRegistro() {
        return $this->dataRegistro;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    function setNivelEscolar($nivelEscolar) {
        $this->nivelEscolar = $nivelEscolar;
    }

    function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }
}
?>
