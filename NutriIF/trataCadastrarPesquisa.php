<?php

    session_start();
    
  //  $cURL = v1_init("192.168.1.146/NutrIF_service");
    
    
   // Importação
  
    /*
    $cURL = curl_init('http://localhost/WebServer/getComentario');
		
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

    $resultado = curl_exec($cURL);

    curl_close($cURL);*/
    
    
    
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    $nome_pesquisa = $_POST['nome_pesquisa'];
    $dt_inicio = $_POST['dt_inicio'];
    $dt_fim = $_POST['dt_fim'];
    
    $res = $c->post(
    'http://localhost/NutrIF_service/CadastraPesquisa', json_encode(array('nome' => 'nome_pesquisa', 'inicio' => 'dt_inicio', 'fim' => 'dt_fim'))
    );
    // Elias
    
  /*  $dao = new dao_class();
    
    $data_cadastro_pesquisa = array(
        'nm_pesquisa'=> $nome_pesquisa,
        'dt_inicio'=> $dt_inicio,
        'dt_fim'=> $dt_fim
    );
    
    $id_pesquisa = $dao->inserirPesquisa($data_cadastro_pesquisa);*/
    
     if (ehNumerico($id_pesquisa)) {

                 echo '<script language="javascript" type="text/javascript">';
                 echo 'window.alert("Pesquisa cadastrada com sucesso!");';  
                 echo 'window.location.href="index.php";';
                 echo '</script>';
            } else {  
                header("location: mensagem_erro.php");          
            }     
    
?>
