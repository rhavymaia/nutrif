<?php

require_once ('database/connect.class.php');

class dao_class {

    var $db;
    

    function dao_class() {
        $conn = new connect_class;
        $this->db = $conn->database();
    }

    public function carregaMunicipio() {

        $r = $this->db->select("SELECT cd_municipio, nm_municipio FROM tb_municipio");

        return $this->db->get_rows($r);
    }

    public function inserirEntrevistado($data) {

        $id = $this->db->insert_array('tb_entrevistado', $data);
        return $id;
    }
   
    
    /*public function selectDadosPercentil() {

        $query = "SELECT nr_peso, nr_altura,dt_nascimento,tp_sexo"
                . "FROM tb_entrevistado"
                . "WHERE matr == nr_matricula";

        $result = $this->db->select($query);

        return $this->db->get_rows($result);
    }*/

}

?>