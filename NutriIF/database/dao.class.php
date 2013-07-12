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
    
    public function selectPercentil($matricula){
   
        $dao = new dao_class();

        $rowEntrevistado = $dao->selectEntrevistado($matricula);
        // Recuperar �nica linha do resultado. Matr�cula � chave �nica.
         
        // Verificar se a checagem n�o gera problemas de tipo.
        if ($rowEntrevistado) {
            // O retorno deve ser um �nico registro (tupla).
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
  
            // Selecionar percentil atrav�s dos dados encontrados na consulta ao entrevistado
            $result = $this->db->select($sql);
            // Recuperar �nica linha do resultado.
            $row = $this->db->get_row($result);
            
            return $row;   
            
        } else {            
            $msg = ("Nenhum resultado encontrado!");        
            $_SESSION['erro'] = $msg;
            header("location: formCalculaPercentilIMCIdade.php"); 
            // Retornar informa��o que a matr�cula n�o foi encontrada.
            return false;
        }        
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