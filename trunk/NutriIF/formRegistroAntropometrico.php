<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabe�alho e menu da p�gina html.
    require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>Registro Antropom�trico</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na valida��o -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <form action="trataRegistroAntropometrico.php" 
          method="POST"
          name="formRegistroAntropometrico"
          onsubmit="return validaFormRegistroAntropometrico();"
          onreset="return resetValidacao();">

        <label for="aluno"  > <em>*</em> Aluno:
            <input type="text" name="aluno" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['aluno']) ? $_SESSION['aluno'] : VAZIO) ?>"/>
        </label>

        <label for="matricula"> <em>*</em> Matr�cula:
            <input type="text" name="matricula" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['matricula']) ? $_SESSION['matricula'] : VAZIO); ?>"/> 
        </label>

        <label for="nascimento"> <em>*</em> Data de Nascimento:
            <input type="text" name="nascimento" 
                   onkeypress="return formatar(this, '##/##/####');"
                   onFocus="this.className = 'select'" onBlur="this.className = 'normal'"
                   value= "<?php echo(isset($_SESSION['nascimento']) ? $_SESSION['nascimento'] : VAZIO); ?>"/>
        </label>

        <label for="sexo" value= "<?php echo(''); ?>"> <em>*</em> Sexo 
<?php
$sexoSelected = isset($_SESSION['sexo']) ? $_SESSION['sexo'] : VAZIO;
?>                        
            <select name="sexo">
                <option value="" <?php if ($sexoSelected == VAZIO) echo 'selected'; ?>></option>
                <option value="F" <?php if ($sexoSelected == 'F') echo 'selected'; ?>> Feminino </option>
                <option value="M" <?php if ($sexoSelected == 'M') echo 'selected'; ?>> Masculino </option>
            </select>                        
        </label>

        <label for="nivel"> N�vel
<?php
$nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
?>                        
            <select name="nivel">
                <option value="" <?php if ($nivelSelected == VAZIO) echo 'selected'; ?>></option>
                <option value="1" <?php if ($nivelSelected == '1') echo 'selected'; ?>> Integrado </option>
                <option value="2" <?php if ($nivelSelected == '2') echo 'selected'; ?>> Subseq�ente </option>
                <option value="3" <?php if ($nivelSelected == '3') echo 'selected'; ?>> Superior </option>
            </select>
        </label>

        <!-- Valida��o inicial no lado do cliente -->
        <label for= "peso"> <em>*</em> Peso:
            <input type="text" name="peso" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['peso']) ? $_SESSION['peso'] : VAZIO); ?>" />
            <em>kg</em>
        </label>

        <!-- Valida��o inicial no lado do cliente -->
        <label for= "altura"> <em>*</em> Altura:
            <input type="text" name="altura" onFocus="this.className = 'select'" onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['altura']) ? $_SESSION['altura'] : VAZIO); ?>"/>
            <em>cm</em>
        </label>

        <!-- Valida��o inicial no lado do cliente -->
        <label for= "esporte"> <em>*</em> Quantas vezes pratica atividade f�sica por semana:
 <?php
$esporteSelected = isset($_SESSION['esporte']) ? $_SESSION['nr_nivel_esporte'] : VAZIO;
?>
            <select name="esporte">
                <option value="" <?php if ($esporteSelected == VAZIO) echo 'selected'; ?>></option>
                <option value="1" <?php if ($esporteSelected == '1') echo 'selected'; ?>> 0 - 2 </option>
                <option value="2" <?php if ($esporteSelected == '2') echo 'selected'; ?>> 3 - 5  </option>
                <option value="3" <?php if ($esporteSelected == '3') echo 'selected'; ?>> 5 ou mais </option>
            </select>
        </label>

        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form>
<?php
// Ap�s preenchimento do formul�rio limpar as vari�veis da sess�o.   
unset($_SESSION['peso']);
unset($_SESSION['altura']);
unset($_SESSION['nascimento']);
unset($_SESSION['aluno']);
unset($_SESSION['matricula']);
unset($_SESSION['nivel']);
unset($_SESSION['sexo']);
unset($_SESSION['esporte']);
unset($_SESSION['vet']);
unset($_SESSION['vct']);

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