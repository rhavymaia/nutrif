<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
    require_once ('database/dao.class.php');
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>Formulário de Anamnese</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na validação -->
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

        <label for= "matricula"> <em>*</em> Matrícula:
            <input type="text" name="matricula"/>
        </label>
                
        <label for= "peso"> <em>*</em> Peso:
            <input type="text" name="peso"/>
            <em>kg</em>
        </label>

        <!-- Validação inicial no lado do cliente -->
        <label for= "altura"> <em>*</em> Altura:
            <input type="text" name="altura"/>
            <em>cm</em>
        </label>
        
        <label for="esporte1">*Nível de atividade física:</label>
            <input type="radio" name="esporte" value="1.2" id="e1"><b>Sedentária:</b>
            Sentada em frente à uma escrivaninha ou em casa o dia todo sem atividade física
        </label> 
        <label for="esporte2">                                   
            <input type="radio" name="esporte" value="1.375" id="e2"><b>Leve:</b> 
            Atividades domésticas ou caminhadas com duração de pelo menos 15 minutos de 2 a 3 na semana.
        </label>        
        <label for="esporte3">   
            <input type="radio" name="esporte" value="1.55" id="e3"><b>Moderada:</b>
            Caminhadas com duração de pelo menos 30 minutos, dança, jogos de recreação com amigos - de 2 a 3 vezes na semana
        </label>        
        <label for="esporte4">     
            <input type="radio" name="esporte" value="1.725" id="e4"><b>Alta:</b>
        Praticante de Cooper com duração de pelo menos 30 minutos, musculação, ginástica e jogos de recreação com amigos - mais de 3 vezes na semana
        </label>
        <label for="esporte5">     
            <input type="radio" name="esporte" value="1.9" id="e5"><b>Muito alta:</b>
        Praticante de triathlon, maratonas, ciclismo e atletas profissionais
        </label>

        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form>
    
<?php
// Após preenchimento do formulário limpar as variáveis da sessão.   
//Erro da validação, sessão será destruída
unset($_SESSION['erro']);
?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
