<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
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

    <form action="trataAnamnese.php" 
          method="POST"
          name="formAnamnese">

                <!-- Validação inicial no lado do cliente -->
        <label for= "peso"> <em>*</em> Peso:
            <input type="text" name="peso"/>
            <em>kg</em>
        </label>

        <!-- Validação inicial no lado do cliente -->
        <label for= "altura"> <em>*</em> Altura:
            <input type="text" name="altura"/>
            <em>cm</em>
        </label>

        <!-- Validação inicial no lado do cliente -->
        <label for= "esporte"> <em>*</em> Quantas vezes pratica atividade física por semana:
            <select name="esporte">
                <option value=""</option>
                <option value="1"> 0 - 2 </option>
                <option value="2"> 3 - 5  </option>
                <option value="3"> 5 ou mais </option>
            </select>
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
