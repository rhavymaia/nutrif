<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabe�alho e menu da p�gina html.
    require_once 'template/headerForm.php';
    require_once ('database/dao.class.php');
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>Formul�rio de Anamnese</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na valida��o -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    
    
     <?php       
            $dao = new dao_class();
            
            $pesquisas = $dao->selecionarPesquisas();
            
            foreach ($pesquisas as $pesquisa) { 
                
                echo "<tr>";
                echo "<td>";
                echo $pesquisa['nm_pesquisa'];
                echo "</td>";
                echo "</tr>";
            }
            
        ?>

    <form action="trataAnamnese.php" 
          method="POST"
          name="formAnamnese">

        <label for= "matricula"> <em>*</em> Matr�cula:
            <input type="text" name="matricula"/>
        </label>
                
        <label for= "peso"> <em>*</em> Peso:
            <input type="text" name="peso"/>
            <em>kg</em>
        </label>

        <!-- Valida��o inicial no lado do cliente -->
        <label for= "altura"> <em>*</em> Altura:
            <input type="text" name="altura"/>
            <em>cm</em>
        </label>
        
        <label for="esporte1">*N�vel de atividade f�sica:</label>
            <input type="radio" name="esporte" value="1.2" id="e1"><b>Sedent�ria:</b>
            Sentada em frente � uma escrivaninha ou em casa o dia todo sem atividade f�sica
        </label> 
        <label for="esporte2">                                   
            <input type="radio" name="esporte" value="1.375" id="e2"><b>Leve:</b> 
            Atividades dom�sticas ou caminhadas com dura��o de pelo menos 15 minutos de 2 a 3 na semana.
        </label>        
        <label for="esporte3">   
            <input type="radio" name="esporte" value="1.55" id="e3"><b>Moderada:</b>
            Caminhadas com dura��o de pelo menos 30 minutos, dan�a, jogos de recrea��o com amigos - de 2 a 3 vezes na semana
        </label>        
        <label for="esporte4">     
            <input type="radio" name="esporte" value="1.725" id="e4"><b>Alta:</b>
        Praticante de Cooper com dura��o de pelo menos 30 minutos, muscula��o, gin�stica e jogos de recrea��o com amigos - mais de 3 vezes na semana
        </label>
        <label for="esporte5">     
            <input type="radio" name="esporte" value="1.9" id="e5"><b>Muito alta:</b>
        Praticante de triathlon, maratonas, ciclismo e atletas profissionais
        </label>

        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
<?php
// Ap�s preenchimento do formul�rio limpar as vari�veis da sess�o.   
//Erro da valida��o, sess�o ser� destru�da
unset($_SESSION['erro']);
?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>
