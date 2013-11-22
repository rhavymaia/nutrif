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
    
    <form method="post" action="trataPerfilAlimentarParte4.php">
        <h2>Pense na sua rotina semanal: quais as refei��es voc� 
            costuma fazer habitualmente no dia?</h2>
        <label for="quest14_1">
            <input type="checkbox" name="quest14a" value="1" id="quest14_1"> Caf� da manh� 
        </label> 
        <label for="quest14_2">
            <input type="checkbox" name="quest14b" value="1" id="quest14_2"> Lanche da manh� 
        </label> 
        <label for="quest14_3">
            <input type="checkbox" name="quest14c" value="1" id="quest14_3"> Almo�o 
        </label> 
        <label for="quest14_4">
            <input type="checkbox" name="quest14d" value="1" id="quest14_4"> Lanche ou caf� da tarde
        </label> 
        <label for="quest14_5">
            <input type="checkbox" name="quest14e" value="1" id="quest14_5"> Jantar ou caf� da noite
        </label>
        <label for="quest14_6">
            <input type="checkbox" name="quest14f" value="1" id="quest14_6"> Lanche antes de dormir
        </label> 
        
        <h2>Quantos copos de �gua voc� bebe por dia? Inclua no 
            seu c�lculo sucos de frutas naturais ou ch�s (exceto 
            caf�, ch� preto e ch� mate).</h2>
        <label for="quest15_1">
            <input type="radio" name="quest15" value="0" id="quest15_1"> Menos de 4 copos
        </label>         
        <label for="quest15_2">                                   
            <input type="radio" name="quest15" value="3" id="quest15_2"> 8 copos ou mais
        </label>        
        <label for="quest15_3">   
            <input type="radio" name="quest15" value="1" id="quest15_3"> 4 a 5 copos
        </label>        
        <label for="quest15_4">     
            <input type="radio" name="quest15" value="2" id="quest15_4"> 6 a 8 copos
        </label>        

        <h2>Voc� costuma consumir bebidas alco�licas (u�sque, 
            cacha�a, vinho, cerveja, conhaque etc.) com qual 
            frequ�ncia?</h2>
        <label for="quest16_1">
            <input type="radio" name="quest16" value="0" id="quest16_1"> Diariamente
        </label>        
        <label for="quest16_2">                                   
            <input type="radio" name="quest16" value="1" id="quest16_2"> 1 a 6 vezes na semana
        </label>        
        <label for="quest16_3">   
            <input type="radio" name="quest16" value="2" id="quest16_3"> Eventualmente ou raramente (menos de 4 vezes ao m�s)
        </label>  
        <label for="quest16_4">   
            <input type="radio" name="quest16" value="3" id="quest16_4"> N�o consumo
        </label> 

        <h2>Voc� faz atividade f�sica REGULAR, isto �, pelo menos 
            30 minutos por dia, todos os dias da semana, durante 
            o seu tempo livre?</h2>
        <h3>Considere aqui as atividades da sua rotina di�ria como o 
            deslocamento a p� ou de bicicleta para o trabalho, subir escadas, 
            atividades dom�sticas, atividades de lazer ativo e atividades 
            praticadas em academias e clubes. Os 30 minutos podem ser 
            divididos em 3 etapas de 10 minutos.</h3>
        <label for="quest17_1">
            <input type="radio" name="quest17" value="0" id="quest17_1"> N�o
        </label>        
        <label for="quest17_2">                                   
            <input type="radio" name="quest17" value="3" id="quest17_2"> Sim
        </label>
        <label for="quest17_3">                                   
            <input type="radio" name="quest17" value="2" id="quest17_3"> 2 a 4 vezes por semana 
        </label>
        
        <h2>Voc� costuma ler a informa��o nutricional que est� 
            presente no r�tulo de alimentos industrializados antes 
            de compr�-los?</h2>
        <label for="quest18_1">
            <input type="radio" name="quest18" value="0" id="quest18_1"> Nunca
        </label>        
        <label for="quest18_2">                                   
            <input type="radio" name="quest18" value="1" id="quest18_2"> Quase nunca
        </label>        
        <label for="quest18_3">   
            <input type="radio" name="quest18" value="2" id="quest18_3"> Algumas vezes, para alguns produtos
        </label>  
        <label for="quest18_4">   
            <input type="radio" name="quest18" value="3" id="quest18_4"> Sempre ou quase sempre, para todos os produtos
        </label> 

        <input type="submit" value="Confirmar"/>
        <input type="reset" value="Limpar"/>
    </form>
</div>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>

