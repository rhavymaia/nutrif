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
                    <li class="pagina_atual"><a href="#">Formulário</a></li>
                </ul>
            </div>

            <div id="content">   
                <ul id="erro">
                    <!-- Lista de erros na validação -->
                </ul>
                
                <form action="trataRegistroAntropometrico.php" 
                      method="POST"
                      name="formRegistroAntropometrico"
                      onsubmit="return validaForm();"
                      onreset="return resetValidacao();">
             
                    <label for="aluno"> <em>*</em> Aluno:
                        <input type="text" name="aluno" value= "<?php echo $_SESSION["aluno"]; ?>"/>
                    </label>

                    <label for="matricula"> <em>*</em> Matrícula:
                        <input type="text" name="matricula" value= "<?php echo $_SESSION["matricula"]; ?>"/> 
                    </label>

                    <label for="nascimento"> <em>*</em> Data de Nascimento:
                        <input type="text" name="nascimento" 
                               onkeypress="return formatar(this, '##/##/####');" value= "<?php echo $_SESSION["nascimento"]; ?>"/>
                    </label>

                    <label for="sexo" value= "<?php echo $_SESSION["sexo"]; ?>"> <em>*</em> Sexo 
                        <select name="sexo">
                                <option value=""></option>
                                <option value="F"> Feminino </option>
                                <option value="M"> Masculino </option>
                        </select>
                        
                    </label>

                    <label for="nivel"> Nível 
                            <select name="nivel" value= "<?php echo $_SESSION["nivel"]; ?>">
                                    <option value=""></option>
                                    <option value="1"> Integrado </option>
                                    <option value="2"> Subseqüente </option>
                                    <option value="3"> Superior </option>
                            </select>
                    </label>

                    <!-- Validação inicial no lado do cliente -->
                    <label for= "peso"> <em>*</em> Peso:
                        <input type="text" name="peso" value= "<?php echo $_SESSION["peso"]; ?>" />; 
                       
                    </label>

                    <!-- Validação inicial no lado do cliente -->
                    <label for= "altura"> <em>*</em> Altura:
                        <input type="text" name="altura" value= "<?php echo $_SESSION["altura"]; ?>"/><br>
                    </label>

                    <input type="submit" value="Enviar"/>
                    <input type="reset" value="Limpar"/>
                </form>
            </div>
                            
            <div id="rodape">
                <p>
                    IFPB - Instituto Federal de Educação, Ciência e Tecnologia
                    <em>Campina Grande</em>
                </p>
                <p>
                    Copyright (c) 2013. Todos os direitos Reservados.
                </p>
            </div>
        </div>
    </body>
</html>