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

    public function setMatricula($matricula) {
        $this->matriculaatricula = $matricula;
    }

    public function getMatricula() {
        return $this->matricula;
    }
    
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNivelEscolar($nivelEscolar) {
        $this->nivelEscolar = $nivelEscolar;
    }

    public function getNivelEscolar() {
        return $this->nivelEscolar;
    }
    
    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function getNascimento() {
        return $this->nascimento;
    }
    
    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }

    public function getDataRegistro() {
        return $this->dataRegistro;
    }
}

?>
