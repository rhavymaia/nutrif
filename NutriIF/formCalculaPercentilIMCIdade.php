<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
// Cabeçalho e menu da página html.
require_once 'template/header.php';

if (!isset($_SESSION['id'])) {
    echo '<script language="javascript" type="text/javascript">';
    echo 'window.alert("Área restrita, realize o Login!");';
    echo 'window.location.href="login.php";';
    echo '</script>';
}
?>

<?php
if (isset($_SESSION['id'])) {
    echo "<div class='caixa_login'>";
    echo "<div id='centralizar'>";
    echo "<img src='images/user.png'>Olá, " . $_SESSION['id'];
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
            echo TL_CALCULA_PERCENTIL;
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
    <form action="trataCalculaPercentilIMCIdade.php" method="POST">

        <label for="matricula"><em>*</em>Digite a matrícula a ser procurada:
            <input type="text" name="matricula" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php
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
            if (isset($_SESSION['existe'])) {
                echo '<div class="caixa_azul">';
                if (isset($_SESSION['percentilMediano']) || isset($_SESSION['percentilSuperior']) || isset($_SESSION['percentilInferior'])) {
                    if ($_SESSION['percentilMediano']) {
                        echo("Percentil: " . $_SESSION['percentilMediano']);
                    } else if ($_SESSION['percentilSuperior'] || $_SESSION['percentilInferior']) {
                        if ($_SESSION['percentilSuperior'])
                            echo("<p> Percentil Superior: " . $_SESSION['percentilSuperior'] . "</p>");
                        if ($_SESSION['percentilInferior'])
                            echo("<p> Percentil Inferior: " . $_SESSION['percentilInferior'] . "</p>");
                    } else {
                        echo("Nenhum valor encontrado");
                    }
                } else if (isset($_SESSION['imc']) && $_SESSION['imc']) {
                    echo ("<p>Aluno acima de 19 anos. </p>");
                    echo ("<p>Valor de imc: " . $_SESSION['imc'] . "</p>");
                    echo ("<p> Situação: " . $_SESSION['perfilIMC'] . "</p>");
                }
            }
            ?>       
        </div>
    </div>
</div>
<?php
// Após preenchimento do formulário limpar as variáveis da sessão. 
unset($_SESSION['existe']);
unset($_SESSION['matricula']);
unset($_SESSION['erro']);
unset($_SESSION['percentilMediano']);
unset($_SESSION['percentilSuperior']);
unset($_SESSION['percentilInferior']);
unset($_SESSION['imc']);
unset($_SESSION['sexo']);
?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>