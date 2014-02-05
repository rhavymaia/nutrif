<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('util/date.php');
require_once ('validate/validate.php');
require_once ('database/dao.class.php');


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
            echo TL_RELATORIO;
            ?>
        </h1>
        </p>
    </div>
</div>

<div class="container">
    <div id="relatorio">
        
     <form action="trataRelatorio.php" method="POST">
        <?php
            
            $dao = new dao_class();

            $rowTodosEntrevistados = $dao->selectEntrevistados();
            
            echo $rowTodosEntrevistados['nr_matricula'];
    
            /*
             *  Está aparecendo esse erro Rhavy: Fatal error: Call to undefined method dao_class::selectEntrevistados() in C:\wamp\www\NutrIF\relatorio.php on line 51
             * 
             */
            foreach ($rowTodosEntrevistados as $entrevistado) {
                 
                echo "Matricula: ".$entrevistado['nr_matricula'];
            }
            
            
        /*if (isset($_SESSION['qtd'])) {
                echo ("<p> Maiores de 19 anos: ".$_SESSION['qtd']."</p>"); 
                echo ("<p> Relação de Magreza: ".$_SESSION['qtdMagros']."</p>");
                echo ("<p> Relação de Eutrofia: ".$_SESSION['qtdEutroficos']."</p>");
                echo ("<p> Relação de Sobrepeso: ".$_SESSION['qtdSobrepeso']."</p>");
                echo ("<p> Relação de Obesidade: ".$_SESSION['qtdObesos']."</p>");
                echo ("<p> Relação de Obesidade Mórbida: ".$_SESSION['qtdObesosMorbidos']."</p>");
            }*/
        ?>

    </form>
    </div>
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>