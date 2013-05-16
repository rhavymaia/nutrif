<?php
    require_once ('util/constantes.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>
            <?php            
                echo PF_TITULO;                
            ?>
        </title>
        
        <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
        <script language="javascript" src="javascript/validacao.js"></script> 
        
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    </head>
    
    <body>
        
        <div id="container">
            <div id="cabecalho">
                <div id="logo">
                    <a href="#"><img src="img/logonutrif.png" wight="800" height="100"></a>
                </div>
            </div>

            <div id="menu">
                <ul>
                    <li><span><a href="index.php">Home</a></span></li>
                    <li class="pagina_atual"><a href="formRegistroAntropometrico.php">Formulário</a></li>
                    <li class="pagina_atual"><a href="formCalculaPercentilIMCIdade.php">Formulário</a></li>
                </ul>
            </div>
