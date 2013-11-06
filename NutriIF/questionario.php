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
        <?php
        isset($_SESSION['erro']) && sizeof($_SESSION['erro']) > 0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <div id="quest">
        <form method="post" action="trataQuestao1.php">
            1 - Qual �, em m�dia, a quantidade de frutas (unidade/
            fatia/peda�o/copo de suco natural) que voc� come por 
            dia?
            <?php
            $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
            ?>       
    </div>
    <label>
        <input type="radio" name="quest1" value="0"> N�o como frutas, nem tomo suco de frutas natural 
        todos os dias
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest1" value="3"> 3 ou mais unidades/fatias/peda�os/copos de suco natural
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest1" value="2"> 2 unidades/fatias/peda�os/copos de suco natural 
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest1" value="1"> 1 unidade/fatia/peda�o/copo de suco natural 
    </label>
    <div class="clear"></div>
    <div id="quest">
        2 - Qual �, em m�dia, a quantidade de legumes e verduras 
        que voc� come por dia? (N�o inclua nesse grupo os tub�rculos e ra�zes)
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest2" value="0"> N�o como legumes, nem verduras todos os dias 
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest2" value="1"> 3 ou menos colheres de sopa
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest2" value="2"> 4 a 5 colheres de sopa
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest2" value="3"> 6 a 7 colheres de sopa
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest2" value="4"> 8 ou mais colheres de sopa
    </label>
    <div class="clear"></div>
    <div id="quest">
        3 - Qual �, em m�dia, a quantidade que voc� come dos 
        seguintes alimentos: feij�o de qualquer tipo ou cor, 
        lentilha, ervilha, gr�o-de-bico, soja, fava, sementes ou 
        castanhas?
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest3" value="0"> N�o consumo 
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest3" value="3"> 2 ou mais colheres de sopa por dia
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest3" value="1"> Consumo menos de 5 vezes por semana
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest3" value="2"> 1 colher de sopa ou menos por dia  
    </label>
    <div class="clear"></div>
    <div id="quest">
        4 - Qual a quantidade, em m�dia, que voc� consome por 
        dia dos alimentos listados abaixo
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        Arroz, milho e outros cereais (inclusive os matinais); 
        mandioca/macaxeira/aipim, car� ou inhame; macarr�o e 
        outras massas; batata-inglesa, batata-doce, batata-baroa 
        ou mandioquinha:                
        <input type="text" name="a" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"> colheres de sopa 
    </label> 
    <div class="clear"></div>
    <label>
         P�es:                
        <input type="text" name="b" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"> unidades/fatias
    </label> 
    <div class="clear"></div>
    <label>
         Bolos sem cobertura e/ou recheio:
        <input type="text" name="c" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"> fatias
    </label>
    <div class="clear"></div>
    <label>  
         Biscoito ou bolacha sem recheio:
        <input type="text" name="d" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"> unidades
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
