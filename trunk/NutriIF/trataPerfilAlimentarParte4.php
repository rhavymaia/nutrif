<?php

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$a = $_POST['quest14a'];
$b = $_POST['quest14b'];
$c = $_POST['quest14c'];
$d = $_POST['quest14d'];
$e = $_POST['quest14e'];
$f = $_POST['quest14f'];

$soma = $a + $b + $c + $d + $e + $f;

if ($soma < 3){
    $_SESSION['quest14'] = 0;
}
if ($soma == 3 || $soma == 4){
    $_SESSION['quest14'] = 2;
}
if ($soma == 5 || $soma == 6){
    $_SESSION['quest14'] = 3;
}

$_SESSION['quest15'] = $_POST['quest15'];
$_SESSION['quest16'] = $_POST['quest16'];
$_SESSION['quest17'] = $_POST['quest17'];
$_SESSION['quest18'] = $_POST['quest18'];



/*header("location: formPerfilAlimentarParte4.php");*/
?>