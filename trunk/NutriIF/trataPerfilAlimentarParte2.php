<?php

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$_SESSION['quest5'] = $_POST['quest5'];
$_SESSION['quest6'] = $_POST['quest6'];
$_SESSION['quest7'] = $_POST['quest7'];
$_SESSION['quest8'] = $_POST['quest8'];

if (verificaAlternativa($_SESSION['quest5'])
    && verificaAlternativa($_SESSION['quest6'])
    && verificaAlternativa($_SESSION['quest7'])
    && verificaAlternativa($_SESSION['quest8'])){

        if (isset($_SESSION['quest8']) && $_SESSION['quest8'] == 0){
            $_SESSION['quest9'] = 0;
        }else{
            $_SESSION['quest9'] = $_POST['quest9'];
        }

        header("location: formPerfilAlimentarParte3.php");
    }else{
        header("location: formPerfilAlimentarParte2.php");
    }
?>
