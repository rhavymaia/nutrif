<?php
 // Cabe�alho e menu da p�gina html.
    require_once 'template/header.php';
    ?>

    <form action="resultado.php" method="post">

		Digite a matr�cula a ser procurada: 
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
    // Rodap� da p�gina html.
    require_once 'template/footer.php';
?>