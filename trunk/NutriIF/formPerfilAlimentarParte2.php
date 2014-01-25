<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');

// Cabeçalho e menu da página html.
require_once 'template/headerForm.php';
?> 

<script>    
    function habilitaQuestao9(selectRadio){
        if (selectRadio.value == 0){
            document.getElementById("questao9").style.display="none";            
        } else {
           document.getElementById("questao9").style.display="block";  
        }
    }
</script>

<div class="container">
    <div id="letras">
        <p>
        <h1>
            <?php
            echo TL_PERFIL_ALIMENTAR;
            ?>
            - Parte 2
        </h1>
        </p>
    </div>
    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php    
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?> 
    </ul>
    <form method="post" action="trataPerfilAlimentarParte2.php">

        <h2>
            5 - Qual é, em média, a quantidade de carnes (gado, porco, aves, 
            peixes e outras) ou ovos que você come por dia dia?
        </h2>
        <label for="quest5_1">
            <input type="radio" name="quest5" value="1" id="quest5_1"> Não consumo nenhum tipo de carne 
        </label>            
        <label for="quest5_2">                                   
            <input type="radio" name="quest5" value="2" id="quest5_2"> 1 pedaço/fatia/colher de sopa ou 1 ovo
        </label>           
        <label for="quest5_3">   
            <input type="radio" name="quest5" value="3" id="quest5_3"> 2 pedaços/fatias/colheres de sopa ou 2 ovos 
        </label>            
        <label for="quest5_4">     
            <input type="radio" name="quest5" value="0" id="quest5_4"> Mais de 2 pedaços/fatias/colheres de sopa ou mais de 2 ovo
        </label>


        <h2>
            6 - Você costuma tirar a gordura aparente das carnes, a 
            pele do frango ou outro tipo de ave?
        </h2>
        <label for="quest6_1">
            <input type="radio" name="quest6" value="3" id="quest6_1"> Sim
        </label>
        <label for="quest6_2">                                   
            <input type="radio" name="quest6" value="0" id="quest6_2"> Não
        </label>            
        <label for="quest6_3">   
            <input type="radio" name="quest6" value="2" id="quest6_3"> Não como carne vermelha ou frango
        </label>

        <h2>
            7 - Você costuma comer peixes com qual frequência?
        </h2>
        <label for="quest7_1">
            <input type="radio" name="quest7" value="0" id="quest7_1"> Não consumo
        </label>
        <label for="quest7_2">                                   
            <input type="radio" name="quest7" value="1" id="quest7_2"> Somente algumas vezes no ano
        </label>
        <label for="quest7_3">   
            <input type="radio" name="quest7" value="3" id="quest7_3"> 2 ou mais vezes por semana
        </label>
        <label for="quest7_4">     
            <input type="radio" name="quest7" value="2" id="quest7_4"> De 1 a 4 vezes por mês 
        </label>

        <h2>
            8 - Qual é, em média, a quantidade de leite e seus derivados 
            (iogurtes, bebidas lácteas, coalhada, requeijão, queijos 
            e outros) que você come por dia?
        </h2>
        <h3>
            Pense na quantidade usual que você consome: pedaço, fatia ou 
            porções em colheres de sopa ou copo grande (tamanho do copo 
            de requeijão) ou xícara grande, quando for o caso.
        </h3>            
        <label for="quest8_1">
            <input type="radio" name="quest8" value="0" onchange="habilitaQuestao9(this);" id="quest8_1"> Não consumo leite, nem derivados
        </label>            
        <label for="quest8_2">                                   
            <input type="radio" name="quest8" value="3" onchange="habilitaQuestao9(this);" id="quest8_2"> 3 ou mais copos de leite ou pedaços/fatias/
            porções
        </label>            
        <label for="quest8_3">   
            <input type="radio" name="quest8" value="2" onchange="habilitaQuestao9(this);" id="quest8_3"> 2 copos de leite ou pedaços/fatias/porçõe
        </label>            
        <label for="quest8_4">     
            <input type="radio" name="quest8" value="1" onchange="habilitaQuestao9(this);" id="quest8_4"> 1 ou menos copos de leite ou pedaços/fatias/
            porções
        </label>

        <div id="questao9">
            <h2>
                9 - Que tipo de leite e seus derivados você habitualmente 
                consome?
            </h2>
            <label for="quest9_1">
                <input type="radio" name="quest9" value="1" id="quest9_1"> Integral
            </label>
            <label for="quest9_2">
                <input type="radio" name="quest9" value="3" id="quest9_2"> Com baixo teor de gorduras (semidesnatado, 
                desnatado ou light)
            </label> 
        </div>

        <input type="submit" value="Confirmar"/>
        <input type="reset" value="Limpar"/>
    </form>

<?php
// Rodapé da página html.
unset($_SESSION['erro']);
require_once 'template/footer.php';
?>