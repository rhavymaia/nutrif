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
        <?php
        isset($_SESSION['erro']) && sizeof($_SESSION['erro']) > 0 ? ErroMatricula($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <div id="quest">
        <form method="post" action="trataQuestao1.php">
            1 - Qual é, em média, a quantidade de frutas (unidade/
            fatia/pedaço/copo de suco natural) que você come por 
            dia?
            <?php
            $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
            ?>       
    </div>
    <label>
        <input type="radio" name="quest1" value="0"> Não como frutas, nem tomo suco de frutas natural 
        todos os dias
    </label> 
    <div class="clear"></div>
    <label>                                   
        <input type="radio" name="quest1" value="3"> 3 ou mais unidades/fatias/pedaços/copos de suco natural
    </label>
    <div class="clear"></div>
    <label>   
        <input type="radio" name="quest1" value="2"> 2 unidades/fatias/pedaços/copos de suco natural 
    </label>
    <div class="clear"></div>
    <label>     
        <input type="radio" name="quest1" value="1"> 1 unidade/fatia/pedaço/copo de suco natural 
    </label>
    <div class="clear"></div>
    <div id="quest">
        2 - Qual é, em média, a quantidade de legumes e verduras 
        que você come por dia? (Não inclua nesse grupo os tubérculos e raízes)
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest2" value="0"> Não como legumes, nem verduras todos os dias 
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
        3 - Qual é, em média, a quantidade que você come dos 
        seguintes alimentos: feijão de qualquer tipo ou cor, 
        lentilha, ervilha, grão-de-bico, soja, fava, sementes ou 
        castanhas?
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        <input type="radio" name="quest3" value="0"> Não consumo 
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
        4 - Qual a quantidade, em média, que você consome por 
        dia dos alimentos listados abaixo
        <?php
        $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
        ?>       
    </div>
    <label>
        Arroz, milho e outros cereais (inclusive os matinais); 
        mandioca/macaxeira/aipim, cará ou inhame; macarrão e 
        outras massas; batata-inglesa, batata-doce, batata-baroa 
        ou mandioquinha:                
        <input type="text" name="a" onFocus="this.className = 'select'" onBlur="this.className = 'normal'"> colheres de sopa 
    </label> 
    <div class="clear"></div>
    <label>
         Pães:                
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
// Rodapé da página html.
require_once 'template/footer.php';
?>
