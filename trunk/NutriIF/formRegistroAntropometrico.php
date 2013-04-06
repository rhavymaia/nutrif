<html>
<head>
<title>NUTRIF</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body background="img/back1.jpg">
	<div id="cabecalho">
		<div id="logo">
			<a href="#"><img src="img/logonutrif.png" wight="800" height="100"></a>
		</div>
  <br><br>
	</div>
	<div id="menu">
		<ul>
			<li><span><a href="index.php">Home</a></span></li>
			<li class="pagina_atual"><a href="#">Formulário</a></li>
		</ul>
	</div>
	<!-- fim menu -->
    <div id="tamanho">

	<!-- fim cabeçalho -->
       <!-- inicio pagina -->
	<div id="pagina">
       <!-- inicio barra lateral -->
  <div id="bar_lat"> 
  
	</div> 
       <!-- fim barra lateral -->
  <form action = "trataRegistroAntropometrico.php" method ="POST">
		<table>
			<label for="nome_aluno"> Nome do aluno:
				<input type="text" name="nome_aluno"/>
			</label><br><BR>
			
			<label for="matr_aluno"> Matrícula:
				<input type="text" name="matr_aluno"/>
			</label><br><BR>
			
			<label for="data_nasc"> Data de Nascimento:
				<input type="text" name="data_nasc"/>
			</label><br><BR>
			
			<label for= "peso"> Peso:
				<input type="text" name="peso"/><br>
			</label><br><BR>
			
			<label for= "altura"> Altura:
				<input type="text" name="altura"/><br>
			</label><br><BR>
  
			<input type="submit" value="Enviar"/>
  
		</table>	
					
		</form>
       <!-- fim pagina -->
<br><br>
<div id="rodape">
	<p>Copyright (c) 2013. Todos os direitos Reservados.<br><br>
  IFPB - Instituto Federal de Educação, Ciência e Tecnologia<br>Campus Campina Grande</p>  
  
  
</div>

</body>
</html>
