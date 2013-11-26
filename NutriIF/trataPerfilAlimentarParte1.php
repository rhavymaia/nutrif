<?php
// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

session_start();

$quest1 = $_POST['quest1'];
$quest2 = $_POST['quest2'];
$quest3 = $_POST['quest3'];
$questao4_a = $_POST['quest4_a'];
$questao4_b = $_POST['quest4_b'];
$questao4_c = $_POST['quest4_c'];
$questao4_d = $_POST['quest4_d'];

if (validaFormPerfilAlimentarParte1()) {

    $_SESSION['quest1'] = $quest1;
    $_SESSION['quest2'] = $quest2;
    $_SESSION['quest3'] = $quest3;
    
    // Totaliza��o da quest�o 4.
    $pesoQuestao4_a = $questao4_a/3; //TODO: qual o significado desses pesos?
    $pesoQuestao4_b = $questao4_b/2;
    $pesoQuestao4_c = $questao4_c/1;
    $pesoQuestao4_d = $questao4_d/6;

    $totalPesoQuestao4 = $pesoQuestao4_a + $pesoQuestao4_b 
            + $pesoQuestao4_c + $pesoQuestao4_d;   
    
    if ($totalPesoQuestao4 > 7.5) {
        $_SESSION['quest4'] = 4;
    } else if ($totalPesoQuestao4 >= 4.5) {
        $_SESSION['quest4'] = 3;
    } else if ($totalPesoQuestao4 >= 3) {
        $_SESSION['quest4'] = 2;
    } else if ($totalPesoQuestao4 < 3) {
        $_SESSION['quest4'] = 1;
    } else {
        $_SESSION['quest4'] = 0;
    }
    
    header("location: formPerfilAlimentarParte2.php");    
} else {
    
    // Inserir valores na sess�o em caso de erro.
    $_SESSION['quest1'] = $quest1;
    $_SESSION['quest2'] = $quest2;
    $_SESSION['quest3'] = $quest3;
    $_SESSION['quest4_a'] = $questao4_a;
    $_SESSION['quest4_b'] = $questao4_b;
    $_SESSION['quest4_c'] = $questao4_c;
    $_SESSION['quest4_d'] = $questao4_d;
    
    // Redirecionar para a mesma p�gina
    header("location: formPerfilAlimentarParte1.php");
}

function validaFormPerfilAlimentarParte1() {
    
    $ehValido = true;
    $msgsErro = array();

    if (!ehPreenchido($_POST['quest1'])) {
         $msgErro = array('quest1' => "Selecione uma op��o para a Quest�o 1");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest2'])) {
         $msgErro = array('quest2' => "Selecione uma op��o para a Quest�o 2");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest3'])) {
         $msgErro = array('quest3' => "Selecione uma op��o para a Quest�o 3");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }    
   
    if (!ehPreenchido($_POST['quest4_a']) && ehNumerico($_POST['quest4_a'])) {
         $msgErro = array('quest4_a' => "Preencha a quantidade de arroz, milho e outros cereais consumidos");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest4_b']) && !ehNumerico($_POST['quest4_b'])) {
         $msgErro = array('quest4_b' => "Preencha a quantidade de P�es consumidos");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest4_c']) && !ehNumerico($_POST['quest4_c'])) {
         $msgErro = array('quest4_c' => "Preencha a quantidade de bolos sem cobertura e/ou recheio consumidos");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest4_d']) && !ehNumerico($_POST['quest4_d'])) {
         $msgErro = array('quest4_d' => "Preencha a quantidade de biscoito ou bolacha sem recheio consumidos");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }   
    
    $_SESSION['erro'] = $msgsErro;
        
    return $ehValido;
}
?>
