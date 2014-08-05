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
        $perfilIMC= null;
        
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

    function verificarSituacaoDoPercentil($percentilEntrevistado){
    
                if (!ehVazio($percentilEntrevistado['percentilMediano']) 
                    || !ehVazio($percentilEntrevistado['percentilInferior']) 
                    || !ehVazio($percentilEntrevistado['percentilSuperior'])) {

                if (!ehVazio($percentilEntrevistado['percentilMediano'])) {
                    
                    if ($percentilEntrevistado['percentilMediano'] < 0.1)
                       return "Magreza acentuada";
                    else
                    if (!ehVazio($percentilEntrevistado['percentilMediano'] >= 0.1 && 
                            ($percentilEntrevistado['percentilMediano'] < 3)))
                        return "Magreza";
                    else
                    if (($percentilEntrevistado['percentilMediano'] >= 3 && 
                            ($percentilEntrevistado['percentilMediano'] <= 85)))
                        return "Eutrofia";
                    else
                    if (($percentilEntrevistado['percentilMediano'] >= 85 && 
                            ($percentilEntrevistado['percentilMediano'] <= 97)))
                        return "Sobrepeso";
                    else
                    if (($percentilEntrevistado['percentilMediano'] > 97) && 
                            ($percentilEntrevistado['percentilMediano'] <= 99.9))
                        return "Obesidade";
                    else
                    if ($percentilEntrevistado['percentilMediano'] > 99.9)
                        return "Obesidade grave";               
                    
                } else if(!ehVazio($percentilEntrevistado['percentilInferior']) 
                        && !ehVazio($percentilEntrevistado['percentilSuperior'])) {
                    
                    if ($percentilEntrevistado['percentilInferior'] < 0.1)
                        return "Magreza acentuada";
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 0.1 && 
                            ($percentilEntrevistado['percentilSuperior'] < 3)))
                        return "Magreza";
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 3 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 85)))
                        return "Eutrofia";
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 85 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 97)))
                        return "Sobrepeso";
                    else
                    if (($percentilEntrevistado['percentilInferior'] > 97) && 
                            ($percentilEntrevistado['percentilSuperior'] <= 99.9))
                         return "Obesidade";
                    else
                    if ($percentilEntrevistado['percentilSuperior'] > 99.9)
                         return "Obesidade grave"; 
                    
                    
                  } else if (!ehVazio($percentilEntrevistado['percentilInferior']) 
                        && ehVazio($percentilEntrevistado['percentilSuperior'])){
                      
                    if ($percentilEntrevistado['percentilInferior'] < 0.1)
                        return "Magreza acentuada";
                    else
                    if (!ehVazio($percentilEntrevistado['percentilInferior'] >= 0.1 && 
                            ($percentilEntrevistado['percentilInferior'] < 3)))
                        return "Magreza";
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 3 && 
                            ($percentilEntrevistado['percentilInferior'] <= 85)))
                        return "Eutrofia";
                    else
                    if (($percentilEntrevistado['percentilInferior'] >= 85 && 
                            ($percentilEntrevistado['percentilInferior'] <= 97)))
                        return "Sobrepeso";
                    else
                    if (($percentilEntrevistado['percentilInferior'] > 97) && 
                            ($percentilEntrevistado['percentilInferior'] <= 99.9))
                        return "Obesidade";
                    else
                    if ($percentilEntrevistado['percentilInferior'] > 99.9)
                        return "Obesidade grave";
                      
                  } else if (!ehVazio($percentilEntrevistado['percentilSuperior']) 
                        && ehVazio($percentilEntrevistado['percentilInferior'])){
                      
                    if ($percentilEntrevistado['percentilSuperior'] < 0.1)
                        return "Magreza acentuada";
                    else
                    if (($percentilEntrevistado['percentilSuperior'] >= 0.1 && 
                            ($percentilEntrevistado['percentilSuperior'] < 3)))
                        return "Magreza";
                    else
                    if (($percentilEntrevistado['percentilSuperior'] >= 3 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 85)))
                        return "Eutrofia";
                    else
                    if (($percentilEntrevistado['percentilSuperior'] >= 85 && 
                            ($percentilEntrevistado['percentilSuperior'] <= 97)))
                        return "Sobrepeso";
                    else
                    if (($percentilEntrevistado['percentilSuperior'] > 97) && 
                            ($percentilEntrevistado['percentilSuperior'] <= 99.9))
                        return "Obesidade";
                    else
                    if ($percentilEntrevistado['percentilSuperior'] > 99.9)
                        return "Obesidade grave";
                        
                  } 
            }
}

?>
