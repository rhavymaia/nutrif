<?php
require_once ('util/constantes.php');
require_once ('validate/erro.php');
require_once ('validate/validate.php');
// Cabe�alho e menu da p�gina html.
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
        <!-- Lista de erros na valida��o -->
                  
    </ul>
    
    <form method="post" action="trataPerfilAlimentarParte3.php">
        <h2>Pense nos seguintes alimentos: frituras, salgadinhos 
            fritos ou em pacotes, carnes salgadas, hamb�rgueres, 
            presuntos e embutidos (salsicha, mortadela, salame, 
            ling�i�a e outros). Voc� costuma comer qualquer um 
            deles com que frequ�ncia?</h2>
        <label for="quest10_1">
            <input type="radio" name="quest10" value="4" id="quest10_1"> Raramente ou nunca 
        </label> 
        <label for="quest10_2">                                   
            <input type="radio" name="quest10" value="0" id="quest10_2"> Todos os dias
        </label>        
        <label for="quest10_3">   
            <input type="radio" name="quest10" value="2" id="quest10_3"> De 2 a 3 vezes por semana
        </label>        
        <label for="quest10_4">     
            <input type="radio" name="quest10" value="1" id="quest10_4"> De 4 a 5 vezes por semana 
        </label>
        <label for="quest10_5">     
            <input type="radio" name="quest10" value="3" id="quest10_5"> Menos que 2 vezes por semana
        </label>
        
        <h2> Pense nos seguintes alimentos: doces de qualquer 
             tipo, bolos recheados com cobertura, biscoitos doces, 
             refrigerantes e sucos industrializados. Voc� costuma 
             comer qualquer um deles com que frequ�ncia?</h2>
        <label for="quest11_1">
            <input type="radio" name="quest11" value="4" id="quest11_1"> Raramente ou nunca 
        </label>         
        <label for="quest11_2">                                   
            <input type="radio" name="quest11" value="3" id="quest11_2"> Menos que 2 vezes por semana
        </label>        
        <label for="quest11_3">   
            <input type="radio" name="quest11" value="2" id="quest11_3"> De 2 a 3 vezes por semana
        </label>        
        <label for="quest11_4">     
            <input type="radio" name="quest11" value="1" id="quest11_4"> De 4 a 5 vezes por semana
        </label>        
        <label for="quest11_5">     
            <input type="radio" name="quest11" value="0" id="quest11_5"> Todos os dias 
        </label>

        <h2> Qual tipo de gordura � mais usado na sua casa para 
             cozinhar os alimentos?</h2>
        <label for="quest12_1">
            <input type="radio" name="quest12" value="0" id="quest12_1"> Banha animal ou manteiga
        </label>        
        <label for="quest12_2">                                   
            <input type="radio" name="quest12" value="3" id="quest12_2"> �leo vegetal como: soja, girassol, milho, algod�o ou canola
        </label>        
        <label for="quest12_3">   
            <input type="radio" name="quest12" value="0" id="quest12_3"> Margarina ou gordura vegetal
        </label>        

        <h2> Voc� costuma colocar mais sal nos alimentos quando j� 
             servidos em seu prato?</h2>     
         <label for="quest13_1">
            <input type="radio" name="quest13" value="0" id="quest13_1"> Sim
        </label>        
        <label for="quest13_2">                                   
            <input type="radio" name="quest13" value="3" id="quest13_2"> N�o
        </label>

        <input type="submit" value="Confirmar"/>
        <input type="reset" value="Limpar"/>
    </form>
</div>

<?php
// Rodap� da p�gina html.
 unset($_SESSION['erro']);
require_once 'template/footer.php';
?>
