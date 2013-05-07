<?php
    require_once ('util/constantes.php');
    session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>
            <?php            
                echo PF_TITULO;                
            ?>
        </title>
        
        <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
        <script language="javascript" src="javascript/validacao.js"></script> 
        
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    </head>
    
    <body>
        
        <div id="container">
            <div id="cabecalho">
                <div id="logo">
                    <a href="#"><img src="img/logonutrif.png" wight="800" height="100"></a>
                </div>
            </div>

            <div id="menu">
                <ul>
                    <li><span><a href="index.php">Home</a></span></li>
                    <li class="pagina_atual"><a href="#">Formul�rio</a></li>
                </ul>
            </div>

            <div id="content">   
                <ul id="erro">
                    <!-- Lista de erros na valida��o -->
                     <?php echo(isset($_SESSION['erro'])? $_SESSION['erro']: VAZIO); 
                     
                            //Ap�s ser exibida a mensagem de erro da valida��o, sess�o ser� destru�da
                           unset($_SESSION['erro']);
                     ?>
                    
                </ul>
                
                <form action="trataRegistroAntropometrico.php" 
                      method="POST"
                      name="formRegistroAntropometrico"
                      onsubmit="return validaForm();"
                      onreset="return resetValidacao();">
             
                    <label for="aluno"> <em>*</em> Aluno:
                        <input type="text" name="aluno" value= "<?php echo(isset($_SESSION['aluno'])? $_SESSION['aluno']: VAZIO) ?>"/>
                    </label>

                    <label for="matricula"> <em>*</em> Matr�cula:
                        <input type="text" name="matricula" value= "<?php echo(isset($_SESSION['matricula'])? $_SESSION['matricula']: VAZIO); ?>"/> 
                    </label>

                    <label for="nascimento"> <em>*</em> Data de Nascimento:
                        <input type="text" name="nascimento" 
                               onkeypress="return formatar(this, '##/##/####');" 
                               value= "<?php echo(isset($_SESSION['nascimento'])? $_SESSION['nascimento']: VAZIO); ?>"/>
                    </label>

                    <label for="sexo" value= "<?php echo(''); ?>"> <em>*</em> Sexo 
                        <?php
                            $sexoSelected = isset($_SESSION['sexo'])? $_SESSION['sexo']: VAZIO;
                        ?>                        
                        <select name="sexo">
                            <option value="" <?php if($sexoSelected=='') echo 'selected'; ?>></option>
                                <option value="F" <?php if($sexoSelected=='F') echo 'selected'; ?>> Feminino </option>
                                <option value="M" <?php if($sexoSelected=='M') echo 'selected'; ?>> Masculino </option>
                        </select>                        
                    </label>

                    <label for="nivel"> N�vel
                        <?php
                            $nivelSelected = isset($_SESSION['nivel'])? $_SESSION['nivel']: VAZIO;
                        ?>                        
                        <select name="nivel">
                            <option value="" <?php if($nivelSelected=='') echo 'selected'; ?>></option>
                            <option value="1" <?php if($nivelSelected=='1') echo 'selected'; ?>> Integrado </option>
                            <option value="2" <?php if($nivelSelected=='2') echo 'selected'; ?>> Subseq�ente </option>
                            <option value="3" <?php if($nivelSelected=='3') echo 'selected'; ?>> Superior </option>
                        </select>
                    </label>

                    <!-- Valida��o inicial no lado do cliente -->
                    <label for= "peso"> <em>*</em> Peso:
                        <input type="text" name="peso" value= "<?php echo(isset($_SESSION['peso'])? $_SESSION['peso']: VAZIO); ?>" /> 
                       
                    </label>

                    <!-- Valida��o inicial no lado do cliente -->
                    <label for= "altura"> <em>*</em> Altura:
                        <input type="text" name="altura" value= "<?php  echo(isset($_SESSION['altura'])? $_SESSION['altura']: VAZIO); ?>"/><br>
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
                    
                ?>
            </div>
                            
            <div id="rodape">
                <p>
                    IFPB - Instituto Federal de Educa��o, Ci�ncia e Tecnologia
                    <em>Campina Grande</em>
                </p>
                <p>
                    Copyright (c) 2013. Todos os direitos Reservados.
                </p>
            </div>
        </div>
    </body>
</html>