<?php

// Cabe�alho e menu da p�gina html.
require_once 'template/header.php';

?>

<!-- falta estabelcer a conex�o com o usu�rio no banco de dados-->

<html>
       <?php
        isset($_SESSION['erro_login']) ? $_SESSION['erro_login'] : VAZIO;
       ?> 
    <form action="trataLogin.php" method="POST" name="cadastro">
        
        Nome: <input type="text" name="nome"/>
        Senha: <input type="password" name="senha" />
        
    <input type="submit" value="enviar" /></form>
       
</html>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>
