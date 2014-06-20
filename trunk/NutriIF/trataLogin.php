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
            $vetor = array(
            'nome' => $rowLogin['nm_login']
             );
            $nome = $vetor['nome'];
             echo '<script language="javascript" type="text/javascript">';  
             echo 'window.location.href="index.php";';
             echo '</script>';
             $_SESSION['id'] = $vetor['nome'];
             $_SESSION['logado'] = TRUE;
        }else{

             echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Login e/ou senha inválida");';  
             echo 'window.location.href="formLogin.php";';
             echo '</script>';            
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
