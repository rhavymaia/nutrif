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
    require_once ('util/date.php');
    
    //Inicialização de variáveis.
    $matr = $_POST['MatriculaDeBusca'];
    
   if (ehNumerico($matr)&& (strlen($matr) == TAM_MATRICULA)) {         
    
    //Fazer Conexão e consulta ao MySQL se matrícula for válida
    mysql_connect('localhost','nutrif_user','nutr1f_us3r') or die(mysql_error());
    mysql_select_db('nutrif') or die(mysql_error());
    
    $qry = mysql_query("SELECT nr_peso,nr_altura,dt_nascimento,tp_sexo 
                        FROM tb_entrevistado 
                        WHERE nr_matricula = $matr");
   } 

   if(mysql_num_rows($qry) > 0){   
    $num_fields = mysql_num_fields($qry);//Obtém o número de campos do resultado
    
    for($i = 0;$i<$num_fields; $i++){//Pega o nome dos campos
	$fields[] = mysql_field_name($qry,$i);
    }

    //Montando o cabeçalho da tabela
    $table = '<table border="1"><tr>';

    for($i = 0;$i < $num_fields; $i++){
	$table .= '<th>'.$fields[$i].'</th>';
    }
    
    echo "<li>Resultados da Pesquisa</li>";
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
        
    $peso = mysql_result($qry,0,"nr_peso");
    $altura = mysql_result($qry,0,"nr_altura");
    $data_nasc = mysql_result($qry,0,"dt_nascimento");
    $sexo = mysql_result($qry,0,"tp_sexo");
    
    $dataphp = formata_data($data_nasc);
    
    $imc = $peso/(pow($altura,2));
    
    echo ("<li>IMC: ".$imc."</li>");     
    echo ("<li>Data em formato PHP: ".$dataphp."</li>");
    echo ("<li>Idade em meses: ".getIdade($dataphp)."</li>");
    
    //Buscar percentil referente ao IMC idade e sexo

   }else{
        $msg = ("Nenhum dado encontrado!");        
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php"); 
   }
?>

<?php 
    // Rodapé da página html.
    require_once 'template/footer.php';
?>

