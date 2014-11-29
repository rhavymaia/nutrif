<?php

/**
 * Description of IMCController
 *
 * @author Rhavy
 */
class IMCController {
    
    public static function calculaIMC($peso, $altura) {
        // Peso, altura
        $imc = 0;
        
        if (($peso > 0) && ($altura > 0)) {
            $imc = (double) number_format($peso / pow($altura, 2), 1);
        }
        
        return $imc;
    }
    
     public static function calculaPerfilAntropometrico($anamnese) {
        // Peso, altura, idade, sexo
     }
}
