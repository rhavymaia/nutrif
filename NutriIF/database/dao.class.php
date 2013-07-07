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
        $rowEntrevistado = selectEntrevistado($matricula);
        
        // Verificar se a checagem n�o gera problemas de tipo.
        if ($rowEntrevistado) {
            
            // O retorno deve ser um �nico registro (tupla).
            $peso = $rowEntrevistado['nr_peso'];
            // ... capturar os outros valores.

            // Calcular IMC com os dados do entrevistado.
            // Consultar o Percentil na tabela tb_imc_percentil.
            
        } else {
            // Retornar informa��o que a matr�cula n�o foi encontrada.
            return false;
        }        
    }
    
    /**
     * Recupera��o informa��es da avalia��o antropom�trica para c�lcular o 
     * percentil do IMC.
     * 
     * @param type $matricula
     * @return type
     */
    public function selectEntrevistado($matricula) {
        
        // Montar consulta.
        $select = "SELECT nr_matricula, dt_nascimento, nr_peso, nr_altura, tp_sexo ".
                "FROM tb_entrevistado ".
                "WHERE nr_matricula = ".$matricula;
        
        // Selecionar entrevistado atrav�s da matr�cula.
        $result = $this->db->select($select);
        
        // Recuperar �nica linha do resultado. Matr�cula � chave �nica.
        $row = $this->db->get_row($result);
        
        return $row;
    }

    /**
     * Inserir entrevistados da avalia��o antropom�trica.
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