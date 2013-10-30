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

    $total = mysql_num_rows($rowTodosEntrevistados);
    $qtd = 0;
    while($row = mysql_fetch_array($rowTodosEntrevistados)){
        
        $dados = capturarDados($row['nr_matricula']);
        
        if ($dados['idadeMeses'] > IDADE_PERCENTIL_19){
            $qtd++;
        }        
    }
    
    $_SESSION['qtd'] = $qtd;
    
    header("location: relatorio.php");

?>

