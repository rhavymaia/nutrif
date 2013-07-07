<?php

require_once ('database/connect.class.php');

class dao_class {

    var $db;    

    /**
     * Construtor da classe.
     */
    function dao_class() {
        $conn = new connect_class;
        $this->db = $conn->database();
    }

    /**
     * Consultar tabela de percentil.
     * 
     * @param type $matricula
     */
    public function selectPercentil($matricula){
        
        // Calcular IMC do entrevistado.
        $entrevistado = selectEntrevistado($matricula);
        
        // Verificar o retorno de somente um registro. Ele deve ser único.
        $peso = $entrevistado['nr_peso'];
        // ... capturar os outros valores.
        
        // Verificar o Percentil.
    }
    
    /**
     * Recuperação informações da avaliação antropométrica para cálcular o 
     * percentil do IMC
     * 
     * @param type $matricula
     * @return type
     */
    public function selectEntrevistado($matricula) {
        
        $select = "SELECT nr_matricula, dt_nascimento, nr_peso, nr_altura, tp_sexo ".
                "FROM tb_entrevistado ".
                "WHERE nr_matricula = ".$matricula;
        
        $result = $this->db->select($select);
        $row = $this->db->get_row($result);
        
        return $row;
    }

    /**
     * Inserir entrevistados da avaliação antropométrica.
     * 
     * @param type $data
     * @return type
     */
    public function inserirEntrevistado($data) {

        $id = $this->db->insert_array('tb_entrevistado', $data);
        return $id;
    }
    
    public function inserirIMCPercentil($data) {

        $id = $this->db->insert_array('tb_imc_percentil', $data);
        return $id;
    }

}

?>