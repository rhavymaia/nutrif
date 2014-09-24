<?php

/**
 * Description of PerfilAlimentar
 *
 * @author Rhavy
 */
class PerfilAlimentar {
    // Guia de bolso do Ministerio da saúde.
    private $aluno;
    
    private $respostas;
    
    private $dataRegistro;
    
    function __construct() {}
    
    public function getAluno() {
        return $this->aluno;
    }

    public function getRespostas() {
        return $this->respostas;
    }

    public function getDataRegistro() {
        return $this->dataRegistro;
    }

    public function setAluno($aluno) {
        $this->aluno = $aluno;
    }

    public function setRespostas($respostas) {
        $this->respostas = $respostas;
    }

    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }
}
?>
