<?php

// Cabe�alho e menu da p�gina html.
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

if (validaFormPerfilAlimentarParte2()) {

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
    
    // Inserir valores na sess�o em caso de erro.
    $_SESSION['quest6'] = $quest6;
    $_SESSION['quest7'] = $quest7;
    $_SESSION['quest8'] = $quest8;
    $_SESSION['quest9'] = $questao8!=0 ? $quest9 : VAZIO;
    
    // Redirecionar para a mesma p�gina
    header("location: formPerfilAlimentarParte2.php");
}


function validaFormPerfilAlimentarParte2() {
    
    $ehValido = true;
    $msgsErro = array();

    if (!ehPreenchido($_POST['quest5'])) {
         $msgErro = array('quest5' => "Selecione uma op��o para a Quest�o 5");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest6'])) {
         $msgErro = array('quest6' => "Selecione uma op��o para a Quest�o 6");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest7'])) {
         $msgErro = array('quest7' => "Selecione uma op��o para a Quest�o 7");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }    
   
    if (!ehPreenchido($_POST['quest8'])) {
         $msgErro = array('quest8' => "Selecione uma op��o para a Quest�o 8");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest9']) && $_SESSION['quest8'] != 0) {
         $msgErro = array('quest9' => "Selecione uma op��o para a Quest�o 9");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    $_SESSION['erro'] = $msgsErro;
        
    return $ehValido;
}
?>
