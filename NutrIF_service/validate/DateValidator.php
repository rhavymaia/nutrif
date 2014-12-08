<?php
/**
 * Description of DateValidator
 *
 * @author Rhavy
 */
class DateValidator {
    
    function __construct() {}
    
    function validate($data) {
        
        $valido = FALSE;
        // preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data)
        if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data)){
            $valido = TRUE;
        }
        
        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", 
                $data)){
            $valido = TRUE;
        }
        
        return $valido;        
    }
}
