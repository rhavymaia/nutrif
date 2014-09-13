<?php
/**
 * Description of DateValidator
 *
 * @author Rhavy
 */
class DateValidator {
    
    function validate($data) {
        
        // preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data)
        if(eregi("^[0-9]{2}/[0-9]{2}/[0-9]{4}$", $data)){
            return true;
        }
        return false;
        
    }
}
