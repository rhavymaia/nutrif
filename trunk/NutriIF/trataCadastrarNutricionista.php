<?php

    session_start();
    
    // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicialização de variáveis.
    $nome_nutri = $_POST['nome_nutri'];
    $instituicao = $_POST['instituicao'];
    $login = $_POST['login'];
    $senha1 = $_POST['senha1'];
    $senha2 = $_POST['senha2'];

    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados
    if(validaFormCadastrarNutricionista()){
          
        $dao = new dao_class();
        
        $data_cadastro_usuario = array(
            'nm_login'=> $login,
            'nm_senha'=> $senha1
        );
        
        $id_usuario = $dao->inserirUsuario($data_cadastro_usuario);
        
        //inserir no banco       
        $data_cadastro_nutri = array(
            'cd_usuario'=> $id_usuario,
            'nm_nutricionista'=> $nome_nutri       
        );        
        $id_nutri = $dao->inserirNutricionista($data_cadastro_nutri);
        
        if (ehNumerico($id_nutri)) {            
             echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Cadastro realizado com sucesso!");';  
             echo 'window.location.href="formCadastrarNutricionista.php";';
             echo '</script>';   
        } else {           
            header("location: mensagem_erro.php");          
        }      
             
    } else{
        //jogar na sessão as variaveis do formulário
        $_SESSION['nome_nutri']= $nome_nutri;
        $_SESSION['instituicao']= $instituicao;
        $_SESSION['login']= $login;   
        echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Preencha todos os campos obrigatórios!");';  
             echo 'window.location.href="formCadastrarNutricionista.php";';
             echo '</script>';      
    }
    
    function validaFormCadastrarNutricionista() {
        
        $ehValido = true;
    
        if ((ehVazio( $_POST['nome_nutri'])) || (ehVazio($_POST['instituicao'])) ||
            (ehVazio( $_POST['login'])) || (ehVazio($_POST['senha1'])) || (ehvazio($_POST['senha2']))) {
                 $ehValido = false;            
        }        
        return $ehValido;
    }
?>