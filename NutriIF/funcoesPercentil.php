<?php
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

function consultarEntrevistado($matricula) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);
    
    $rowDadosAntropometricos= $dao->selectDadosAntropometricos($matricula);
    
    if ($rowEntrevistado && $rowDadosAntropometricos){
        // Peso em quilograma
        $peso = $rowDadosAntropometricos['nr_peso'];

        // Altura em cent�metro
        $alturaCm = $rowDadosAntropometricos['nr_altura'];   

        // Calcular IMC com os dados do entrevistado.
        $alturaMetros = $alturaCm/100;

        // C�lculo do IMC
        $imc = number_format($peso/pow($alturaMetros, 2), 1);

        $entrevistado = array(
            'peso' => $peso,
            'alturaCm' => $alturaCm,
            'sexo' => $rowDadosAntropometricos['tp_sexo'],
            'dtNascimento' => $rowEntrevistado['dt_nascimento'],
            'idadeMeses' => getIdade($rowEntrevistado['dt_nascimento']),
            'imc' => $imc
        );
    }
    return $entrevistado;
}

function calcularPercentil($rowEntrevistado){
       
        $dados = $rowEntrevistado;
        $percentilInferior=0;
        $percentilSuperior = 0;
        $percentilMediano = 0;
        $perfilIMC= null;
        
        // Para idade abaixo de 228 meses (19 Anos)
        if ($dados['idadeMeses'] <= IDADE_PERCENTIL_19) {
            $dao = new dao_class();
            
            $percentilMediano = $dao->selectPercentil($dados['imc'], 
                    $dados['sexo'], $dados['idadeMeses']);

            // Buscar percentis nas proximidades
            if (!$percentilMediano) {

                // Margens dos percentis baseado no c�lculo inicial.
                $margemIMCInferior = $dados['imc'] - MARGEM_LIMITE_PERCENTIL;
                $margemIMCSuperior = $dados['imc'] + MARGEM_LIMITE_PERCENTIL;

                // Valores crescentes e decrescentes do IMC.
                $imcDecrescente = $dados['imc'];
                $imcCrescente = $dados['imc'];

                // Verifica��o do percentil inferior.
                while ($percentilInferior == 0 && $imcDecrescente >= $margemIMCInferior) {
                    $imcDecrescente = $imcDecrescente - 0.1;
                    $percentilInferior = $dao->selectPercentil($imcDecrescente, $dados['sexo'], $dados['idadeMeses']);
                }

                // Verifica��o do percentil superior.
                while ($percentilSuperior == 0 && $imcCrescente <= $margemIMCSuperior) {
                    $imcCrescente = $imcCrescente + 0.1;
                    $percentilSuperior = $dao->selectPercentil($imcCrescente, $dados['sexo'], $dados['idadeMeses']);
                }
            }
   
            } else {            
                // Tratar pessoas maiores de 19 anos           
                if ($dados['imc'] < 18.5) {
                    $perfilIMC = PERFIL_MAGREZA;
                } else if (($dados['imc'] >= 18.5) && ($dados['imc'] <= 24.9)) {
                    $perfilIMC = PERFIL_EUTROFICO;
                } else if (($dados['imc'] >= 25.0) && ($dados['imc'] <= 29.9)) {
                    $perfilIMC = PERFIL_SOBREPESO;
                } else if (($dados['imc'] >= 30.0) && ($dados['imc'] <= 34.9)) {
                    $perfilIMC = PERFIL_OBESO;
                } else if ($dados['imc'] >= 35.0) {
                    $perfilIMC = PERFIL_OBESO_MORBIDO;
                }
            }
                        
            $resultados = array('percentilMediano' => $percentilMediano['vl_percentil'], 
                'percentilInferior' => $percentilInferior['vl_percentil'],
                'percentilSuperior'=> $percentilSuperior['vl_percentil'],
                'perfilIMC'=> $perfilIMC,
                'imc'=> $dados['imc']
                );
            
            return $resultados;
}

?>