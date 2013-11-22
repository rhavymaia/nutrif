<?php

session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('trataCalculaPercentilIMCIdade.php');

    function capturarCodigo($matricula) {

        $dao = new dao_class();

        $rowEntrevistado = $dao->selectEntrevistado($matricula);

        $codigo = $rowEntrevistado['cd_entrevistado'];
    
        return $codigo;
    }

    $matricula = $_POST['matricula'];
    
    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);

    $dados = capturarCodigo($matricula);
    
    $_SESSION['cod'] = $dados;
    $_SESSION['ind'] = 1;
    
    if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)){
    // Verificar se a checagem não gera problemas de tipo.
    if ($rowEntrevistado) {
    
     header("location: formPerfilAlimentarParte1.php");
     
    }  else{
        $msg = ("Matrícula não encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formPerfilAlimentarEntrevistado.php");
        }
    }else {
    $msg = ("Informe uma matrícula válida. Somente número são permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formPerfilAlimentarEntrevistado.php");
}
          
?>
