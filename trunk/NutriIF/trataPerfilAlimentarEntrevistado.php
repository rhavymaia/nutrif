<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

$matricula = $_POST['matricula'];

if (validaFormCalculaPercentilIMC($matricula)) {
    
    $codigoEntrevistado = consultarCodigoEntrevistado($matricula);
 
    $_SESSION['codigoEntrevistado'] = $codigoEntrevistado;
       
    // Verificar se a checagem n�o gera problemas de tipo.
    if ($codigoEntrevistado) {
        header("location: formPerfilAlimentarParte1.php");
    } else {
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formPerfilAlimentarEntrevistado.php");
    }
} else {
    header("location: formPerfilAlimentarEntrevistado.php");
}

function consultarCodigoEntrevistado($matricula) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);
    
     $codigo = $rowEntrevistado['cd_entrevistado'];

    return $codigo;
}

function validaFormCalculaPercentilIMC() {
        
        $ehValido = true;
        $msgsErro = array();
        
        $matricula = $_POST['matricula'];
        
        if (!ehNumerico($matricula) || !(strlen($matricula) == TAM_MATRICULA)) {
            
            $msgErro = array('matricula' => "Informe uma matr�cula v�lida. Somente n�mero s�o permitidos.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
}
?>
