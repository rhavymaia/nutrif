<?php
// Cabe�alho e menu da p�gina html.
require_once 'template/header.php';

if (isset($_SESSION['id'])) {
    echo "<div class='caixa_login'>";
    echo "<div id='centralizar'>";
    echo "<img src='images/user.png'>Ol�, " . $_SESSION['id'];
    echo "<a href='logout.php'> &nbsp Logout</a>";
    echo "</div>";
    echo "</div>";
}
?>

<div id="centralizar">
    <div id="content">
        <div class="inside">
            <p> 
                Software para obter o perfil alimentar e antropom�trico, 
                individual e coletivo, dos estudantes do Instituto Federal 
                de Educa��o, Ci�ncia e Tecnologia da Para�ba, campus Campina 
                Grande, a fim de auxiliar o nutricionista na defini��o da 
                quantidade cal�rica m�dia das refei��es do Restaurante Estudantil. 
            </p>
        </div>
    </div>
</div>
<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>
