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
        $select = "SELECT cd_entrevistado, nr_matricula, dt_nascimento" .
                "FROM tb_entrevistado " .
                "WHERE nr_matricula = " . $matricula;

        // Selecionar entrevistado atrav�s da matr�cula.
        $result = $this->db->select($select);

        // Recuperar �nica linha do resultado. Matr�cula � chave �nica.
        $row = $this->db->get_row($result);

        return $row;
    }

    public function selectDadosAntropometricos($matricula) {

        // Montar consulta.
        $select = "SELECT nr_peso, nr_altura, tp_sexo " .
                "FROM tb_anamnese" .
                "WHERE nr_matricula = " . $matricula;

        // Selecionar entrevistado atrav�s da matr�cula.
        $result = $this->db->select($select);

        // Recuperar �nica linha do resultado. Matr�cula � chave �nica.
        $row = $this->db->get_row($result);

        return $row;
    }

    public function selectEntrevistados() {

        $select = "SELECT cd_entrevistado, nr_matricula, dt_nascimento, nr_peso, nr_altura, tp_sexo " .
                "FROM tb_entrevistado";
        //" WHERE ysnData BETWEEN '.$dataInicial.' and '.$dataFinal;
        // Selecionar entrevistado atrav�s da matr�cula.
        $result = $this->db->select($select);

        $rows = $this->db->get_rows($result);

        return $rows;
    }

    /**
     * Recupera��o informa��es da avalia��o antropom�trica para c�lcular o 
     * percentil do IMC.
     * 
     * @param type $matricula
     * @return type
     */
    public function selectPercentil($imc, $sexo, $idadeMeses) {

        // Consultar o Percentil na tabela tb_imc_percentil.            
        $sql = "SELECT imc.cd_percentil, percentil.vl_percentil"
                . " FROM"
                . " tb_imc_percentil AS imc, tb_percentil AS percentil"
                . " WHERE"
                . " imc.tp_sexo = '" . $sexo . "'"
                . " AND imc.cd_fator = " . FATOR
                . " AND imc.vl_fator = " . $idadeMeses
                . " AND imc.vl_imc_percentil = " . $imc
                . " AND imc.cd_percentil = percentil.cd_percentil";

        // Selecionar percentil atrav�s dos dados encontrados na consulta ao entrevistado
        $result = $this->db->select($sql);
        // Recuperar �nica linha do resultado.
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

    public function inserirDadosAntropometricos($data) {

        $id = $this->db->insert_array('tb_anamnese', $data);
        return $id;
    }

    public function inserirIMCPercentil($data) {

        $id = $this->db->insert_array('tb_imc_percentil', $data);
        return $id;
    }

    public function inserirRespostasPerfilAlimentar($data) {

        $id = $this->db->insert_array('tb_resposta', $data);
        return $id;
    }

    public function selectLogin($login, $senha) {
        $sql = "SELECT nutri.nm_login, nutri.nm_senha"
                . " FROM tb_usuario AS nutri"
                . " WHERE"
                . " nutri.nm_login = '" . $login . "'"
                . " AND nutri.nm_senha = '" . $senha . "'";

        // Selecionar Usu�rio atrav�s de Login.
        $result = $this->db->select($sql);
        // Recuperar �nica linha do resultado.
        $row = $this->db->get_row($result);

        return $row;
    }

}

?>