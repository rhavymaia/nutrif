<?php
 // Cabeçalho e menu da página html.
    require_once 'template/header.php';
    ?>

    <form action="resultado.php" method="post">

		Digite a matrícula a ser procurada: 
<input name="MatriculaDeBusca" type="text">
			<input type="submit" value="Buscar">

<?php /*
consultar o paciente na base de dados na tabela entrevistado;

data nascimento: YYYY-dd-mm;

sexo: 1 (masculino) e 2 (feminino)

peso: float;

altura: float;

calcular o IMC;

calcular a idade em meses;

buscar o percentil na base de dados: sexo, idade, imc
 */
?>
<?php 
    // Rodapé da página html.
    require_once 'template/footer.php';
?>