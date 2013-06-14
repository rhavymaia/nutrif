<?php
 // Cabe�alho e menu da p�gina html.
    require_once 'template/header.php';
 ?>
<?php
    session_start();
    
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    
    //Inicializa��o de vari�veis.
    $matr = $_GET['MatriculaDeBusca'];
    
    if (!ehNumerico($matr) 
                || (strlen($matr) != TAM_MATRICULA)
            ) {
        
        $msg = ("A matr�cula passada � inv�lida.");
        
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php");
        
        }         
?>

<?php 
    // Rodap� da p�gina html.
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
