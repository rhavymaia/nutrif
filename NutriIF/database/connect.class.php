<?php

require_once ('database/db.class.php');

class connect_class {

    var $db = null;

    function connect_class() {

        $this->db = new db_class;

        if (!$this->db->connect('localhost', 'nutrif_user', 'nutr1f_us3r', 'novonutrifatualizado', false)) {
                   echo "N�o conectou no banco!";
            $this->db->print_last_error(false);
        }
    }

    public function database() {
        if ($this->db != null) {
            return $this->db;
        }
    }
}
?>