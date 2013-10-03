<?php
// Cabeçalho e menu da página html.
require_once ('template/header.php');
require_once ('util/constantes.php');
require_once ('validate/erro.php');
session_start();
?>
<div class="container">
    <div id="letras">
        <p>
            <h1>Login</h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            echo isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <div class="clear"></div>

    <div id='centralizar'>
        <form action="trataLogin.php" method="POST" name="cadastro">

            <label for="login"  > <em>*</em> Login: 
                <input type="text" name="login" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"/>
            </label>
            <label for="senha"  > <em>*</em> Senha: 
                <input type="password" name="senha" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"/>
            </label>    

            <input type="submit" value="Entrar" />
        </form>
    </div>
</div>
<div class="clear"></div>
<?php
//Erro da validação, sessão será destruída
unset($_SESSION['erro']);
?>

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
