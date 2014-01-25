<?php

// Cabeчalho e menu da pсgina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


session_start();

$_SESSION['quest10'] = $_POST['quest10'];
$_SESSION['quest11'] = $_POST['quest11'];
$_SESSION['quest12'] = $_POST['quest12'];
$_SESSION['quest13'] = $_POST['quest13'];

    if (validaFormPerfilAlimentarParte3()){

    header("location: formPerfilAlimentarParte4.php");
    
    //Passando os dados para a variсvel de sessуo
    
    session_start();
    $respostas = $_SESSION['respostas'];

    $respostas[13] = $_SESSION['quest10'];
    $respostas[14] = $_SESSION['quest11'];
    $respostas[15] = $_SESSION['quest12'];
    $respostas[16] = $_SESSION['quest13'];

    session_start();
    $_SESSION['respostas'] = $respostas;
     header("location: formPerfilAlimentarParte4.php");
    }else{
        header("location: formPerfilAlimentarParte3.php");
    }
    
 function validaFormPerfilAlimentarParte3() {
    
    $ehValido = true;
    $msgsErro = array();

    if (!ehPreenchido($_POST['quest10'])) {
         $msgErro = array('quest10' => "Selecione uma opчуo para a Questуo 10");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest11'])) {
         $msgErro = array('quest11' => "Selecione uma opчуo para a Questуo 11");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest12'])) {
         $msgErro = array('quest12' => "Selecione uma opчуo para a Questуo 12");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }    
   
    if (!ehPreenchido($_POST['quest13'])) {
         $msgErro = array('quest13' => "Selecione uma opчуo para a Questуo 13");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
       

    $_SESSION['erro'] = $msgsErro;
        
    return $ehValido;
}
?>