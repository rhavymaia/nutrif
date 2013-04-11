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
    </head>
    <body>
        <div id="content">
            <div id="cabecalho">
                <div id="logo">
                    <a href="#"><img src="img/logonutrif.png" wight="800" height="100"></a>
                </div>
            </div>
            <div id="menu">
                <ul>
                    <li><span><a href="index.php">Home</a></span></li>
                    <li class="pagina_atual"><a href="#">Formulário</a></li>
                </ul>
            </div>

            <div id="content">
                <ul>
                    <li>Realizado com sucesso</li>
                </ul>
            </div>

            <div id="rodape">
                <p>
                    IFPB - Instituto Federal de Educação, Ciência e Tecnologia
                    <em>Campina Grande</em>
                </p>
                <p>
                    Copyright (c) 2013. Todos os direitos Reservados.
                </p>
            </div>
        </div>
    </body>
</html>
