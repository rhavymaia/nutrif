<html>
    <head>
        <title>NutrIF</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    </head>
    
    <body background="img/back1.jpg">
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
            <form action = "trataRegistroAntropometrico.php" 
                  method ="POST">

                <label for="aluno"> <em>*</em> Aluno:
                    <input type="text" name="aluno"/>
                </label>

                <label for="matricula"> <em>*</em> Matrícula:
                    <input type="text" name="matricula"/>
                </label>

                <label for="nascimento"> <em>*</em> Data de Nascimento:
                    <input type="text" name="nascimento"/>
                </label>

                <label for="sexo"> <em>*</em> Sexo 
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
                
                <!-- Validação inicial no lado do cliente -->
                <label for= "peso"> <em>*</em> Peso:
                    <input type="text" name="peso"/><br>
                </label>

                <!-- Validação inicial no lado do cliente -->
                <label for= "altura"> <em>*</em> Altura:
                    <input type="text" name="altura"/><br>
                </label>

                <input type="submit" value="Enviar"/>
                <input type="reset" value="Limpar"/>
            </form>
        </div>

        <div id="rodape">
            <p>Copyright (c) 2013. Todos os direitos Reservados.<br><br>
                IFPB - Instituto Federal de Educação, Ciênncia e Tecnologia<br>Campus Campina Grande</p>
        </div>
    </body>
</html>
