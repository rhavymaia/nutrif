<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
// Cabeçalho e menu da página html.
require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <h1>
            <?php
                echo TL_CALCULO_VCT;
            ?>
        </h1>
    </div>
    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) && sizeof($_SESSION['erro']) > 0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataCalculaVCT.php" method="POST">
        <label for="matricula">
            <em>*</em>Digite a matrícula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className='select'" onBlur="this.className='normal'" 
                   value="<?php echo(isset($_SESSION['matricula']) ? $_SESSION['matricula'] : VAZIO);?>"/>
        </label>
        
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
</div>

<div class="caixa_azul">     
    <?php
        if (isset($_SESSION['vct'])) {
            echo "<p>Valor Calórico Total (VCT): " . $_SESSION['vct'] . "</p>";
        }
    ?>
</div>

<?php
    // Após preenchimento do formulário limpar as variáveis da sessão.
    unset($_SESSION['vct']);
    unset($_SESSION['erro']);
?>

<?php
    // Rodapé da página html.
    require_once 'template/footer.php';
?>
