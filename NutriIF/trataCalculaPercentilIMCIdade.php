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

   if (ehNumerico($matr)&& (strlen($matr) == TAM_MATRICULA)) {         
    
    $dao = new dao_class(); 
    $percentil = $dao->selectPercentil($matr);
    
    $vl_perc = $percentil['vl_percentil'];
    $cd_perc = $percentil['cd_percentil'];
      
    echo "<li>Resultados da Pesquisa</li>";
    echo "<li>Código do Percentil: ".$cd_perc."</li>";
    echo "<li>Valor do percentil: ".$vl_perc."</li>";
    
   }else{
        $msg = ("Preencha o campo matrícula com dado válido!");        
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php"); 
   }
?>

<?php 
    // Rodapé da página html.
    require_once 'template/footer.php';
?>

  




