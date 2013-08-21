<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

//Inicializa��o de vari�veis.
$matricula = $_POST['matricula'];

if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);

    // Verificar se a checagem n�o gera problemas de tipo.
    if ($rowEntrevistado) {
        $peso = $rowEntrevistado['nr_peso'];
        $alturaCm = $rowEntrevistado['nr_altura'];
        $sexo = $rowEntrevistado['tp_sexo'];
        $dtNascimento = $rowEntrevistado['dt_nascimento'];
        $idadeMeses = getIdade($dtNascimento);

        // Calcular IMC com os dados do entrevistado.
        $alturaMetros = $alturaCm / 100;

        // C�lculo do IMC
        $imc = number_format($peso / pow($alturaMetros, 2), 1);

        // Para idade abaixo de 228 meses (19 Anos)
        if ($idadeMeses <= IDADE_PERCENTIL_19) {       
            $percentilInferior = 0;
            $percentilSuperior = 0;
            $percentilMediano = $dao->selectPercentil($imc, $sexo, $idadeMeses);

            // Buscar percentis nas proximidades
            if (!$percentilMediano) {
                
                // Margens dos percentis baseado no c�lculo inicial.
                $margemIMCInferior = $imc - MARGEM_LIMITE_PERCENTIL;
                $margemIMCSuperior = $imc + MARGEM_LIMITE_PERCENTIL;

                $imcDecrescente = $imc;
                $imcCrescente = $imc;

                // Verifica��o do percentil inferior.
                while ($percentilInferior == 0 && $imcDecrescente >= $margemIMCInferior) {
                    $imcDecrescente = $imcDecrescente - 0.1;
                    $percentilInferior = $dao->selectPercentil($imcDecrescente, $sexo, $idadeMeses);
                }

                // Verifica��o do percentil superior.
                while ($percentilSuperior == 0 && $imcCrescente <= $margemIMCSuperior) {
                    $imcCrescente = $imcCrescente + 0.1;
                    $percentilSuperior = $dao->selectPercentil($imcCrescente, $sexo, $idadeMeses);
                }
            }

            // Enviar para a pr�xima tela os valores
            $_SESSION['sexo'] = $sexo;
            $_SESSION['percentilMediano'] = $percentilMediano['vl_percentil'];
            $_SESSION['percentilSuperior'] = $percentilSuperior['vl_percentil'];
            $_SESSION['percentilInferior'] = $percentilInferior['vl_percentil'];
            header("location: formCalculaPercentilIMCIdade.php");
        } else {
            // Tratar pessoas maiores de 19 anos
            $_SESSION['imc'] = $imc;
        }
    } else {
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php");
    }
} else {
    $msg = ("Informe uma matr�cula v�lida. Somente n�mero s�o permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formCalculaPercentilIMCIdade.php");
}
?>