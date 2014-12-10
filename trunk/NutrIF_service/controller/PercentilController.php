<?php

/**
 * Description of PercentilController
 *
 * @author Projeto IFPB-CG 01
 */
class PercentilController {

    public static function calcularPercentil($imc, $sexo, $nascimento) {

        $percentil = NULL;

        $idadeMeses = DataUtil::calcularIdadeMeses($nascimento);

        if ($idadeMeses <= IDADE_PERCENTIL_19) {
            $db = new DbHandler();
            $percentil = $db->selecionarPercentil($imc, $sexo, $idadeMeses);
        }

        return $percentil;
    }

    public static function calcularPercentilMargens($imc, $sexo, $nascimento) {

        $curva = new Curva();

        // Margens dos percentis baseado no cálculo inicial.
        $margemIMCInferior = $imc - MARGEM_LIMITE_PERCENTIL;
        $margemIMCSuperior = $imc + MARGEM_LIMITE_PERCENTIL;

        // Valores crescentes e decrescentes do IMC.
        $imcDecrescente = $imc;
        $imcCrescente = $imc;

        $idadeMeses = DataUtil::calcularIdadeMeses($nascimento);

        $db = new DbHandler();

        // Verificação do percentil inferior.
        $percentilInferior = NULL;
        while (empty($percentilInferior) && $imcDecrescente >= $margemIMCInferior) {
            // Decrescer gradativamente os valores do IMC na escala.
            $imcDecrescente = $imcDecrescente - ESCALA_IMC_PERCENTIL;

            $percentilInferior = $db->selecionarPercentil($imcDecrescente, $sexo, $idadeMeses);
        }

        $curva->setPercentilInferior($percentilInferior);

        // Verificação do percentil superior.
        $percentilSuperior = NULL;
        while (empty($percentilSuperior) && $imcCrescente <= $margemIMCSuperior) {
            // Crescer gradativamente os valores do IMC na escala.
            $imcCrescente = $imcCrescente + ESCALA_IMC_PERCENTIL;

            $percentilSuperior = $db->selecionarPercentil($imcCrescente, $sexo, $idadeMeses);
        }

        $curva->setPercentilSuperior($percentilSuperior);

        return $curva;
    }

    public static function determinarDiagnosticoNutricional($curva) {

        if (!empty($curva)) {
            // Percentis
            $percentilMediano = $curva->getPercentilMediano();
            $percentilInferior = $curva->getPercentilInferior();
            $percentilSuperior = $curva->getPercentilSuperior();

            if (!empty($percentilMediano) || !empty($percentilInferior) 
                    || !empty($percentilSuperior)) {

                //captura o diagnóstico avaliando o percentil
                $diagnostico = PercentilController::
                        determinarDiagnosticoPercentil($curva);
            } else {
                //captura o diagnóstico avaliando o imc
                $imc = $curva->getImc();
                $diagnostico = IMCController::determinarDiagnosticoIMC($imc);
            }
        }
        return $diagnostico;
    }

    public static function determinarDiagnosticoPercentil($curva) {

        // Percentis
        $percentilMediano = $curva->getPercentilMediano();
        $percentilInferior = $curva->getPercentilInferior();
        $percentilSuperior = $curva->getPercentilSuperior();
        $diagnostico = NULL;

        if (!empty($percentilMediano)) {

            $valorPercentilMediano = $percentilMediano->getValorPercentil();

            if ($valorPercentilMediano < 0.1) {
                $diagnostico = PERCENTIL_MAGREZA_ACENTUADA;
            } else if ($valorPercentilMediano >= 0.1 &&
                    $valorPercentilMediano < 3) {
                $diagnostico = PERCENTIL_MAGREZA;
            } else if ($valorPercentilMediano >= 3 &&
                    $valorPercentilMediano <= 85) {
                $diagnostico = PERCENTIL_EUTROFIA;
            } else if ($valorPercentilMediano > 85 &&
                    $valorPercentilMediano <= 97) {
                $diagnostico = PERCENTIL_SOBREPESO;
            } else if ($valorPercentilMediano > 97 &&
                    $valorPercentilMediano <= 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE;
            } else if ($valorPercentilMediano > 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE_MORBIDA;
            }
        } else if (!empty($percentilInferior) && !empty($percentilSuperior)) {
            $valorPercentilInferior = $percentilInferior->getValorPercentil();
            $valorPercentilSuperior = $percentilSuperior->getValorPercentil();

            if ($valorPercentilInferior < 0.1) {
                $diagnostico = PERCENTIL_MAGREZA_ACENTUADA;
            } else
            if ($valorPercentilInferior >= 0.1 && $valorPercentilSuperior < 3) {
                $diagnostico = PERCENTIL_MAGREZA;
            } else
            if ($valorPercentilInferior >= 3 && $valorPercentilSuperior <= 85) {
                $diagnostico = PERCENTIL_EUTROFIA;
            } else
            if ($valorPercentilInferior >= 85 && $valorPercentilSuperior <= 97) {
                $diagnostico = PERCENTIL_SOBREPESO;
            } else
            if ($valorPercentilInferior > 97 && $valorPercentilSuperior <= 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE;
            } else
            if ($valorPercentilInferior > 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE_MORBIDA;
            }
        } else if (!empty($percentilInferior) && empty($percentilSuperior)) {
            $valorPercentilInferior = $percentilInferior->getValorPercentil();

            if ($valorPercentilInferior < 0.1) {
                $diagnostico = PERCENTIL_MAGREZA_ACENTUADA;
            } else
            if ($valorPercentilInferior >= 0.1 &&
                    $valorPercentilInferior < 3) {
                $diagnostico = PERCENTIL_MAGREZA;
            } else
            if ($valorPercentilInferior >= 3 &&
                    $valorPercentilInferior <= 85) {
                $diagnostico = PERCENTIL_EUTROFIA;
            } else
            if ($valorPercentilInferior > 85 &&
                    $valorPercentilInferior <= 97) {
                $diagnostico = PERCENTIL_SOBREPESO;
            } else
            if ($valorPercentilInferior > 97 &&
                    $valorPercentilInferior <= 99.9) {
                $$diagnostico = PERCENTIL_OBESIDADE;
            } else
            if ($valorPercentilInferior > 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE_MORBIDA;
            }
        } else if (empty($percentilInferior) && !empty($percentilSuperior)) {

            $valorPercentilSuperior = $percentilSuperior->getValorPercentil();

            if ($valorPercentilSuperior < 0.1) {
                $diagnostico = PERCENTIL_MAGREZA_ACENTUADA;
            } else
            if ($valorPercentilSuperior >= 0.1 && $valorPercentilSuperior < 3) {
                $diagnostico = PERCENTIL_MAGREZA;
            } else
            if ($valorPercentilSuperior >= 3 &&
                    $valorPercentilSuperior <= 85) {
                $$diagnostico = PERCENTIL_EUTROFIA;
            } else
            if ($valorPercentilSuperior > 85 &&
                    $valorPercentilSuperior <= 97) {
                $diagnostico = PERCENTIL_SOBREPESO;
            } else
            if ($valorPercentilSuperior > 97 &&
                    $valorPercentilSuperior <= 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE;
            } else
            if ($valorPercentilSuperior > 99.9) {
                $diagnostico = PERCENTIL_OBESIDADE_MORBIDA;
            }
        }

        return $diagnostico;
    }

}
