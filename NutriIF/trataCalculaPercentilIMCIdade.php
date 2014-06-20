<?php

session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');
require_once ('funcoesPercentil.php');

//Inicialização de variáveis.
$matricula = $_POST['matricula'];

if (validaFormCalculaPercentilIMC()) {
    
    // Verificar se a checagem não gera problemas de tipo.
    $rowEntrevistado = consultarEntrevistado($matricula);

    if ($rowEntrevistado) {

        $resultados = calcularPercentil($rowEntrevistado); 
        
        // Enviar para a próxima tela os valores
            $_SESSION['percentilMediano'] = $resultados['percentilMediano'];
            $_SESSION['percentilInferior'] = $resultados['percentilInferior'];
            $_SESSION['percentilSuperior'] = $resultados['percentilSuperior'];
            $_SESSION['perfilIMC'] = $resultados['perfilIMC'];
            $_SESSION['imc'] = $resultados['imc'];
          header("location: formCalculaPercentilIMCIdade.php");        
    } else {
        $msg = ("Matrícula não encontrada");
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
            
            $msgErro = array('matricula' => "Informe uma matrícula válida. Somente número são permitidos");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
}

?>