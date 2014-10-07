<?php

require_once 'database/DbHandler.php';
require_once './entidade/Percentil.class.php';

function converterData($data) {

    $birthday = new DateTime($data);
    $date = new DateTime();
    $diff = $birthday->diff($date);
    $months = $diff->format('%m') + 12 * $diff->format('%y');

    return $months;
}

function calcularPercentilMargens($imc, $sexo, $idadeMeses) {

    $percentilInferior = new Percentil();
    $percentilSuperior = new Percentil();
    $x = $percentilInferior->setVlPercentil(0); 
    
    // Setar os valores para iniciar o objeto
    $y = $percentilSuperior->setVlPercentil(0);
   

    // Margens dos percentis baseado no cálculo inicial.
    $margemIMCInferior = $imc - MARGEM_LIMITE_PERCENTIL;
    $margemIMCSuperior = $imc + MARGEM_LIMITE_PERCENTIL;

    // Valores crescentes e decrescentes do IMC.
    $imcDecrescente = $imc;
    $imcCrescente = $imc;
    
    $db = new DbHandler();

    // Verificação do percentil inferior.
    while ($x == 0 && $imcDecrescente >= $margemIMCInferior) {
        $imcDecrescente = $imcDecrescente - 0.1;
        $x = $db->selecionarPercentil($imcDecrescente, $sexo, 
                $idadeMeses);
    }

    // Verificação do percentil superior.
    while ($y == 0 && $imcCrescente <= $margemIMCSuperior) {
        $imcCrescente = $imcCrescente + 0.1;
        $y = $db->selecionarPercentil($imcCrescente, $sexo, 
                $idadeMeses);
    }
    
    $margemPercentil = array(
        'percentilInferior' => $x,
        'percentilSuperior' => $y
    );
    
    return $margemPercentil;
}

?>
