<?php
require_once ('util/constantes.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>
            <?php
            echo PF_TITULO;
            ?>
        </title>        
        <script language="javascript" src="javascript/validacao.js"></script> 
        <script language="javascript" src="javascript/alerta.js"></script>

        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    </head>
    <body>
        <div id="top">
            <div class="container">
                <div id="logo"><a href="index.php"><img src="images/logo.png" ></a></div>
                <ul id="menu">
                    <li>
                        <a href="index.php">
                            <img src="images/home.png">  Home
                        </a>
                    </li>

                    <?php
                    
                        session_start();

                        if (isset($_SESSION['logado']) && $_SESSION['logado'] == TRUE) {
                            echo '<li>
                                        <a href="formRegistroAntropometrico.php">
                                            <img src="images/cadas.png">  Cadastro Antropométrico
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formCalculaPercentilIMCIdade.php">
                                            <img src="images/calc.png">  Cálculo do Percentil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formListagem.php">
                                            <img src="images/list.png">  Listagem
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formCalculaVCT.php">
                                            <img src="images/list.png">  VCT
                                        </a>
                                    </li>
                                    <li>
                                        <a href="relatorio.php">
                                            <img src="images/list.png">  Relatório
                                        </a>
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <img src="images/locked.png">  Logout
                                        </a>
                                    </li>';
                        } else {
                            echo'<li>
                                    <a href="login.php">
                                        <img src="images/unlocked.png">  Login
                                    </a>
                                </li>';
                        }
                    ?>
                </ul>
                <div class="clear">
                    <!-- Vazio -->
                </div>
            </div>
        </div>
        <div id="content">
