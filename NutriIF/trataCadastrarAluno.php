<?php

require_once 'restclient/restclient.php';
session_start();

// Importa��o
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

//Inicializa��o de vari�veis.
$aluno = $_POST['nome_aluno'];
$matricula = $_POST['matricula'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
$nivel = $_POST['nivel'];
$senha1 = $_POST['senha1'];
$login = $_POST['login'];

//Verificar os campos obrigat�rios, os tipos e formatos dos dados avaliados

if (validarCamposNaoVazios()) {

    if (validaFormCadastrarAluno()) {

        $json = array(
            "nome" => $aluno,
            "login" => $login,
            "senha" => $senha1,
            "matricula" => $matricula,
            "nascimento" => $nascimento,
            "nivel" => $nivel,
            "sexo" => $sexo
        );


        // Instacia��o do objeto RestClient. A url base � passada como par�metro 
        // via array.
        $restClient = new RestClient(
                array('base_url' => "http://localhost/NutrIF_service")
        );

        /*
         * Informar qual � o servi�o ('cadastrarAluno'), os dados do json ($json) e
         * o header do HTTP ($header);
         */
        $header = array('user_agent' => "nutrif-php/1.0", 'content-type' => "application/json");
        // M�todo POST.
        $result = $restClient->post('cadastrarAluno', $json, $header);
        $code = $result->info->http_code;


        if ($code == 200 || $code == 201) {

            echo '<script language="javascript" type="text/javascript">';
            echo 'window.alert("Cadastro realizado com sucesso!");';
            echo 'window.location.href="index.php";';
            echo '</script>';
        } else {
            header("location: mensagem_erro.php");
        }
    } else {

        //jogar na sess�o as variaveis do formul�rio  
        $_SESSION['nascimento'] = $nascimento;
        $_SESSION['nome_aluno'] = $aluno;
        $_SESSION['matricula'] = $matricula;
        $_SESSION['nivel'] = $nivel;
        $_SESSION['sexo'] = $sexo;
        $_SESSION['login'] = $login;
        header("location: formCadastrarAluno.php");
    }
} else {
    //jogar na sess�o as variaveis do formul�rio  
    $_SESSION['nascimento'] = $nascimento;
    $_SESSION['nome_aluno'] = $aluno;
    $_SESSION['matricula'] = $matricula;
    $_SESSION['nivel'] = $nivel;
    $_SESSION['sexo'] = $sexo;
    $_SESSION['login'] = $login;

    echo '<script language="javascript" type="text/javascript">';
    echo 'window.alert("Preencha todos os campos obrigat�rios");';
    echo 'window.location.href="formCadastrarAluno.php";';
    echo '</script>';
}

function validaFormCadastrarAluno() {

    $ehValido = true;
    $msgsErro = array();

    if (!ehNumerico($_POST['matricula']) || (strlen($_POST['matricula']) != TAM_MATRICULA)
    ) {

        $msgErro = array('matricula' => "A matr�cula passada � inv�lida.");
        array_push($msgsErro, $msgErro);

        $ehValido = false;
    }

    if ($_POST['senha1'] != $_POST['senha2']) {
        $msgErro = array('senhas' => "As senhas n�o conferem!");
        array_push($msgsErro, $msgErro);
        $ehValido = false;
    }

    $_SESSION['erro'] = $msgsErro;

    return $ehValido;
}

function validarCamposNaoVazios() {

    $ehValido = true;

    if (ehVazio($_POST['nome_aluno']) || ehVazio($_POST['matricula']) ||
            ehVazio($_POST['sexo']) || ehVazio($_POST['senha1']) || ehvazio($_POST['senha2']) ||
            ehVazio($_POST['nascimento']) || ehVazio($_POST['login'])) {
        $ehValido = false;
    }
    return $ehValido;
}

?>
