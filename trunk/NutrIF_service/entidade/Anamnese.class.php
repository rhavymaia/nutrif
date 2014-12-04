<?php

/**
 * Description of Anamnese
 *
 * @author Rhavy
 */
class Anamnese {
    
    public $codigo;
    
    public $data;
    
    public $entrevistado;
    
    public $nutricionista;
    
    public $pesquisa;
    
    public $peso;
    
    public $altura;
    
    public $nivelEsporte;
    
    public $perfilAlimentar;
    
    public $imc;
    
    public $vct;
    
    public function __construct(){}
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }
    
    public function getData() {
        return $this->data;
    }

    public function getEntrevistado() {
        return $this->entrevistado;
    }

    public function getNutricionista() {
        return $this->nutricionista;
    }

    public function getPesquisa() {
        return $this->pesquisa;
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

    public function setData($data) {
        $this->data = $data;
    }

    public function setEntrevistado($entrevistado) {
        $this->entrevistado = $entrevistado;
    }

    public function setNutricionista($nutricionista) {
        $this->nutricionista = $nutricionista;
    }

    public function setPesquisa($pesquisa) {
        $this->pesquisa = $pesquisa;
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
}
?>
