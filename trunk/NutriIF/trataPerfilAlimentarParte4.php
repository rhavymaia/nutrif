<?php

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$_SESSION['quest15'] = $_POST['quest15'];
$_SESSION['quest16'] = $_POST['quest16'];
$_SESSION['quest17'] = $_POST['quest17'];
$_SESSION['quest18'] = $_POST['quest18'];

if (ehPreenchido($_SESSION['quest15'])
    && ehPreenchido($_SESSION['quest16'])
    && ehPreenchido($_SESSION['quest17'])
    && ehPreenchido($_SESSION['quest18'])){

        $questao4_a = $_POST['quest14a'];
        $questao4_b = $_POST['quest14b'];
        $questao4_c = $_POST['quest14c'];
        $questao4_d = $_POST['quest14d'];
        $e = $_POST['quest14e'];
        $f = $_POST['quest14f'];
        
        $soma = $questao4_a + $questao4_b + $questao4_c + $questao4_d + $e + $f;

        if ($soma < 3){
            $_SESSION['quest14'] = 0;
        }
        if ($soma == 3 || $soma == 4){
            $_SESSION['quest14'] = 2;
        }
        if ($soma == 5 || $soma == 6){
            $_SESSION['quest14'] = 3;
        }

        $resultadofinal = $_SESSION['quest1'] + $_SESSION['quest2'] + 
                $_SESSION['quest3'] + $_SESSION['quest4'] + 
                $_SESSION['quest5'] + $_SESSION['quest6'] + 
                $_SESSION['quest7'] + $_SESSION['quest8'] + 
                $_SESSION['quest9'] + $_SESSION['quest10'] + 
                $_SESSION['quest11'] + $_SESSION['quest12'] + 
                $_SESSION['quest13'] + $_SESSION['quest14'] + 
                $_SESSION['quest15'] + $_SESSION['quest16'] + 
                $_SESSION['quest17'] + $_SESSION['quest18'];
                $_SESSION['resultado'] = $resultadofinal;

        header("location: resultadoFinalQuestionario.php");
}else{
        header("location: formPerfilAlimentarParte4.php");
    }
?>