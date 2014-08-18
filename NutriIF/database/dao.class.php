<?php

require_once ('connect.class.php');
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
     public function selectEntrevistado($matricula) {
        
        // Montar consulta.
        $select = "SELECT cd_entrevistado, nr_matricula, dt_nascimento "
                ."FROM tb_entrevistado "
                ."WHERE nr_matricula = ".$matricula;
        
        // Selecionar entrevistado através da matrícula.
        $result = $this->db->select($select);
        
        // Recuperar única linha do resultado. Matrícula é chave única.
        $row = $this->db->get_row($result);
        
        return $row;
    }
    
         public function selectDadosAntropometricos($matricula) {
        
        // Montar consulta.
        $select = "SELECT a.nr_peso, a.nr_altura, e.tp_sexo, e.dt_nascimento, a.nr_nivel_esporte ".
                "FROM tb_anamnese AS a, tb_entrevistado AS e ".
                "WHERE e.cd_entrevistado = a.cd_entrevistado AND e.nr_matricula = ".$matricula;
        
        // Selecionar entrevistado através da matrícula.
        $result = $this->db->select($select);
        
        // Recuperar única linha do resultado. Matrícula é chave única.
        $row = $this->db->get_row($result);
        
        return $row;
    }
    
    public function selectEntrevistados(){
        
        $select = "SELECT e.cd_entrevistado, e.nr_matricula, e.dt_nascimento "
                . "a.nr_peso, a.nr_altura, e.tp_sexo "
                ."FROM tb_entrevistado AS e, tb_anamnese AS a";
                //" WHERE ysnData BETWEEN '.$dataInicial.' and '.$dataFinal;
        
        // Selecionar entrevistado através da matrícula.
        $result = $this->db->select($select);
        
        $rows = $this->db->get_rows($result);
               
        return $rows;
    }

        /**
     * Recuperação informações da avaliação antropométrica para cálcular o 
     * percentil do IMC.
     * 
     * @param type $matricula
     * @return type
     */
     public function selectPercentil($imc, $sexo, $idadeMeses){
            
        // Consultar o Percentil na tabela tb_imc_percentil.            
        $sql = "SELECT imc.cd_percentil, percentil.vl_percentil"
            . " FROM"
            . " tb_imc_percentil AS imc, tb_percentil AS percentil"
            . " WHERE" 
            . " imc.tp_sexo = '". $sexo ."'"
            . " AND imc.cd_fator = ".FATOR
            . " AND imc.vl_fator = ".$idadeMeses
            . " AND imc.vl_imc_percentil = ".$imc
            . " AND imc.cd_percentil = percentil.cd_percentil";

        // Selecionar percentil através dos dados encontrados na consulta ao entrevistado
        $result = $this->db->select($sql);
        // Recuperar única linha do resultado.
        $row = $this->db->get_row($result);

        return $row;        
    }
    
    /**
     * Selecionar código do perfil alimentar do entrevistado
     */
    
    public function selecionarPerfilAlimentar($id){
        
        $sql ="SELECT p.cd_perfilalimentar, p.cd_entrevistado "
                . "FROM tb_perfilalimentar AS p, tb_entrevistado AS e "
                . "WHERE e.cd_entrevistado = p.cd_entrevistado "
                . "AND e.cd_entrevistado= ".$id;
        
         // Selecionar perfil alimentar através dos dados encontrados na consulta ao entrevistado
        $result = $this->db->select($sql);
        // Recuperar única linha do resultado.
        $row = $this->db->get_row($result);

        return $row; 
    }
    
    public function selecionarPesquisas(){
        
        $select = "SELECT cd_pesquisa, nm_pesquisa ".
                "FROM tb_pesquisa";
        
        $result = $this->db->select($select);
        
        $rows = $this->db->get_rows($result);
               
        return $rows;
    }
    
    public function selecionarTipoUsuario($tipousuario){
        
        $select = "SELECT cd_tipousuario, nm_tipousuario "
                . "FROM tb_tipousuario "
                . "WHERE nm_tipousuario = ".$tipousuario;
        
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
    
    /**
     * Inserir dados de usuário na tabela usuário
     * @param type $data
     * @return type
     */
    public function inserirNutricionista($data) {

        $id = $this->db->insert_array('tb_nutricionista', $data);
        return $id;
    }
    
    public function inserirUsuario($data) {

        $id = $this->db->insert_array('tb_usuario', $data);
        return $id;
    }
    
    public function inserirIMCPercentil($data) {

        $id = $this->db->insert_array('tb_imc_percentil', $data);
        return $id;
    }
    
     public function inserirPesquisa($data) {

        $id = $this->db->insert_array('tb_pesquisa', $data);
        return $id;
    }
    
    public function inserirRespostasPerfilAlimentar($data) {

        $id = $this->db->insert_array('tb_perfilalimentar', $data);
        return $id;
    }
    
    public function inserirDadosAntropometricos($data) {

        $id = $this->db->insert_array('tb_anamnese', $data);
        return $id;
    }
    
    public function selectLogin($login, $senha) {
        $sql = "SELECT usuario.nm_login, usuario.nm_senha, cd_tipousuario "
                . " FROM tb_usuario AS usuario"
                . " WHERE"
                . " usuario.nm_login = '" . $login . "'"
                . " AND usuario.nm_senha = '" . $senha . "'";

        // Selecionar Usuário através de Login.
        $result = $this->db->select($sql);
        // Recuperar única linha do resultado.
        $row = $this->db->get_row($result);

        return $row;
    }
}
    
?>