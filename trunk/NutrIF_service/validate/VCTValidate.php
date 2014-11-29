<?php

/**
 * Validar os dados do VCT.
 *
 * @author Rhavy
 */
class VCTValidate {

    public static function validate($peso, $altura, $nivelEsportivo, 
            $sexo, $nascimento) {

        $validate = VALIDO;

        if (empty($peso) || !is_numeric($peso)) {
            $validate = PESO_INVALIDO;
        }

        if (empty($altura) || !is_numeric($altura)) {
            $validate = ALTURA_INVALIDO;
        }

        if (empty($nivelEsportivo) || !is_numeric($nivelEsportivo)) {
            $validate = NIVEL_ESPORTIVO_INVALIDO;
        }

        if (empty($sexo)) {
            $validate = SEXO_INVALIDO;            
        } else {          
            if (strtoupper($sexo) != MASCULINO 
                    && strtoupper($sexo) != FEMININO) {
                $validate = SEXO_INVALIDO;
            }
        }

        return $validate;
    }

}
