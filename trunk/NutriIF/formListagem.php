<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
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
                    echo TL_LISTAGEM;              
                ?>
            </h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na valida��o -->
        <?php
            isset($_SESSION['erro']) && sizeof($_SESSION['erro']) > 0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataListagem.php" method="POST">

        <label for="matricula"><em>*</em>Digite a matr�cula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" 
                   onBlur="this.className = 'normal'" value= "<?php echo(isset(
                        $_SESSION['matricula']) ? 
                        $_SESSION['matricula']:VAZIO);?>"
            /> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
    <div class="container">
        <?php        
            
        ?>       
    </div>
    
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