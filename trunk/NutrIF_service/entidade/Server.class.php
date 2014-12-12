<?php

/**
 * Atributos do servidor.
 *
 * @author Rhavy
 */
class Server {
    
    public $online;
    
    function __construct() {}
    
    function getOnline() {
        return $this->online;
    }

    function setOnline($online) {
        $this->online = $online;
    }
}
?>
