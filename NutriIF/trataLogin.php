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
            
             echo '<script language="javascript" type="text/javascript">';  
             echo 'window.location.href="index.php";';
             echo '</script>';
             $_SESSION['id'] = $rowLogin['nm_login'];
             $_SESSION['tp_usuario'] = $rowLogin['cd_tipousuario'];
             $_SESSION['cd_usuario'] = $rowLogin['cd_usuario'];
             $_SESSION['logado'] = TRUE;
        }else{
             $msgsErro = array();
            $msgErro = array('errado' => "Login e/ou senha inválida");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;   
            $_SESSION['erro'] = $msgsErro;
            header("location: formLogin.php");  
        
        return $ehValido;
            /* echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Login e/ou senha inválida");';  
             echo 'window.location.href="formLogin.php";';
             echo '</script>';    */        
        }
    } else {
        
        header("location: formLogin.php");  
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
