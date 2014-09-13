<?php
/**
 * Description of EmailValidator
 *
 * @author Rhavy
 */
class EmailValidator {
    
    function validate($email) {
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }        
        return false;
    }
}
