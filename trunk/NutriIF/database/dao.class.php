<?php

require_once ('database/connect.class.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

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
    
        /**
     * Recuperação informações da avaliação antropométrica para cálcular o 
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
        
        // Selecionar entrevistado através da matrícula.
        $result = $this->db->select($select);
        
        // Recuperar única linha do resultado. Matrícula é chave única.
        $row = $this->db->get_row($result);
        
        return $row;
    }
    
    public function selectPercentil($matricula){
   
        $dao = new dao_class();

        $rowEntrevistado = $dao->selectEntrevistado($matricula);
        // Recuperar única linha do resultado. Matrícula é chave única.
         
        // Verificar se a checagem não gera problemas de tipo.
        if ($rowEntrevistado) {
            // O retorno deve ser um único registro (tupla).
            $peso = $rowEntrevistado['nr_peso'];
            $altura = $rowEntrevistado['nr_altura'];
            $sexo = $rowEntrevistado['tp_sexo'];
            $IdadeMeses = getIdade($rowEntrevistado['dt_nascimento']);
            
            // Calcular IMC com os dados do entrevistado.
            $imc = $peso / pow($altura,2);
            
            // Consultar o Percentil na tabela tb_imc_percentil.            
            $sql = "SELECT imc.cd_percentil, percentil.vl_percentil"
                . " FROM"
                . "tb_imc_percentil AS imc, tb_percentil AS percentil"
                . " WHERE" 
                . " tp_sexo = ". $sexo
                . " AND cd_fator =".fator
                . " AND vl_fator =".$IdadeMeses
                . " AND vl_imc_percentil =".$imc
                . " AND imc.cd_percentil = percentil.cd_percentil";
  
            // Selecionar percentil através dos dados encontrados na consulta ao entrevistado
            $result = $this->db->select($sql);
            // Recuperar única linha do resultado.
            $row = $this->db->get_row($result);
            
            return $row;   
            
        } else {            
            $msg = ("Nenhum resultado encontrado!");        
            $_SESSION['erro'] = $msg;
            header("location: formCalculaPercentilIMCIdade.php"); 
            // Retornar informação que a matrícula não foi encontrada.
            return false;
        }        
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