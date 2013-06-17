<?php
 // Cabeçalho e menu da página html.
    require_once 'template/header.php';
 ?>
<?php
    require_once ('database/connect.class.php');
    
    session_start();
    
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    
    //Inicialização de variáveis.
    $matr = $_POST['MatriculaDeBusca'];
    
    if (!ehNumerico($matr) 
                || (strlen($matr) != TAM_MATRICULA)
            ) {
        
        $msg = ("A matrícula passada é inválida.");
        
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php");
        
        }  
      
    //Conexão e consulta ao MySQL
    mysql_connect('localhost','nutrif_user','nutr1f_us3r') or die(mysql_error());
    mysql_select_db('nutrif') or die(mysql_error());
    $qry = mysql_query("SELECT nr_peso,nr_altura,dt_nascimento,tp_sexo FROM tb_entrevistado WHERE nr_matricula = $matr");

    //Pegando os nomes dos campos
    $num_fields = mysql_num_fields($qry);//Obtém o número de campos do resultado

    for($i = 0;$i<$num_fields; $i++){//Pega o nome dos campos
	$fields[] = mysql_field_name($qry,$i);
    }

    //Montando o cabeçalho da tabela
    $table = '<table border="1"><tr>';

    for($i = 0;$i < $num_fields; $i++){
	$table .= '<th>'.$fields[$i].'</th>';
    }

    //Montando o corpo da tabela
    $table .= '<tbody>';
    while($r = mysql_fetch_array($qry)){
	$table .= '<tr>';
	for($i = 0;$i < $num_fields; $i++){
		$table .= '<td>'.$r[$fields[$i]].'</td>';
	}
	$table .= '</tr>';
}
    //Finalizando a tabela
    $table .= '</tbody></table>';

    //Imprimindo a tabela
        echo $table;  
?>

    <?php 
    // Rodapé da página html.
    require_once 'template/footer.php';
    ?>

<?php
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
