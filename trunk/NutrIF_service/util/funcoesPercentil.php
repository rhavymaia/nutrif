<?php

require_once 'database/DbHandler.php';

function converterData($data) {

    $birthday = new DateTime($data);
    $date = new DateTime();
    $diff = $birthday->diff($date);
    $months = $diff->format('%m') + 12 * $diff->format('%y');

    return $months;
}

function calcularPercentilMargens($imc, $sexo, $idadeMeses) {

    $percentilInferior = 0;
    $percentilSuperior = 0;

    // Margens dos percentis baseado no cálculo inicial.
    $margemIMCInferior = $imc - MARGEM_LIMITE_PERCENTIL;
    $margemIMCSuperior = $imc + MARGEM_LIMITE_PERCENTIL;

    // Valores crescentes e decrescentes do IMC.
    $imcDecrescente = $imc;
    $imcCrescente = $imc;
    
    $db = new DbHandler();

    // Verificação do percentil inferior.
    while ($percentilInferior == 0 && $imcDecrescente >= $margemIMCInferior) {
        $imcDecrescente = $imcDecrescente - 0.1;
        $percentilInferior = $db->selecionarPercentil($imcDecrescente, $sexo, $idadeMeses);
    }

    // Verificação do percentil superior.
    while ($percentilSuperior == 0 && $imcCrescente <= $margemIMCSuperior) {
        $imcCrescente = $imcCrescente + 0.1;
        $percentilSuperior = $db->selecionarPercentil($imcCrescente, $sexo, $idadeMeses);
    }
    $resultados = array(
        'percentilInferior' => $percentilInferior['vl_percentil'],
        'percentilSuperior' => $percentilSuperior['vl_percentil']
    );

    return $resultados;
}

?>
