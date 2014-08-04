<?php
    require_once ('util/constantes.php');
    require_once ('validate/erro.php');
    // Cabeçalho e menu da página html.
    require_once 'template/headerForm.php';
?>

<div class="container">
    <div id="letras">
        <p>
        <h1>Cadastro de Aluno</h1>
        </p>
    </div>

    <ul id="erro">
        <!-- Lista de erros na validação -->
        <?php
            isset($_SESSION['erro']) ? showListErro($_SESSION['erro']) : VAZIO;
        ?>                    
    </ul>

    <form action="trataCadastrarAluno.php" 
          method="POST"
          name="formCadastrarAluno"
          onsubmit="return validaFormRegistroAntropometrico();"
          onreset="return resetValidacao();">

        <label for="nome_aluno"> <em>*</em> Nome:
            <input type="text" name="nome_aluno"/>
        </label>

        <label for="instituicao"> <em>*</em> Instituição:
            <input type="text" name="instituicao"/> 
        </label>
        
         <label for="matricula"> <em>*</em> Matrícula:
            <input type="text" name="matricula"/> 
        </label>

        <label for="nascimento"> <em>*</em> Data de Nascimento:
            <input type="text" name="nascimento" 
                   onkeypress="return formatar(this, '##/##/####');"/>
        </label>
        
        <label for="sexo" value= ""> <em>*</em> Sexo                     
            <select name="sexo">
                <option value=""></option>
                <option value="F"> Feminino </option>
                <option value="M"> Masculino </option>
            </select>                        
        </label>

        <label for="nivel"> Nível                      
            <select name="nivel">
                <option value=""></option>
                <option value="1"> Integrado </option>
                <option value="2"> Subseqüente </option>
                <option value="3"> Superior </option>
            </select>
        </label>
        
        <label for="login"> <em>*</em> Login:
            <input type="text" name="login"/> 
        </label>
        
        <label for="senha1"> <em>*</em> Senha:
            <input type="password" name="senha1"/> 
        </label>
        <label for="senha2"> <em>*</em> Repetir senha:
            <input type="password" name="senha2"/> 
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
