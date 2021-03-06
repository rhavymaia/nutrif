<?php
// Cabe�alho e menu da p�gina html.
require_once ('template/headerLogin.php');
require_once ('util/constantes.php');
require_once ('validate/erro.php');
?>
<div class="container">
    <div id="letras">
        <h1>Login</h1>
    </div>
    <ul id="erro">
        <!-- Lista de erros na valida��o -->
        <?php
        echo isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <div id="centralizar">
    <form action="trataLogin.php" method="POST" name="cadastro">

        <label for="login"> <em>*</em> Login: 
            <input type="text" name="login" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"/>
        </label><div class="clear"></div>
        <label for="senha"> <em>*</em> Senha: 
            <input type="password" name="senha" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"/>
        </label>    
            <div class="clear"></div>
        <input type="submit" value="Entrar" />
        <input type="reset" value="Limpar" />
        
    </form>
    </div>
</div>

<?php
//Erro da valida��o, sess�o ser� destru�da
    unset($_SESSION['erro']);
?>

<?php
// Rodap� da p�gina html.
    require_once 'template/footer.php';
?>
