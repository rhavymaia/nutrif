<?php

session_start();

// Cabe�alho e menu da p�gina html.
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
    // Verificar se a checagem n�o gera problemas de tipo.
    if ($rowEntrevistado) {
    
     header("location: formPerfilAlimentarParte1.php");
     
    }  else{
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formPerfilAlimentarEntrevistado.php");
        }
    }else {
    $msg = ("Informe uma matr�cula v�lida. Somente n�mero s�o permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formPerfilAlimentarEntrevistado.php");
}
          
?>
