<?php

// Cabeçalho e menu da página html.
require_once 'template/header.php';

?>

<!-- falta estabelcer a conexão com o usuário no banco de dados-->
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
// Rodapé da página html.
require_once 'template/footer.php';
?>
