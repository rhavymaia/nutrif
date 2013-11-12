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
            echo TL_QUESTIONARIO;
            ?>
        </h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na validação -->

    </ul>

    <div id="quest">
        <form method="post" action="trataQuestao2.php">
            5 - Qual é, em média, a quantidade de carnes (gado, porco, 
            aves, peixes e outras) ou ovos que você come por dia
            dia?
            <?php
            $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
            ?>       
    </div>
    <label>
        <input type="radio" name="quest5" value="1"> Não consumo nenhum tipo de carne 
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest5" value="2"> 1 pedaço/fatia/colher de sopa ou 1 ovo
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest5" value="3"> 2 pedaços/fatias/colheres de sopa ou 2 ovos 
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest5" value="0">  Mais de 2 pedaços/fatias/colheres de sopa ou 
        mais de 2 ovo
    </label>
    <div class="clear"></div>
    <div id="quest">
        6 - Você costuma tirar a gordura aparente das carnes, a 
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
        <input type="radio" name="quest6" value="0"> Não
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest6" value="2"> Não como carne vermelha ou frango
    </label>
    <div class="clear"></div>
    <div id="quest">
        7 - Você costuma comer peixes com qual frequência?
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest7" value="0"> Não consumo
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
        <input type="radio" name="quest7" value="2"> De 1 a 4 vezes por mês 
    </label>
    <div class="clear"></div>
    <div id="quest">
        8 - Qual é, em média, a quantidade de leite e seus derivados 
        (iogurtes, bebidas lácteas, coalhada, requeijão, queijos 
        e outros) que você come por dia?     
    </div>
    Pense na quantidade usual que você consome: pedaço, fatia ou 
    porções em colheres de sopa ou copo grande (tamanho do copo 
    de requeijão) ou xícara grande, quando for o caso.
    <div class="clear"></div>
    <label>
        <input type="radio" name="quest8" value="0"> Não consumo leite, nem derivados
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest8" value="3"> 3 ou mais copos de leite ou pedaços/fatias/
        porções
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest8" value="2"> 2 copos de leite ou pedaços/fatias/porçõe
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest8" value="1"> 1 ou menos copos de leite ou pedaços/fatias/
        porções
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
// Rodapé da página html.
require_once 'template/footer.php';
?>
