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
            $imcValor = $numeroUtil->formatDouble(
                    $peso / pow($alturaMetro, 2), 1);
        }

        return $imcValor;
    }

    public static function calculaPerfilAntropometrico($anamnese) {
        // Peso, altura, idade, sexo
    }

    public static function determinarDiagnosticoIMC($imc) {

        //retorna apenas o diagnóstico pelo IMC
        $valorImc = $imc->getValor();
        $diagnostico = NULL;

        if ($valorImc <= 18.49) {
            //abaixo do peso
            $diagnostico = IMC_ABAIXO_PESO;
        }if ($valorImc >= 18.5 && $valorImc < 25) {
            //peso normal
            $diagnostico = IMC_PESO_NORMAL;
        }if ($valorImc >= 25 && $valorImc < 30) {
            //sobrepeso
            $diagnostico = IMC_SOBREPESO;
        }if ($valorImc >= 30 && $valorImc < 35) {
            //obesidade leve
            $diagnostico = IMC_OBESIDADE_LEVE;
        }if ($valorImc >= 35 && $valorImc < 40) {
            //obesidade moderada
            $diagnostico = IMC_OBESIDADE_MODERADA;
        }if ($valorImc >= 40) {
            //obesidade avançada
            $diagnostico = IMC_OBESIDADE_AVANCADA;
        }
        
        return $diagnostico;
    }

}
