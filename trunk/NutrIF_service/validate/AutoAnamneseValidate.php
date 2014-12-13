<?php

/**
 * Validar os dados do VCT.
 *
 * @author Larissa
 */
class AutoAnamneseValidate {

    public static function validate($idEntrevistado, $peso, $altura, 
            $nivelEsportivo, $tipoEntrevistado) {

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
        
        if (empty($idEntrevistado) || !is_numeric($idEntrevistado)) {
            $validate = ID_ENTREVISTADO_INVALIDO;
        }
        
        if (empty($tipoEntrevistado)|| !is_numeric($tipoEntrevistado)) {
            $validate = TIPO_ENTREVISTADO_INVALIDO;
        }
        
        return $validate;
    }
}
