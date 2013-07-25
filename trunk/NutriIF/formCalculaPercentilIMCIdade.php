<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
session_start();
?>

<?php
// Cabe�alho e menu da p�gina html.
require_once 'template/header.php';
?> 

<div class="container">
    <div id="letras">
        <p>
            <h1>
                <?php            
                    echo TL_CALCULA_PERCENTIL;                
                ?>
            </h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na valida��o -->
        <?php
            isset($_SESSION['erro']) ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataCalculaPercentilIMCIdade.php" method="POST">

        <label for="matricula"><em>*</em>Digite a matr�cula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset(
                        $_SESSION['matricula']) ? 
                        $_SESSION['matricula']:VAZIO);?>"
            /> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
    <h1>
        <?php echo(isset($_SESSION['percentil']) ? $_SESSION['percentil']:VAZIO); ?>
    </h1>
    
    <?php
        // Ap�s preenchimento do formul�rio limpar as vari�veis da sess�o.   
        unset($_SESSION['matricula']);
        unset($_SESSION['erro']);
        
    ?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>
<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>