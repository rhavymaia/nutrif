<?php

session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

//Inicialização de variáveis.
$matricula = $_POST['matricula'];

function capturarDados($matricula) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);

    $vetor = array(
        'peso' => $rowEntrevistado['nr_peso'],
        'alturaCm' => $rowEntrevistado['nr_altura'],
        'sexo' => $rowEntrevistado['tp_sexo'],
        'dtNascimento' => $rowEntrevistado['dt_nascimento'],
        'idadeMeses' => getIdade($rowEntrevistado['dt_nascimento'])
    );

    // Calcular IMC com os dados do entrevistado.
    $alturaMetros = $vetor['alturaCm'] / 100;

    // Cálculo do IMC
    $imc = number_format($vetor['peso'] / pow($alturaMetros, 2), 1);


    $vetor2 = array(
        'peso' => $rowEntrevistado['nr_peso'],
        'alturaCm' => $rowEntrevistado['nr_altura'],
        'sexo' => $rowEntrevistado['tp_sexo'],
        'dtNascimento' => $rowEntrevistado['dt_nascimento'],
        'idadeMeses' => getIdade($rowEntrevistado['dt_nascimento']),
        'imc' => $imc
    );


    return $vetor2;
}

if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);

    // Verificar se a checagem não gera problemas de tipo.
    if ($rowEntrevistado) {

        $dados = capturarDados($matricula);
        $percentilMediano = 0;
        // Para idade abaixo de 228 meses (19 Anos)
        if ($dados['idadeMeses'] <= IDADE_PERCENTIL_19) {
            $percentilInferior = 0;
            $percentilSuperior = 0;
            $percentilMediano = $dao->selectPercentil($dados['imc'], $dados['sexo'], $dados['idadeMeses']);

            // Buscar percentis nas proximidades
            if (!$percentilMediano) {

                // Margens dos percentis baseado no cálculo inicial.
                $margemIMCInferior = $dados['imc'] - MARGEM_LIMITE_PERCENTIL;
                $margemIMCSuperior = $dados['imc'] + MARGEM_LIMITE_PERCENTIL;

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

            // Enviar para a próxima tela os valores
            $_SESSION['sexo'] = $dados['sexo'];
            $_SESSION['percentilMediano'] = $percentilMediano['vl_percentil'];
            $_SESSION['percentilSuperior'] = $percentilSuperior['vl_percentil'];
            $_SESSION['percentilInferior'] = $percentilInferior['vl_percentil'];
            $_SESSION['existe'] = TRUE;
            header("location: formCalculaPercentilIMCIdade.php");
        } else {
            // Tratar pessoas maiores de 19 anos        
            $_SESSION['imc'] = $dados['imc'];
            if ($_SESSION['imc'] < 18.5)
            $_SESSION['perfilIMC'] = PERFIL_MAGREZA;
            else
            if (($_SESSION['imc'] >= 18.5) && ($_SESSION['imc'] <= 24.9))
            $_SESSION['perfilIMC'] = PERFIL_EUTROFICO;
            else
            if (($_SESSION['imc'] >= 25.0) && ($_SESSION['imc'] <= 29.9))
            $_SESSION['perfilIMC'] = PERFIL_SOBREPESO;
            else
            if (($_SESSION['imc'] >= 30.0) && ($_SESSION['imc'] <= 34.9))
            $_SESSION['perfilIMC'] = PERFIL_OBESO;
            else
            if ($_SESSION['imc'] >= 35.0)
            $_SESSION['perfilIMC'] = PERFIL_OBESO_MORBIDO;
            }
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