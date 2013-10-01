<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
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
                    echo TL_LISTAGEM;              
                ?>
            </h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) && sizeof($_SESSION['erro']) > 0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataListagem.php" method="POST">

        <label for="matricula"><em>*</em>Digite a matrícula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" 
                   onBlur="this.className = 'normal'" value= "<?php echo(isset(
                        $_SESSION['matricula']) ? 
                        $_SESSION['matricula']:VAZIO);?>"
            /> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
    <div class="clear"></div>
    <div class="container">
        <div id="centralizares">
            <div class="caixa_azul">
        <?php        
            if (isset($_SESSION['peso'])){
                echo "<p>Peso: ".$_SESSION['peso']."</p>";
                if ($_SESSION['sexo']== 'F')
                    echo "<p>Sexo: Feminino</p>";
                else                     
                if ($_SESSION['sexo']== 'M')
                    echo "<p>Sexo: Masculino</p>";
                echo "<p>Nascimento: ".formata_data($_SESSION['dataNasc'])."</p>";
                echo "<p>Idade em meses: ".$_SESSION['idadeMeses']."</p>";
                
            }
           /* if (isset($_SESSION['informacoes'])){
                echo $_SESSION['informacoes'];
            }*/
            
            
                
        ?>       
    </div>
    </div>
    </div>
    
    <div class="container">
        <?php        
            
        ?>       
    </div>
    
    <?php
        // Após preenchimento do formulário limpar as variáveis da sessão.   
        unset($_SESSION['matricula']);
        unset($_SESSION['erro']);
        unset($_SESSION['peso']);
        unset($_SESSION['dataNasc']);
        unset($_SESSION['dataNasc']);
        
        
    ?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>

