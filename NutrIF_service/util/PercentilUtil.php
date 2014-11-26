<?php

require_once 'database/DbHandler.php';
require_once './DataUtil.php';
require_once './constantes.php';

/**
 * Description of PercentilUtil
 *
 * @author Projeto IFPB-CG 01
 */
class PercentilUtil {

    public static function calcularPercentilMargens($imc, $sexo, $nascimento) {

        $percentilInferior = 0;
        $percentilSuperior = 0;

        // Margens dos percentis baseado no cálculo inicial.
        $margemIMCInferior = $imc - MARGEM_LIMITE_PERCENTIL;
        $margemIMCSuperior = $imc + MARGEM_LIMITE_PERCENTIL;

        // Valores crescentes e decrescentes do IMC.
        $imcDecrescente = $imc;
        $imcCrescente = $imc;
        
        $idadeMeses = DataUtil::calcularIdadeMeses($nascimento);

        $db = new DbHandler();        

        // Verificação do percentil inferior.
        while (!$percentilInferior && $imcDecrescente >= $margemIMCInferior) {
            $imcDecrescente = $imcDecrescente - 0.1;
            $percentilInferior = $db->selecionarPercentil($imcDecrescente, 
                    $sexo, $idadeMeses);
        }

        // Verificação do percentil superior.
        while (!$percentilSuperior && $imcCrescente <= $margemIMCSuperior) {
            $imcCrescente = $imcCrescente + 0.1;
            $percentilSuperior = $db->selecionarPercentil($imcCrescente, 
                    $sexo, $idadeMeses);
        }

        $percentil = new Percentil();
        $percentil->setPercentilInferior($percentilInferior);
        $percentil->setPercentilSuperior($percentilSuperior);

        return $percentil;
    }

}
