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
            $percentil = $db->selecionarPercentil($imc, $sexo, 
                    $idadeMeses);
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
        while (empty($percentilInferior) 
                && $imcDecrescente >= $margemIMCInferior) {
            // Decrescer gradativamente os valores do IMC na escala.
            $imcDecrescente = $imcDecrescente - ESCALA_IMC_PERCENTIL;
            
            $percentilInferior = $db->selecionarPercentil($imcDecrescente, 
                    $sexo, $idadeMeses);
        }
        
        $curva->setPercentilInferior($percentilInferior);

        // Verificação do percentil superior.  
        $percentilSuperior = NULL;        
        while (empty($percentilSuperior) 
                && $imcCrescente <= $margemIMCSuperior) {
            // Crescer gradativamente os valores do IMC na escala.
            $imcCrescente = $imcCrescente + ESCALA_IMC_PERCENTIL;
            
            $percentilSuperior = $db->selecionarPercentil($imcCrescente, 
                    $sexo, $idadeMeses);
        }
        
        $curva->setPercentilSuperior($percentilSuperior);
        
        return $curva;
    }
}
