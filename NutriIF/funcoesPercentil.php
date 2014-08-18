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

        // Altura em centímetro
        $alturaCm = $rowDadosAntropometricos['nr_altura'];   

            // Calcular IMC com os dados do entrevistado.
        $alturaMetros = $alturaCm/100;

        // Cálculo do IMC
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
        $perfilIMC= 0;
        $perfilPercentil = 0;
        
        // Para idade abaixo de 228 meses (19 Anos)
        if ($dados['idadeMeses'] <= IDADE_PERCENTIL_19) {
            $dao = new dao_class();
            
            $percentilMediano = $dao->selectPercentil($dados['imc'], 
                    $dados['sexo'], $dados['idadeMeses']);

            // Buscar percentis nas proximidades
            if (!$percentilMediano) {

                // Margens dos percentis baseado no cálculo inicial.
                $margemIMCInferior = $dados['imc'] - MARGEM_LIMITE_PERCENTIL;
                $margemIMCSuperior = $dados['imc'] + MARGEM_LIMITE_PERCENTIL;

                // Valores crescentes e decrescentes do IMC.
                $imcDecrescente = $dados['imc'];
                $imcCrescente = $dados['imc'];

                // Verificação do percentil inferior.
                while ($percentilInferior == 0 && $imcDecrescente >= $margemIMCInferior) {
                    $imcDecrescente = $imcDecrescente - 0.1;
                    $percentilInferior = $dao->selectPercentil($imcDecrescente, $dados['sexo'], $dados['idadeMeses']);
                }

                // Verificação do percentil superior.
                while ($percentilSuperior == 0 && $imcCrescente <= $margemIMCSuperior) {
                    $imcCrescente = $imcCrescente + 0.1;
                    $percentilSuperior = $dao->selectPercentil($imcCrescente, $dados['sexo'], $dados['idadeMeses']);
                }
            }
            
            //Verificar situação do percentil
            if (isset($percentilMediano) || isset($percentilInferior) || isset($percentilSuperior)) {

                if ($percentilMediano) {
                    
                    if ($percentilMediano['vl_percentil'] < 0.1)                       
                        $perfilPercentil = "Magreza acentuada";
                    else
                    if ($percentilMediano['vl_percentil'] >= 0.1 && 
                            $percentilMediano['vl_percentil'] < 3)
                        $perfilPercentil = "Magreza";
                    else
                    if ($percentilMediano['vl_percentil'] >= 3 && 
                            $percentilMediano['vl_percentil'] <= 85)
                        $perfilPercentil = "Eutrofia";
                    else
                    if ($percentilMediano['vl_percentil'] >= 85 && 
                            $percentilMediano['vl_percentil'] <= 97)
                        $perfilPercentil = "Sobrepeso";
                    else
                    if ($percentilMediano['vl_percentil'] > 97 && 
                            $percentilMediano['vl_percentil'] <= 99.9)
                        $perfilPercentil = "Obesidade";
                    else
                    if ($percentilMediano['vl_percentil'] > 99.9)
                        $perfilPercentil = "Obesidade grave";               
                    
                } else if($percentilInferior['vl_percentil'] && $percentilSuperior['vl_percentil']) {
                     if ($percentilInferior['vl_percentil'] < 0.1)
                        return "Magreza acentuada";
                    else
                    if ($percentilInferior['vl_percentil'] >= 0.1 && $percentilSuperior['vl_percentil'] < 3)
                        $perfilPercentil = "Magreza";
                    else
                    if ($percentilInferior['vl_percentil'] >= 3 && $percentilSuperior['vl_percentil'] <= 85)
                        $perfilPercentil = "Eutrofia";
                    else
                    if ($percentilInferior['vl_percentil'] >= 85 && $percentilSuperior['vl_percentil'] <= 97)
                        $perfilPercentil = "Sobrepeso";
                    else
                    if ($percentilInferior['vl_percentil'] > 97 && $percentilSuperior['vl_percentil'] <= 99.9)
                         $perfilPercentil = "Obesidade";
                    else
                    if ($percentilInferior['vl_percentil'] > 99.9)
                         $perfilPercentil = "Obesidade grave"; 
 
                  } else if ($percentilInferior && !$percentilSuperior){  
                    if ($percentilInferior['vl_percentil'] < 0.1)
                        return "Magreza acentuada";
                    else
                    if ($percentilInferior['vl_percentil'] >= 0.1 && $percentilInferior['vl_percentil'] < 3)
                        $perfilPercentil = "Magreza";
                    else
                    if ($percentilInferior['vl_percentil'] >= 3 && $percentilInferior['vl_percentil'] <= 85)
                        $perfilPercentil = "Eutrofia";
                    else
                    if ($percentilInferior['vl_percentil'] >= 85 && $percentilInferior['vl_percentil'] <= 97)
                        $perfilPercentil = "Sobrepeso";
                    else
                    if ($percentilInferior['vl_percentil'] > 97 && $percentilInferior['vl_percentil'] <= 99.9)
                        $perfilPercentil = "Obesidade";
                    else
                    if ($percentilInferior['vl_percentil'] > 99.9)
                        $perfilPercentil = "Obesidade grave";
                      
                  } else if ($percentilSuperior && !$percentilInferior){
                                        
                    if ($percentilSuperior['vl_percentil'] < 0.1)
                        return "Magreza acentuada";
                        
                    else
                    if ($percentilSuperior['vl_percentil'] >= 0.1 && $percentilSuperior['vl_percentil'] < 3)
                        $perfilPercentil = "Magreza";
                        
                     else
                    if ($percentilSuperior['vl_percentil'] >= 3 && 
                            $percentilSuperior['vl_percentil'] <= 85)
                        $perfilPercentil = "Eutrofia";
                    else
                    if ($percentilSuperior['vl_percentil'] >= 85 && 
                            $percentilSuperior['vl_percentil'] <= 97)
                        $perfilPercentil = "Sobrepeso";
                    else
                    if ($percentilSuperior['vl_percentil'] > 97 && 
                            $percentilSuperior['vl_percentil'] <= 99.9)
                        $perfilPercentil = "Obesidade";
                    else
                    if ($percentilSuperior['vl_percentil'] > 99.9)
                        $perfilPercentil = "Obesidade grave";
                  }     
                }else{
                    
                    $_SESSION['medidasInvalidas'] = "medidasInvalidas";
                      
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
                'perfilPercentil'=> $perfilPercentil,
                'idadeMeses' => $dados['idadeMeses'],
                'imc'=> $dados['imc']
                );
            
            return $resultados;
}
    

?>
