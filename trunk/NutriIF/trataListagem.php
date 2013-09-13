<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

//Inicializa��o de vari�veis.
$matricula = $_POST['matricula'];

if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)) {

    $dao = new dao_class();

    $rowDados = $dao->selectEntrevistado($matricula);

    // Verificar se a checagem n�o gera problemas de tipo.
    if ($rowDados) {
        //$nr_matricula = $rowDados['nr_matricula'];
        $peso = $rowDados['nr_peso'];
        $alturaCm = $rowDados['nr_altura'];
        $sexo = $rowDados['tp_sexo'];
        $dtNascimento = $rowDados['dt_nascimento'];
        //$tp_entrevistado = $rowDados['tp_entrevistado'];
        //$cd_entrevistado = $rowDados['cd_entrevistado'];
        //$cd_nivel = $rowDados['cd_nivel'];
        
    } else {
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formListagem.php");
    }
} else {
    $msg = ("Informe uma matr�cula v�lida. Somente n�mero s�o permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formListagem.php");
}
?>
	