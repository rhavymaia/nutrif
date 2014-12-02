<?php

/**
 * Description of IMCController
 *
 * @author Rhavy
 */
class IMCController {
    
    public static function calculaIMC($peso, $alturaCm) {
        // Peso, altura
        $imcValor = 0;
        $numeroUtil = NumeroUtil::singleton();
        $alturaMetro = $numeroUtil->formatDouble($alturaCm / FATOR_CENTIMETRO);
        
        if (($peso > 0) && ($alturaMetro > 0)) {
            $imcValor = $numeroUtil->formatDouble($peso / pow($alturaMetro, 2));
        }
        
        return $imcValor;
    }
    
     public static function calculaPerfilAntropometrico($anamnese) {
        // Peso, altura, idade, sexo
     }
}
