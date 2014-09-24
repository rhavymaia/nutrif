<?php

require_once ('Usuario.class.php');

/**
 * Entrevistado
 *
 * @author Rhavy
 */
class Entrevistado extends Usuario{
    
    private $codigo;

    private $matricula;
    
    private $nivelEscolar;
    
    private $dataRegistro;
    
    public function __construct() {}
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getMatricula() {
        return $this->matricula;
    }

    public function getNivelEscolar() {
        return $this->nivelEscolar;
    }

    public function getDataRegistro() {
        return $this->dataRegistro;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setNivelEscolar($nivelEscolar) {
        $this->nivelEscolar = $nivelEscolar;
    }

    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }    
}
