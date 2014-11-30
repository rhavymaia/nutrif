<?php

/**
 * Description of NumeroUtil
 *
 * @author Rhavy
 */
class NumeroUtil {
    
    private static $instance;

    function __construct() {
        
    }

    // O método singleton 
    public static function singleton() {
        if (!isset(self::$instance)) {
            self::$instance = new NumeroUtil();
        }

        return self::$instance;
    }
    
    public function formatDouble($valor, $decimais = 2){
        $valorFormat = (double) number_format($valor , $decimais, ".","");        
        return $valorFormat;
    }
}
