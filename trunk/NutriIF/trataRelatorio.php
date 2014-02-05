<?php
session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');

    $dao = new dao_class();

    $rowTodosEntrevistados = $dao->selectTodosEntrevistados();
    
    print_r($rowTodosEntrevistados);
   
   /* foreach ($array as $value) {
    

        
    }*/
    

    
    
    $_SESSION['qtd'] = $qtd;
    
    header("location: relatorio.php");

?>

