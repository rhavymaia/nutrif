<?php

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$quest5 = $_POST['quest5'];
$quest6 = $_POST['quest6'];
$quest7 = $_POST['quest7'];
$quest8 = $_POST['quest8'];
$quest9 = $_POST['quest9'];

if (ehPreenchido($quest5) 
        && ehPreenchido($quest6) 
        && ehPreenchido($quest7) 
        && ehPreenchido($quest8)) {

    $_SESSION['quest5'] = $quest5;
    $_SESSION['quest6'] = $quest6;
    $_SESSION['quest7'] = $quest7;
    $_SESSION['quest8'] = $quest8;

    if ($quest8!=0){
        $_SESSION['quest9'] = $quest9;
    } else {
        $_SESSION['quest9'] = 0;
    }

    header("location: formPerfilAlimentarParte3.php");
} else {
    
    // Inserir valores na sessão em caso de erro.
    $_SESSION['quest6'] = $quest6;
    $_SESSION['quest7'] = $quest7;
    $_SESSION['quest8'] = $quest8;
    $_SESSION['quest9'] = $questao8!=0 ? $quest9 : VAZIO;
    
    // Redirecionar para a mesma página
    header("location: formPerfilAlimentarParte2.php");
}
?>
