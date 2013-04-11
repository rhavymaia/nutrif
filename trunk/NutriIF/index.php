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
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    </head>

    <body>
        <div id="container">
            <div id="cabecalho">
                <div id="logo">
                    <a href="#"><img src="img/logonutrif.png" wight="800" height="100"></a>
                </div>
                <br><br>
            </div>
            
            <div id="menu">
                <ul>
                    <li class="pagina_atual">
                        <span>
                            <a href="#">Home</a>
                        </span>
                    </li>
                    <li><a href="formRegistroAntropometrico.php">Formul�rio</a></li>
                </ul>
            </div>

            <div id="content">
                <div id="bar_lat"> 
                    <img src="img/Prato.jpg"><br><br>
                </div>
                
                <img src="img/mensagem.jpg">
            </div>

            <div id="rodape">
                 <p>
                    IFPB - Instituto Federal de Educa��o, Ci�ncia e Tecnologia
                    <em>Campina Grande</em>
                </p>
                <p>
                    Copyright (c) 2013. Todos os direitos Reservados.
                </p>
            </div>
        </div>
    </body>
</html>
