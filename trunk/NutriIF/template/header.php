<?php
require_once ('util/constantes.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>
            <?php
            echo PF_TITULO;
            ?>
        </title>        
        <script language="javascript" src="javascript/validacao.js"></script> 
        <script language="javascript" src="javascript/alerta.js"></script>

        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    </head>
    <body>
        <div id="top">
            <div class="container">
                <div id="logo"><a href="index.php"><img src="images/logo.png" ></a></div>
                <ul id="menu">
                   <!-- <li>
                        <a href="index.php">
                            <img src="images/home.png">  Home
                        </a> 
                    </li>-->

                    <?php
                    
                        session_start();

                        if (isset($_SESSION['logado']) && $_SESSION['logado'] == TRUE) {
                            
                            if($_SESSION['tp_usuario'] == TP_ALUNO){
                                 echo '<li>
                                        <a href="formPerfilAlimentarParte1.php">
                                            <img src="images/book-lines.png">  Perfil Alimentar
                                        </a>
                                    </li>';
                            }else{
                            echo '
                                    <li>
                                        <a href="formCalculaPercentilIMCIdade.php">
                                            <img src="images/rulers.png">  Cálculo do Percentil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formListarEntrevistado.php">
                                            <img src="images/search.png">  Listar Entrevistado
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formCalculaVCT.php">
                                            <img src="images/calc.png">  Cálculo do VCT
                                        </a>
                                    </li>                                                                       
                                    <li>
                                        <a href="formCadastrarNutricionista.php">
                                            <img src="images/cadas.png">  Cadastro de Nutricionista
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formCadastrarAluno.php">
                                            <img src="images/cadas.png">  Cadastro de Aluno
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formAnamnese.php">
                                            <img src="images/cadas.png">  Anamnese
                                        </a>
                                    </li>
                                    <li>
                                        <a href="formCadastrarPesquisa.php">
                                            <img src="images/cadas.png">  Cadastrar Pesquisa
                                        </a>
                                    </li>                                                                       
                                    <li>
                                        <a href="logout.php">
                                            <img src="images/locked.png">  Logout
                                        </a>
                                    </li>';
                            }
                        } else {
                            echo'<table style="float:right;">
                                    <tr><form action="trataLogin.php" method="POST" name="cadastro">

                                    <td><label for="login"> <em></em> Login:
                                       <input type="text" name="login" />
                                    </label></td>
                                     <td><label for="senha"> <em></em> Senha:
                                          <input type="password" name="senha" />
                                       </label>    </td>
                                       
                                       <td><input type="submit" value="Entrar" /></td>
                                    </tr>  
                                   
                                </table>';
                        }
                    ?>
                </ul>
                <div class="clear">
                    <!-- Vazio -->
                </div>
            </div>
        </div>
        <div id="content">
