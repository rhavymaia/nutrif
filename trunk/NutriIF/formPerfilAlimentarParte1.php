<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
// Cabeçalho e menu da página html.
require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>
            <?php
            echo TL_PERFIL_ALIMENTAR;
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
    
    <form method="POST" action="trataPerfilAlimentarParte1.php">
        <h2>Qual é, em média, a quantidade de frutas (unidade/
        fatia/pedaço/copo de suco natural) que você come por 
        dia?</h2>
        <label for="quest1_1">
            <input type="radio" name="quest1" value="0" id="quest1_1"> Não como frutas, nem tomo suco de frutas natural 
            todos os dias
        </label> 
        <label for="quest1_2">                                   
            <input type="radio" name="quest1" value="3" id="quest1_2"> 3 ou mais unidades/fatias/pedaços/copos de suco natural
        </label>        
        <label for="quest1_3">   
            <input type="radio" name="quest1" value="2" id="quest1_3"> 2 unidades/fatias/pedaços/copos de suco natural 
        </label>        
        <label for="quest1_4">     
            <input type="radio" name="quest1" value="1" id="quest1_4"> 1 unidade/fatia/pedaço/copo de suco natural 
        </label>
        
        <h2>Qual é, em média, a quantidade de legumes e verduras 
        que você come por dia? (Não inclua nesse grupo os tubérculos e raízes)</h2>
        <label for="quest2_1">
            <input type="radio" name="quest2" value="0" id="quest2_1"> Não como legumes, nem verduras todos os dias 
        </label>         
        <label for="quest2_2">                                   
            <input type="radio" name="quest2" value="1" id="quest2_2"> 3 ou menos colheres de sopa
        </label>        
        <label for="quest2_3">   
            <input type="radio" name="quest2" value="2" id="quest2_3"> 4 a 5 colheres de sopa
        </label>        
        <label for="quest2_4">     
            <input type="radio" name="quest2" value="3" id="quest2_4"> 6 a 7 colheres de sopa
        </label>        
        <label for="quest2_5">     
            <input type="radio" name="quest2" value="4" id="quest2_5"> 8 ou mais colheres de sopa
        </label>

        <h2>Qual é, em média, a quantidade que você come dos 
        seguintes alimentos: feijão de qualquer tipo ou cor, 
        lentilha, ervilha, grão-de-bico, soja, fava, sementes ou 
        castanhas?</h2>
        <label for="quest3_1">
            <input type="radio" name="quest3" value="0" id="quest3_1"> Não consumo 
        </label>        
        <label for="quest3_2">                                   
            <input type="radio" name="quest3" value="3" id="quest3_2"> 2 ou mais colheres de sopa por dia
        </label>        
        <label for="quest3_3">   
            <input type="radio" name="quest3" value="1" id="quest3_3"> Consumo menos de 5 vezes por semana
        </label>        
        <label for="quest3_4">     
            <input type="radio" name="quest3" value="2" id="quest3_4"> 1 colher de sopa ou menos por dia  
        </label>

        <h2>Qual a quantidade, em média, que você consome por 
        dia dos alimentos listados abaixo?</h2>     
        <label for="quest4_1">
            Arroz, milho e outros cereais (inclusive os matinais); 
            mandioca/macaxeira/aipim, cará ou inhame; macarrão e 
            outras massas; batata-inglesa, batata-doce, batata-baroa 
            ou mandioquinha:                
            <input type="text" name="a" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" id="quest4_1"> colheres de sopa 
        </label>         
        <label for="quest4_2">
            Pães:                
            <input type="text" name="b" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" id="quest4_2"> unidades/fatias
        </label>
        <label for="quest4_3">
            Bolos sem cobertura e/ou recheio:
            <input type="text" name="c" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" id="quest4_3"> fatias
        </label>
        <label for="quest4_4">  
            Biscoito ou bolacha sem recheio:
            <input type="text" name="d" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" id="quest4_4"> unidades
        </label>

        <input type="submit" value="Confirmar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
</div>

<?php
// Rodapé da página html.
 unset($_SESSION['erro']);
require_once 'template/footer.php';
?>
