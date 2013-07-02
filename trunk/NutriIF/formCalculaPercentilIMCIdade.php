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
        <p>-
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
        //isset($_SESSION['erro'])? showListErro($_SESSION['erro']): VAZIO;
        isset($_SESSION['erro']) ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="TrataCalculaPercentilIMCidade.php" method="POST">

        <label for="MatriculaDeBusca"> <em>*</em> Digite a matrícula a ser procurada:
            <input type="text" name="MatriculaDeBusca" value= "
                <?php echo(isset(
                        $_SESSION['MatriculaDeBusca']) ? 
                        $_SESSION['MatriculaDeBusca'] : 
                    VAZIO); ?>"
            /> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
    <?php
    // Após preenchimento do formulário limpar as variáveis da sessão.   
    unset($_SESSION['MatriculaDeBusca']);
    unset($_SESSION['erro']);
    ?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>