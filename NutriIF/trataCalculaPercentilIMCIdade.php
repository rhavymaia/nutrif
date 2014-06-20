<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('funcoesPercentil.php');

//Inicializa��o de vari�veis.
$matricula = $_POST['matricula'];

if (validaFormCalculaPercentilIMC()) {
    
    // Verificar se a checagem n�o gera problemas de tipo.
    $rowEntrevistado = consultarEntrevistado($matricula);

    if ($rowEntrevistado) {

        $resultados = calcularPercentil($rowEntrevistado); 
        
        // Enviar para a pr�xima tela os valores
            $_SESSION['percentilMediano'] = $resultados['percentilMediano'];
            $_SESSION['percentilInferior'] = $resultados['percentilInferior'];
            $_SESSION['percentilSuperior'] = $resultados['percentilSuperior'];
            $_SESSION['perfilIMC'] = $resultados['perfilIMC'];
            $_SESSION['imc'] = $resultados['imc'];
          header("location: formCalculaPercentilIMCIdade.php");        
    } else {
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php");
    }
} else {
    header("location: formCalculaPercentilIMCIdade.php");
}

function validaFormCalculaPercentilIMC() {
        
        $ehValido = true;
        $msgsErro = array();
        
        $matricula = $_POST['matricula'];
        
        if (!ehNumerico($matricula) || !(strlen($matricula) == TAM_MATRICULA)) {
            
            $msgErro = array('matricula' => "Informe uma matr�cula v�lida. Somente n�mero s�o permitidos");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
}

?>