<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
session_start();
?>

<?php
// Cabeçalho e menu da página html.
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
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) && sizeof($_SESSION['erro'])>0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataCalculaPercentilIMCIdade.php" method="POST">

        <label for="matricula"><em>*</em>Digite a matrícula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset(
                        $_SESSION['matricula']) ? 
                        $_SESSION['matricula']:VAZIO);?>"
            /> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
    <h1>
        <?php echo(isset($_SESSION['percentilMediano']) ? $_SESSION['percentilMediano']:VAZIO); ?>
        <?php echo(isset($_SESSION['percentilSuperior']) ? $_SESSION['percentilSuperior']:VAZIO); ?>
        <?php echo(isset($_SESSION['percentilInferior']) ? $_SESSION['percentilInferior']:VAZIO); ?>        
    </h1>
    
    <?php
        // Após preenchimento do formulário limpar as variáveis da sessão.   
        unset($_SESSION['matricula']);
        unset($_SESSION['erro']);
        unset($_SESSION['percentilMediano']);
        unset($_SESSION['percentilSuperior']);
        unset($_SESSION['percentilInferior']);
        
    ?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>