<?php

/**
 * Description of Anamnese
 *
 * @author Rhavy
 */
class Anamnese {
    
    private $codigo;
    
    private $data;
    
    private $paciente;
    
    private $nutricionista;
    
    private $pesquisa;
    
    private $peso;
    
    private $altura;
    
    private $sexo;
    
    private $nivelEsporte;
    
    private $perfilAlimentar;
    
    public function __construct(){}
    
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }
}

?>
