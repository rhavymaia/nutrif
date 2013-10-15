<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
// Cabe�alho e menu da p�gina html.
require_once 'template/header.php';

if (!isset($_SESSION['id'])) {
    echo '<script language="javascript" type="text/javascript">';
    echo 'window.alert("�rea restrita, realize o Login!");';
    echo 'window.location.href="login.php";';
    echo '</script>';
}
?>

<?php
if (isset($_SESSION['id'])) {
    echo "<div class='caixa_login'>";
    echo "<div id='centralizar'>";
    echo "<img src='images/user.png'>Ol�, " . $_SESSION['id'];
    echo "<a href='logout.php'> &nbsp Logout</a>";
    echo "</div>";
    echo "</div>";
}
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

    <div class="clear"></div>
    <div class="container">
        <div id="centralizares">
            
            
                <?php
                if (isset($_SESSION['peso'])){
                    echo '<div class="caixa_azul">';
                echo "<p>Peso: " . $_SESSION['peso'] . "</p>";}
                if (isset($_SESSION['altura']))
                    echo "<p>Altura(cm): " . $_SESSION['altura'] . "</p>";
                if ((isset($_SESSION['sexo']) && ($_SESSION['sexo'] == 'F')))
                    echo "<p>Sexo: Feminino</p>";
                else
                if ((isset($_SESSION['sexo']) && ($_SESSION['sexo'] == 'M')))
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
                } else
                if (isset($_SESSION['imc']) && ($_SESSION['imc']))
                    echo "<p>IMC: " . $_SESSION['imc'] . "</p>";
                ?>       
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        ?>       
    </div>

    <?php
// Ap�s preenchimento do formul�rio limpar as vari�veis da sess�o.   
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
</div>
<div class="clear">
    <!-- Vazio -->
</div>
<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>

