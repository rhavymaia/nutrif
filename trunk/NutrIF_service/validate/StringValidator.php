<?php
/**
 * Validaчуo para String.
 *
 * @author Rhavy
 */
class StringValidator {
    
    function validate($valor) {
        
        if (isset($valor) 
                && trim($valor) != VAZIO
                && preg_match('/^[a-zA-Z]*$/', $valor)) {
            return true;
        }        
        return false;
    }
}
