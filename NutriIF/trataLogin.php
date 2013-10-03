<?php
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    
    //Inicialização de variáveis.
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    if (validaFormLogin()){
        //Realizar consulta do login
        $dao = new dao_class();
        $rowLogin = $dao->selectLogin($login, $senha);
        
        if ($rowLogin){
            
        }else{

            $msgErro = array('aluno' => "O nome do aluno é inválido.");
            array_push($msgsErro, $msgErro);
           // $msg = array("Login e/ou senha inválida");
            $_SESSION['login'] = $login;
            $_SESSION['erro'] = $msg;
            header("location: login.php");
        }
    } else {
        
        header("location: login.php");  
    }
    
    function validaFormLogin(){
        $ehValido = true;
        $msgsErro = array();
    
        if (ehVazio($_POST['login'])) {
            
            $msgErro = array('login' => "Informe um login");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['senha'])) {
            
            $msgErro = array('senha' => "Informe a senha");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
    
?>
