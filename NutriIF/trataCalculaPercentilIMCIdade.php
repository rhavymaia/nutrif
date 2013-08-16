<?php

    session_start();

    // Cabeçalho e menu da página html.
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');   

    //Inicialização de variáveis.
    $matricula = $_POST['matricula'];

    if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)) {

        $dao = new dao_class();

        $rowEntrevistado = $dao->selectEntrevistado($matricula);

        // Verificar se a checagem não gera problemas de tipo.
        if ($rowEntrevistado) {
            $peso = $rowEntrevistado['nr_peso'];
            $alturaCm = $rowEntrevistado['nr_altura'];
            $sexo = $rowEntrevistado['tp_sexo'];
            $dtNascimento = $rowEntrevistado['dt_nascimento'];
            $idadeMeses = getIdade($dtNascimento);

            // Calcular IMC com os dados do entrevistado.
            $alturaMetros = $alturaCm / 100;
            
            // Cálculo do IMC
            $imc = number_format($peso / pow($alturaMetros, 2), 1);
            
            $percentilInferior = 0;
            $percentilSuperior = 0;
            $percentilMediano = $dao->selectPercentil($imc, $sexo, $idadeMeses);

            if (mysql_affected_rows($percentilMediano)<0){
                
                echo "Percentil fora da linha";
                $margemIMCInferior = $imc - 2;
                $margemIMCSuperior = $imc + 2;
                
                $imcDecrescente = $imc;
                $imcCrescente = $imc;
                 
                        
                while ((mysql_affected_rows($percentilMediano)<0 || $percentilInferior == 0) && ($imcDecrescente >= $margemIMCInferior)) {                     
                    $imcDecrescente = $imcDecrescente - 0.1;                    
                    $percentilInferior = $dao->selectPercentil($imcDecrescente, $sexo, $idadeMeses);
                }
                
                while ((mysql_affected_rows($percentilMediano)< 0 || $percentilSuperior == 0) && ($imcCrescente <= $margemIMCSuperior)) {
                    echo "entrou";
                   $imcCrescente  = $imcCrescente  + 0.1;
                    $percentilSuperior = $dao->selectPercentil($imcCrescente , $sexo, $idadeMeses);
                }
            }
            
            // enviar para a próxima tela os valores
            $_SESSION['percentilMediano'] = $percentilMediano['vl_percentil'];
            $_SESSION['percentilSuperior'] = $percentilSuperior['vl_percentil'];
            $_SESSION['percentilInferior'] = $percentilInferior['vl_percentil'];
            header("location: formCalculaPercentilIMCIdade.php");
            
            } else {

                $msg = ("Matrícula não encontrada");
                $_SESSION['matricula'] = $matricula;
                $_SESSION['erro'] = $msg;
                header("location: formCalculaPercentilIMCIdade.php");
            }
        } else {

            $msg = ("Informe uma matrícula válida. Somente número são permitidos");
            $_SESSION['erro'] = $msg;
            header("location: formCalculaPercentilIMCIdade.php");  
        }
?>