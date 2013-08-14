<?php

// Cabeçalho e menu da página html.
require_once 'template/header.php';

?>

<!-- falta estabelcer a conexão com o usuário no banco de dados-->

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
// Rodapé da página html.
require_once 'template/footer.php';
?>
