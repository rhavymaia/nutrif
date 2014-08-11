<?php

    session_start();
    
   // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    $nome_pesquisa = $_POST['nome_pesquisa'];
    $dt_inicio = $_POST['dt_inicio'];
    $dt_fim = $_POST['dt_fim'];
    
    
    $dao = new dao_class();
    
    $data_cadastro_pesquisa = array(
        'nm_pesquisa'=> $nome_pesquisa,
        'dt_inicio'=> $dt_inicio,
        'dt_fim'=> $dt_fim
    );
        
    $id_pesquisa = $dao->inserirPesquisa($data_cadastro_pesquisa);
    
?>
