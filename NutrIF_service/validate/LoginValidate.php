<?php

/**
 * Validar os dados do Login.
 *
 * @author Rhavy
 */
class LoginValidate {
    
    public static function validate($login, $senha) {
        
        $validate = VALIDO;
        
        if (empty($login) || !filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $validate = LOGIN_INVALIDO;
        }
        
        if (empty($senha) || !is_string($senha)) {
            $validate = SENHA_INVALIDO;
        }
        
        return $validate;
    }
}
