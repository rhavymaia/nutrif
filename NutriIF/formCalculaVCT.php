<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
// Cabe�alho e menu da p�gina html.
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
        <!-- Lista de erros na valida��o -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataCalculaVCT.php" method="POST">
        <label for="matricula">
            <em>*</em>Digite a matr�cula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className='select'" onBlur="this.className='normal'" 
                   value="<?php echo(isset($_SESSION['matricula']) ? $_SESSION['matricula'] : VAZIO);?>"/>
        </label>
        
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
</div>
<div id="centralizar">    
    <?php
        if (isset($_SESSION['vct'])) {
            echo '<div class="caixa_azul">';
            //procurar fun��o para formatar sa�da desse valor
            echo "<p>Valor Cal�rico Total (VCT): " .number_format($_SESSION['vct'],2,',','.') . " cal/dia</p>";
            echo '</div>';
        }
    ?>
</div>

<?php
    // Ap�s preenchimento do formul�rio limpar as vari�veis da sess�o.
    unset($_SESSION['vct']);
    unset($_SESSION['erro']);
?>

<?php
    // Rodap� da p�gina html.
    require_once 'template/footer.php';
?>
