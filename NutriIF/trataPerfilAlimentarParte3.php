<?php

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$_SESSION['quest10'] = $_POST['quest10'];
$_SESSION['quest11'] = $_POST['quest11'];
$_SESSION['quest12'] = $_POST['quest12'];
$_SESSION['quest13'] = $_POST['quest13'];

    if (ehPreenchido($_SESSION['quest10'])
        && ehPreenchido($_SESSION['quest11'])
        && ehPreenchido($_SESSION['quest12'])
        && ehPreenchido($_SESSION['quest13'])){

    header("location: formPerfilAlimentarParte4.php");
    }else{
        header("location: formPerfilAlimentarParte3.php");
    }
?>