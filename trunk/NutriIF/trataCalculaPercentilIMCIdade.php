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
            $alturaMetros = $alturaCm/100;
            $imc = number_format($peso/pow($alturaMetros, 2), 1);
            $percentil = $dao->selectPercentil($imc, $sexo, $idadeMeses);

            $vl_perc = $percentil['vl_percentil'];
            $cd_perc = $percentil['cd_percentil'];

            $_SESSION['percentil'] = $vl_perc;
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