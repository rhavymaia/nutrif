<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
// Cabeçalho e menu da página html.
require_once 'template/headerForm.php';
?> 

<div class="container">
    <div id="letras">
        <h1>
            <?php
                echo TL_LISTAGEM;
            ?>
        </h1>
    </div>
    
    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
        isset($_SESSION['erro']) && sizeof($_SESSION['erro']) > 0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    
    <form action="trataListarEntrevistado.php" method="POST">

        <label for="matricula"><em>*</em>Digite a matrícula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" 
                   onBlur="this.className = 'normal'" value= "<?php
                   echo(isset(
                           $_SESSION['matricula']) ?
                           $_SESSION['matricula'] : VAZIO);
                   ?>"
                   /> 
        </label>
        <input type="submit" value="Buscar"/>
        <input type="reset" value="Limpar"/>
    </form>
</div>

<div class="caixa_azul">
    <?php
    if (isset($_SESSION['imc'])) {
        /*echo '<div class="caixa_azul">';*/
        if (isset($_SESSION['peso'])) {
            echo "<p>Peso: " . $_SESSION['peso'] . "</p>";
        }
        if (isset($_SESSION['altura']))
            echo "<p>Altura(cm): " . $_SESSION['altura'] . "</p>";
        if ((isset($_SESSION['sexo']) && ($_SESSION['sexo'] == 'F')))
            echo "<p>Sexo: Feminino</p>";
        else if ((isset($_SESSION['sexo']) && ($_SESSION['sexo'] == 'M')))
            echo "<p>Sexo: Masculino</p>";
        if (isset($_SESSION['dataNasc']))
            echo "<p>Nascimento: " . formata_data($_SESSION['dataNasc']) . "</p>";
        if (isset($_SESSION['idadeMeses']))
            echo "<p>Idade em meses: " . $_SESSION['idadeMeses'] . "</p>";

        if (isset($_SESSION['percentilMediano']) || isset($_SESSION['percentilSuperior']) || isset($_SESSION['percentilInferior'])) {
            if ($_SESSION['percentilSuperior']) {
                echo "<p>Percentil Superior: " . $_SESSION['percentilSuperior'] . "</p>";
            }
            if ($_SESSION['percentilInferior']) {
                echo "<p>Percentil Inferior: " . $_SESSION['percentilInferior'] . "</p>";
            }
            if ($_SESSION['percentilMediano']) {
                echo "<p>Percentil Mediano: " . $_SESSION['percentilMediano'] . "</p>";
            }
        } else if (isset($_SESSION['imc']) && ($_SESSION['imc']))
            echo "<p>IMC: " . $_SESSION['imc'] . "</p>";
    }
    ?>       
</div>

<?php
    // Após preenchimento do formulário limpar as variáveis da sessão.
    unset($_SESSION['matricula']);
    unset($_SESSION['erro']);
    unset($_SESSION['peso']);
    unset($_SESSION['altura']);
    unset($_SESSION['sexo']);
    unset($_SESSION['dataNasc']);
    unset($_SESSION['idadeMeses']);
    unset($_SESSION['percentilMediano']);
    unset($_SESSION['percentilSuperior']);
    unset($_SESSION['percentilInferior']);
    unset($_SESSION['imc']);
?>

<?php
    // Rodapé da página html.
    require_once 'template/footer.php';
?>

