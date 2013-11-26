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

    // Consultar o entrevostado.
    $rowEntrevistado = $dao->selectEntrevistado($matricula);

    // Verificar se a checagem n�o gera problemas de tipo.
    if ($rowEntrevistado) {

        $dados = capturarDados($matricula);
        $_SESSION['imc'] = $dados['imc'];
        $_SESSION['sexo'] = $dados['sexo'];       

        // Para idade abaixo de 228 meses (19 Anos)
        if ($dados['idadeMeses'] <= IDADE_PERCENTIL_19) {
            
            $percentilInferior = 0;
            $percentilSuperior = 0;
            $percentilMediano = 0;
            
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

            // Enviar para a pr�xima tela os valores
            $_SESSION['percentilMediano'] = $percentilMediano['vl_percentil'];
            $_SESSION['percentilSuperior'] = $percentilSuperior['vl_percentil'];
            $_SESSION['percentilInferior'] = $percentilInferior['vl_percentil'];
            
            // Redirecionar para a p�gina de resultado.
            header("location: formCalculaPercentilIMCIdade.php");
        } else {
            
            // Tratar pessoas maiores de 19 anos           
            if ($_SESSION['imc'] < 18.5) {
                $_SESSION['perfilIMC'] = PERFIL_MAGREZA;
            } else if (($_SESSION['imc'] >= 18.5) && ($_SESSION['imc'] <= 24.9)) {
                $_SESSION['perfilIMC'] = PERFIL_EUTROFICO;
            } else if (($_SESSION['imc'] >= 25.0) && ($_SESSION['imc'] <= 29.9)) {
                $_SESSION['perfilIMC'] = PERFIL_SOBREPESO;
            } else if (($_SESSION['imc'] >= 30.0) && ($_SESSION['imc'] <= 34.9)) {
                $_SESSION['perfilIMC'] = PERFIL_OBESO;
            } else if ($_SESSION['imc'] >= 35.0) {
                $_SESSION['perfilIMC'] = PERFIL_OBESO_MORBIDO;
            }            
       
            //TODO: Verificar necessidade desse c�digo
            if ($_SESSION['perfilIMC'] == PERFIL_MAGREZA) {
                $_SESSION['qtdMagros']= $_SESSION['qtdMagros']+1;
            }
            if ($_SESSION['perfilIMC'] == PERFIL_EUTROFICO) {
                $_SESSION['qtdEutroficos']= $_SESSION['qtdEutroficos']+1;
            }
            if ($_SESSION['perfilIMC'] == PERFIL_SOBREPESO) {
                $_SESSION['qtdSobrepeso']= $_SESSION['qtdSobrepeso']+1;
            }
            if ($_SESSION['perfilIMC'] == PERFIL_OBESO) {
                $_SESSION['qtdObesos']= $_SESSION['qtdObesos']+1;
            }
            if ($_SESSION['perfilIMC'] == PERFIL_OBESO_MORBIDO) {
                $_SESSION['qtdObesosMorbidos']= $_SESSION['qtdObesosMorbidos']+1;
            }
            
            header("location: formCalculaPercentilIMCIdade.php");
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

function capturarDados($matricula) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);
    
    // Peso em quilograma
    $peso = $rowEntrevistado['nr_peso'];
    
    // Altura em cent�metro
    $alturaCm = $rowEntrevistado['nr_altura'];   

    // Calcular IMC com os dados do entrevistado.
    $alturaMetros = $alturaCm/100;

    // C�lculo do IMC
    $imc = number_format($peso/pow($alturaMetros, 2), 1);

    $entrevistado = array(
        'peso' => $peso,
        'alturaCm' => $alturaCm,
        'sexo' => $rowEntrevistado['tp_sexo'],
        'dtNascimento' => $rowEntrevistado['dt_nascimento'],
        'idadeMeses' => getIdade($rowEntrevistado['dt_nascimento']),
        'imc' => $imc
    );

    return $entrevistado;
}
?>