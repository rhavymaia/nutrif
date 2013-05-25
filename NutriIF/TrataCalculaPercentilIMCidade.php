<?php
$con = mysql_connect('localhost', 'Rhavy', '12345');
if (!$con) {
    die('Não foi possível conectar: ' . mysql_error());
}
echo 'Conexão bem sucedida';
mysql_close($con);
?>

<?php   

$query = ('SELECT sexo, idade, altura, peso FROM tb_entrevistado 
WHERE matricula = MatriculaDeBusca'); 


$result = mysql_query($query, $con);
?>


<?php

// Formata data dd/mm/aaaa para aaaa-mm-dd
function datasql($dataNascimento) {
	if (!empty($dataNascimento)){
	$p_dt = explode('/',$dataNascimento);
	$data_sql = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
	return $data_sql;
	}
}
function IMC($peso,$altura,$sexo){ 
            return $peso/(pow($altura,2));
}

/*
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
