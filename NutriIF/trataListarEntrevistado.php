<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');

$matricula = $_POST['matricula'];

$dados = consultarEntrevistado($matricula);

if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);

    // Verificar se a checagem n�o gera problemas de tipo.
    if ($rowEntrevistado) {

        $_SESSION['peso'] = $dados['peso'];
        $_SESSION['altura'] = $dados['alturaCm'];
        $_SESSION['sexo'] = $dados['sexo'];
        $_SESSION['dataNasc'] = $dados['dtNascimento'];
        $_SESSION['idadeMeses'] = $dados['idadeMeses'];
        $_SESSION['existe'] = TRUE;

        header("location: formListarEntrevistado.php");
    } else {
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formListarEntrevistado.php");
    }
} else {
    $msg = ("Informe uma matr�cula v�lida. Somente n�mero s�o permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formListarEntrevistado.php");
}
?>
	