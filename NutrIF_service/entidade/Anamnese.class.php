<?php

/**
 * Anamnese
 *
 * @author Rhavy
 */
class Anamnese {
    
    private $codigo;
    
    private $nutricionista;
    
    private $entrevistado;
    
    private $pesquisa;
    
    private $dtAnamnese;
    
    private $peso;
    
    private $altura;
    
    private $nivelEsporte;
    
    private $perfilAlimentar;
    
    public function __construct(){}
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNutricionista() {
        return $this->nutricionista;
    }

    public function getEntrevistado() {
        return $this->entrevistado;
    }

    public function getPesquisa() {
        return $this->pesquisa;
    }

    public function getDtAnamnese() {
        return $this->dtAnamnese;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getNivelEsporte() {
        return $this->nivelEsporte;
    }

    public function getPerfilAlimentar() {
        return $this->perfilAlimentar;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNutricionista($nutricionista) {
        $this->nutricionista = $nutricionista;
    }

    public function setEntrevistado($entrevistado) {
        $this->entrevistado = $entrevistado;
    }

    public function setPesquisa($pesquisa) {
        $this->pesquisa = $pesquisa;
    }

    public function setDtAnamnese($dtAnamnese) {
        $this->dtAnamnese = $dtAnamnese;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setNivelEsporte($nivelEsporte) {
        $this->nivelEsporte = $nivelEsporte;
    }

    public function setPerfilAlimentar($perfilAlimentar) {
        $this->perfilAlimentar = $perfilAlimentar;
    }
    
      public function toArray() {
        return get_object_vars($this);
    }
}
?>
