<?php

/**
 * Description of Pesquisa
 *
 * @author Rhavy
 */
class Pesquisa {

    private $codigo;
    
    private $nome;
    
    private $dataInicio;
    
    private $dataFim;
    
    private $instituicao;
    
    private $nutricionista;
    
    private $dataResgistro;
    
    public function __construct() {}
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function getInstituicao() {
        return $this->instituicao;
    }

    public function getNutricionista() {
        return $this->nutricionista;
    }

    public function getDataResgistro() {
        return $this->dataResgistro;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    public function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }

    public function setNutricionista($nutricionista) {
        $this->nutricionista = $nutricionista;
    }

    public function setDataResgistro($dataResgistro) {
        $this->dataResgistro = $dataResgistro;
    }
}
?>
