<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>Cadastro de Pesquisa</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <form action="trataCadastrarPesquisa.php" 
          method="POST"
          name="formCadastrarPesquisa">

        <label for="nome_pesquisa"> <em>*</em> Nome da pesquisa:
            <input type="text" name="nome_pesquisa" required onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['nome_pesquisa']) ? $_SESSION['nome_pesquisa'] : VAZIO) ?>"/>
        </label>

        <label for="dt_inicio"> <em>*</em> Data de início:
            <input type="date" name="dt_inicio"  required onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['dt_inicio']) ? $_SESSION['dt_inicio'] : VAZIO) ?>"/> 
        </label>
        
        <label for="dt_fim"> <em>*</em> Data de fim:
            <input type="date" name="dt_fim"  required onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['dt_fim']) ? $_SESSION['dt_fim'] : VAZIO) ?>"/> 
        </label>
        

        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form>
<?php
// Após preenchimento do formulário limpar as variáveis da sessão.   

?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
