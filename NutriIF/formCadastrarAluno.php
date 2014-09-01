<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/header.php';
    //require_once 'js/validacao.js';
?>


<div class="container">
    <div id="letras">
        <p>
        <h1>Crie sua conta no NutrIF</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>
    <div class="container_cadastro">
    <img class="img_cadastro" src="images/if_frente.jpg">
<div class="formCadastro">
    <form action="trataCadastrarAluno.php" 
          method="POST"
          name="formCadastrarAluno"
          >
        <div>
        <label for="nome_aluno"> <em>*</em> Nome:
            <input type="text" name="nome_aluno" required onFocus="this.className = 'select'" 
                onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['nome_aluno']) ? $_SESSION['nome_aluno'] : VAZIO) ?>"/>
        </label></div>
        <div>             
         <label for="matricula"> <em>*</em> Matrícula:
            <input type="text" name="matricula" required onFocus="this.className = 'select'" 
                onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['matricula']) ? $_SESSION['matricula'] : VAZIO) ?>"/> 
        </label></div>
        <div>
        <label for="nascimento"> <em>*</em> Data de Nascimento:
            <input type="date" name="nascimento" required onFocus="this.className = 'select'" 
                onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['nascimento']) ? $_SESSION['nascimento'] : VAZIO) ?>"/>
        </label></div>
        <div>        
        <label for="sexo" value= "<?php echo(''); ?>"> <em>*</em> Sexo 
            <?php
            $sexoSelected = isset($_SESSION['sexo']) ? $_SESSION['sexo'] : VAZIO;
            ?>                        
            <select name="sexo" required>
                <option value="" <?php if ($sexoSelected == VAZIO) echo 'selected'; ?>></option>
                <option value="F" <?php if ($sexoSelected == 'F') echo 'selected'; ?>> Feminino </option>
                <option value="M" <?php if ($sexoSelected == 'M') echo 'selected'; ?>> Masculino </option>
            </select>                        
        </label></div>
        <div>
         <label for="nivel"> Nível
            <?php
            $nivelSelected = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : VAZIO;
            ?>                        
            <select name="nivel" required>
                <option value="" <?php if ($nivelSelected == VAZIO) echo 'selected'; ?>></option>
                <option value="1" <?php if ($nivelSelected == '1') echo 'selected'; ?>> Integrado </option>
                <option value="2" <?php if ($nivelSelected == '2') echo 'selected'; ?>> Subseqüente </option>
                <option value="3" <?php if ($nivelSelected == '3') echo 'selected'; ?>> Superior </option>
            </select>
        </label></div>
         <div>       
        <label for="login"> <em>*</em> Login (e-mail):
            <input type="email" name="login" required onFocus="this.className = 'select'" 
                onBlur="this.className = 'normal'" value= "<?php echo(isset($_SESSION['login']) ? $_SESSION['login'] : VAZIO) ?>"/> 
        </label></div>
          <div>      
        <label for="senha1"> <em>*</em> Senha:
            <input type="password" name="senha1" required/> 
        </label></div>
        <div>
        <label for="senha2"> <em>*</em> Repetir senha:
            <input type="password" name="senha2" required/> 
        </label></div>

        <input type="submit" value="Enviar"/>
        <input type="reset" value="Limpar"/>
    </form></div>
<?php
// Após preenchimento do formulário limpar as variáveis da sessão.   
unset($_SESSION['nascimento']);
unset($_SESSION['nome_aluno']);
unset($_SESSION['matricula']);
unset($_SESSION['nivel']);
unset($_SESSION['sexo']);
unset($_SESSION['login']);

//Erro da validação, sessão será destruída
unset($_SESSION['erro']);
?>
</div>
<div class="clear">
    <!-- Vazio -->
</div>
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
