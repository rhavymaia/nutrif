<?php

    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabe�alho e menu da p�gina html.
    require_once 'template/headerForm.php'; 
    
?>
<div class="container">
    <div id="letras">
        <p>
        <h1>Cadastro de Entrevistado</h1>
        </p>
    </div>
        
    <ul id="erro">
        <!-- Lista de erros na valida��o -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    
    
 <form action="trataCadastrarEntrevistado.php"
          method="POST"
          name="formCadastrarEntrevistado"
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
       
        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form>

<?php
// Rodap� da p�gina html.
require_once 'template/footer.php';
?>