<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>Cadastro de Nutricionista</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <form action="trataCadastrarNutricionista.php" 
          method="POST"
          name="formCadastrarNutricionista">

        <label for="nome_nutri"> <em>*</em> Nome:
            <input type="text" name="nome_nutri" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['nome_nutri']) ? $_SESSION['nome_nutri'] : VAZIO) ?>"/>
        </label>

        <label for="instituicao"> <em>*</em> Instituição:
            <input type="text" name="instituicao"  onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['instituicao']) ? $_SESSION['instituicao'] : VAZIO) ?>"/> 
        </label>
        
        <label for="login"> <em>*</em> Login:
            <input type="text" name="login" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['login']) ? $_SESSION['login'] : VAZIO) ?>"/> 
        </label>
        
        <label for="senha1"> <em>*</em> Senha:
            <input type="password" name="senha1"/> 
        </label>
        <label for="senha2"> <em>*</em> Repetir senha:
            <input type="password" name="senha2"/> 
        </label>

        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form>
<?php
// Após preenchimento do formulário limpar as variáveis da sessão.   
unset($_SESSION['nome_nutri']);
unset($_SESSION['instituicao']);
unset($_SESSION['login']);
?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
