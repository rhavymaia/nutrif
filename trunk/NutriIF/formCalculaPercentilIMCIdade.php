<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
// Cabeçalho e menu da página html.
require_once ('template/headerForm.php');
?> 

<div class="container">
    <div id="letras">
        <h1>
            <?php
            echo TL_CALCULA_PERCENTIL;
            ?>
        </h1>
    </div>
    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <form action="trataCalculaPercentilIMCIdade.php" method="POST">
        <label for="matricula"><em>*</em>Digite a matrícula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" 
                   value= "<?php echo(isset($_SESSION['matricula']) ? $_SESSION['matricula'] : VAZIO); ?>"/> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>

</div>

<div id="centralizar">
<?php

if (isset($_SESSION['imc'])) {
    echo('<div class="caixa_azul">');
    if (isset($_SESSION['percentilMediano']) || isset($_SESSION['percentilSuperior']) 
            || isset($_SESSION['percentilInferior'])) {
        
                if ($_SESSION['percentilMediano']) {
                    echo("Percentil: " . $_SESSION['percentilMediano']);
                } else if ($_SESSION['percentilSuperior'] || $_SESSION['percentilInferior']) {
                    if ($_SESSION['percentilSuperior'])
                        echo("<p> Percentil Superior: " . $_SESSION['percentilSuperior'] . "</p>");
                    if ($_SESSION['percentilInferior'])
                        echo("<p> Percentil Inferior: " . $_SESSION['percentilInferior'] . "</p>");               
                    } 
                echo $_SESSION['perfilPercentil'];                
            }else if ($_SESSION['idadeMeses'] > IDADE_PERCENTIL_19){
                echo ("<p>Aluno acima de 19 anos. </p>");
                echo ("<p>Valor de imc: " . $_SESSION['imc'] . "</p>");
                echo ("<p> Situação: " . $_SESSION['perfilIMC'] . "</p>");
            }else{
                echo '<script language="javascript" type="text/javascript">';
                    echo 'window.alert("Percentil não encontrado. Verifique se as medidas antropométricas são válidas para um caso real!");';  
                    echo 'window.location.href="formCalculaPercentilIMCIdade.php";';
                    echo '</script>'; 
            }
        } else {
            echo(isset($_SESSION['matricula']) ? "": VAZIO);
        echo '</div>';
    }


?>       
</div>
<?php
    // Após preenchimento do formulário limpar as variáveis da sessão.    
    unset($_SESSION['erro']);
    unset($_SESSION['matricula']);
    unset($_SESSION['imc']);
    unset($_SESSION['sexo']);
    unset($_SESSION['percentilMediano']);
    unset($_SESSION['percentilSuperior']);
    unset($_SESSION['percentilInferior']);
    unset($_SESSION['situacao']);
?>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
