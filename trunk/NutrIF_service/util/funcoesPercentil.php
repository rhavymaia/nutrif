<?php

require_once 'database/DbHandler.php';

function converterData($data) {

    $birthday = new DateTime($data);
    $date = new DateTime();
    $diff = $birthday->diff($date);
    $months = $diff->format('%m') + 12 * $diff->format('%y');

    return $months;
}

//função que formata a data
   function formata_data($data)
    {
     //recebe o parâmetro e armazena em um array separado por -
     $data = explode('-', $data);
     //armazena na variavel data os valores do vetor data e concatena /  
     $data = $data[2].'/'.$data[1].'/'.$data[0];

     //retorna a string da ordem correta, formatada
     return $data;
    }

function calcularIdade($data){
    
    // Separa em dia, mês e ano
    list($dia, $mes, $ano) = explode('/', $data);
   
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
   
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    
    return $idade;
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
    
     $percentil = new Percentil();

    // Verificação do percentil inferior.
    while (!$percentilInferior && $imcDecrescente >= $margemIMCInferior) {
        $imcDecrescente = $imcDecrescente - 0.1;
        $percentilInferior = $db->selecionarPercentil($imcDecrescente, $sexo, $idadeMeses);
    }

    // Verificação do percentil superior.
    while (!$percentilSuperior && $imcCrescente <= $margemIMCSuperior) {
        $imcCrescente = $imcCrescente + 0.1;
        $percentilSuperior = $db->selecionarPercentil($imcCrescente, $sexo, $idadeMeses);
    }

    $percentil->setPercentilInferior($percentilInferior);
    $percentil->setPercentilSuperior($percentilSuperior);
    
    return $percentil;
}

?>
