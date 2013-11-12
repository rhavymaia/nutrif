<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
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
            echo TL_QUESTIONARIO;
            ?>
        </h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na valida��o -->

    </ul>

    <div id="quest">
        <form method="post" action="trataQuestao2.php">
            5 - Qual �, em m�dia, a quantidade de carnes (gado, porco, 
            aves, peixes e outras) ou ovos que voc� come por dia
            dia?
            <?php
            $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
            ?>       
    </div>
    <label>
        <input type="radio" name="quest5" value="1"> N�o consumo nenhum tipo de carne 
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest5" value="2"> 1 peda�o/fatia/colher de sopa ou 1 ovo
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest5" value="3"> 2 peda�os/fatias/colheres de sopa ou 2 ovos 
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest5" value="0">  Mais de 2 peda�os/fatias/colheres de sopa ou 
        mais de 2 ovo
    </label>
    <div class="clear"></div>
    <div id="quest">
        6 - Voc� costuma tirar a gordura aparente das carnes, a 
        pele do frango ou outro tipo de ave?
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest6" value="3"> Sim
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest6" value="0"> N�o
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest6" value="2"> N�o como carne vermelha ou frango
    </label>
    <div class="clear"></div>
    <div id="quest">
        7 - Voc� costuma comer peixes com qual frequ�ncia?
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest7" value="0"> N�o consumo
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest7" value="1"> Somente algumas vezes no ano
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest7" value="3"> 2 ou mais vezes por semana
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest7" value="2"> De 1 a 4 vezes por m�s 
    </label>
    <div class="clear"></div>
    <div id="quest">
        8 - Qual �, em m�dia, a quantidade de leite e seus derivados 
        (iogurtes, bebidas l�cteas, coalhada, requeij�o, queijos 
        e outros) que voc� come por dia?     
    </div>
    Pense na quantidade usual que voc� consome: peda�o, fatia ou 
    por��es em colheres de sopa ou copo grande (tamanho do copo 
    de requeij�o) ou x�cara grande, quando for o caso.
    <div class="clear"></div>
    <label>
        <input type="radio" name="quest8" value="0"> N�o consumo leite, nem derivados
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest8" value="3"> 3 ou mais copos de leite ou peda�os/fatias/
        por��es
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest8" value="2"> 2 copos de leite ou peda�os/fatias/por��e
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest8" value="1"> 1 ou menos copos de leite ou peda�os/fatias/
        por��es
    </label>
    <div class="clear"></div>
    <input type="submit" value="Confirmar"/>
</form>
<div class="clear"></div>
<div class="container">
    <div id="centralizares">
    </div>
    <div class="clear"></div>

</div>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>
