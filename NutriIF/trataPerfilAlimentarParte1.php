<?php
// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');



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
    
    /*
     *  Totalização da questão 4. Cada alternativa contém um grupo de alimentos
     * cada um tem um peso diferente, é passada a quantidade especiífica para
     * cada grupo, mas é feito um cálculo com cada um, aplicando os seus pesos
     */
    
    $pesoQuestao4_a = $questao4_a/3; 
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
    
    //Passando os dados para a variável de sessão
    
    session_start();
    $respostas = array();
    
    $respostas[1] = $quest1;
    $respostas[2] = $quest2;
    $respostas[3] = $quest3;
    $respostas[4] = $questao4_a;
    $respostas[5] = $questao4_b;
    $respostas[6] = $questao4_c;
    $respostas[7] = $questao4_d;

    //Armazenar os valores na sessão.
    session_start();
    $_SESSION['respostas'] = $respostas;
   
    header("location: formPerfilAlimentarParte2.php");    
} else {
    
    // Inserir valores na sessão em caso de erro.
    $_SESSION['quest1'] = $quest1;
    $_SESSION['quest2'] = $quest2;
    $_SESSION['quest3'] = $quest3;
    $_SESSION['quest4_a'] = $questao4_a;
    $_SESSION['quest4_b'] = $questao4_b;
    $_SESSION['quest4_c'] = $questao4_c;
    $_SESSION['quest4_d'] = $questao4_d;
    
    // Redirecionar para a mesma página
    header("location: formPerfilAlimentarParte1.php");
}

function validaFormPerfilAlimentarParte1() {
    
    $ehValido = true;
    $msgsErro = array();

    if (!ehPreenchido($_POST['quest1'])) {
         $msgErro = array('quest1' => "Selecione uma opção para a Questão 1");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest2'])) {
         $msgErro = array('quest2' => "Selecione uma opção para a Questão 2");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest3'])) {
         $msgErro = array('quest3' => "Selecione uma opção para a Questão 3");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }    
   
    if (!ehPreenchido($_POST['quest4_a']) && ehNumerico($_POST['quest4_a'])) {
         $msgErro = array('quest4_a' => "Preencha a quantidade de arroz, milho e outros cereais consumidos");
         array_push($msgsErro, $msgErro);
         
         $ehValido = false;
    }
    
    if (!ehPreenchido($_POST['quest4_b']) && !ehNumerico($_POST['quest4_b'])) {
         $msgErro = array('quest4_b' => "Preencha a quantidade de Pães consumidos");
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
