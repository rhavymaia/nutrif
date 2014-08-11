<?php
    require_once 'template/header.php';
?> 
<?php

    
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == TRUE) {
        echo "<div class='caixa_login'>";
        echo "<div id='centralizar'>";
        echo "<img src='images/user.png'>Olá, " 
            .(isset($_SESSION['id']) ? $_SESSION['id'] : VAZIO);
        echo "<a href='logout.php'> &nbsp Logout</a>";
        echo "</div>";
        echo "</div>";
    } else {
        echo '<script language="javascript" type="text/javascript">';
        echo 'window.alert("Área restrita, realize o Login!");';
        echo 'window.location.href="formLogin.php";';
        echo '</script>';
    }
?> 