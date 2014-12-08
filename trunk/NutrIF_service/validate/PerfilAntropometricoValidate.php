<?php

/**
 * Validar os dados do VCT.
 *
 * @author Rhavy
 */
class PerfilAntropometricoValidate {

    public static function validate($peso, $altura, $sexo, $nascimento) {

        $validate = VALIDO;

        if (empty($peso) || !is_numeric($peso)) {
            $validate = PESO_INVALIDO;
        }

        if (empty($altura) || !is_numeric($altura)) {
            $validate = ALTURA_INVALIDO;
        }
        
        if (empty($sexo)) {
            $validate = SEXO_INVALIDO;            
        } else {          
            if (strtoupper($sexo) != MASCULINO 
                    && strtoupper($sexo) != FEMININO) {
                $validate = SEXO_INVALIDO;
            }
        }
        
        $dataValidade = new DateValidator();
        
        if (!$dataValidade->validate($nascimento)) {
            $validate = DATA_INVALIDA;
        }

        return $validate;
    }
}
