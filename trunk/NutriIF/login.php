<?php

// Cabe�alho e menu da p�gina html.
require_once 'template/header.php';

?>

<!-- falta estabelcer a conex�o com o usu�rio no banco de dados-->
       <?php
        isset($_SESSION['erro_login']) ? $_SESSION['erro_login'] : VAZIO;
       ?> 
<div class="clear"></div>

<div id='centralizar'>
    <form action="trataLogin.php" method="POST" name="cadastro">
        
        <label for="nome"  > <em>*</em> Nome: 
            <input type="text" name="nome" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"/>
        </label>
        <label for="senha"  > <em>*</em> Senha: 
            <input type="password" name="senha" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"/>
        </label>    
        
    <input type="submit" value="Entrar" />
    </form>
</div>
    <div class="clear"></div>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>
