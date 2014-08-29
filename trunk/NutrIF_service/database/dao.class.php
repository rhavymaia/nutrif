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
}
?>