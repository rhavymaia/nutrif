<?php
 // Cabe�alho e menu da p�gina html.
    require_once 'template/header.php';
 ?>
<?php
    require_once ('database/connect.class.php');
    
    session_start();
    
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    
    //Inicializa��o de vari�veis.
    $matr = $_POST['MatriculaDeBusca'];

   if (ehNumerico($matr)&& (strlen($matr) == TAM_MATRICULA)) {         
    
    $dao = new dao_class(); 
    $percentil = $dao->selectPercentil($matr);
    
    $vl_perc = $percentil['vl_percentil'];
    $cd_perc = $percentil['cd_percentil'];
      
    echo "<li>Resultados da Pesquisa</li>";
    echo "<li>C�digo do Percentil: ".$cd_perc."</li>";
    echo "<li>Valor do percentil: ".$vl_perc."</li>";
    
   }else{
        $msg = ("Preencha o campo matr�cula com dado v�lido!");        
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php"); 
   }
?>

<?php 
    // Rodap� da p�gina html.
    require_once 'template/footer.php';
?>

  




