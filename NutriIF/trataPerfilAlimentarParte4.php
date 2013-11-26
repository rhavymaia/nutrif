<?php

// Cabeчalho e menu da pсgina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');


$_SESSION['quest15'] = $_POST['quest15'];
$_SESSION['quest16'] = $_POST['quest16'];
$_SESSION['quest17'] = $_POST['quest17'];
$_SESSION['quest18'] = $_POST['quest18'];

if (validaFormPerfilAlimentarParte4()){

        $questao14_a = $_POST['quest14a'];
        $questao14_b = $_POST['quest14b'];
        $questao14_c = $_POST['quest14c'];
        $questao14_d = $_POST['quest14d'];
        $e = $_POST['quest14e'];
        $f = $_POST['quest14f'];
        
        $soma = $questao14_a + $questao14_b + $questao14_c + $questao14_d + $e + $f;

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
    
function validaFormPerfilAlimentarParte4() {
    
    $ehValido = true;
    $msgsErro = array();
        
   /* if (!ehPreenchido($_POST['quest14a']) 
            && !ehPreenchido($_POST['quest14b'])
            && !ehPreenchido($_POST['quest14c'])
            && !ehPreenchido($_POST['quest14d'])
            ) {
         $msgErro = array('quest14' => "Selecione uma opчуo ou mais para a Questуo 14");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }*/
    
    if (!ehPreenchido($_POST['quest15'])) {
         $msgErro = array('quest15' => "Selecione uma opчуo para a Questуo 15");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest16'])) {
         $msgErro = array('quest16' => "Selecione uma opчуo para a Questуo 16");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }    
   
    if (!ehPreenchido($_POST['quest17'])) {
         $msgErro = array('quest17' => "Selecione uma opчуo para a Questуo 17");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest18'])) {
         $msgErro = array('quest18' => "Selecione uma opчуo para a Questуo 18");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }    
    

    $_SESSION['erro'] = $msgsErro;
        
    return $ehValido;
}
?>