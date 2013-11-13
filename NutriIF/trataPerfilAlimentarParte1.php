<?php

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$_SESSION['quest1'] = $_POST['quest1'];
$_SESSION['quest2'] = $_POST['quest2'];
$_SESSION['quest3'] = $_POST['quest3'];

$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_POST['d'];

$ra = $a/3;
$rb = $b/2;
$rc = $c/1;
$rd = $d/6;

$som = $ra + $rb + $rc + $rd;

$_SESSION['quest4'] = 0;
if ($som<3){
    $_SESSION['quest4'] = 1;
}
if (($som>=3) && ($som<=4.4)){
    $_SESSION['quest4'] = 2;
}
if (($som>=4.5) && ($som<=7.5)){
    $_SESSION['quest4'] = 3;
}
if ($som>7.5){
    $_SESSION['quest4'] = 4;
}


header("location: formPerfilAlimentarParte2.php");
?>
