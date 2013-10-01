<?php

session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');

    
    $matricula = $_POST['matricula'];

    $dados = capturarDados($matricula);
    
     $_SESSION['peso'] = $dados['peso'];
     $_SESSION['altura'] = $dados['alturaCm'];
     $_SESSION['sexo'] = $dados['sexo'];
     $_SESSION['dataNasc'] = $dados['dtNascimento'];
     $_SESSION['idadeMeses'] = $dados['idadeMeses'];
     $_SESSION['informacoes'] = $dados;
     header("location: formListagem.php");
     
?>
	