<?php

    session_start();
    
    // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicialização de variáveis.
    $aluno = $_POST['nome_aluno'];
    $matricula = $_POST['matricula'];
    $nascimento = $_POST['nascimento'];
    $sexo = $_POST['sexo'];
    $nivel = $_POST['nivel'];
    $senha1 = $_POST['senha1'];
    $senha2 = $_POST['senha2'];
    $login =  $_POST['login'];
    
    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados
    if(validaFormCadastrarAluno()){
        
        $dao =  new dao_class();
        
        $data_cadastro_usuario = array(
            'nm_login'=> $login,
            'nm_senha'=> $senha1
        );
        
        $id_usuario = $dao->inserirUsuario($data_cadastro_usuario);
            
        $data_cadastro = array(
            'nr_matricula' => $matricula,
            'dt_nascimento' => $nascimento,
            'cd_nivelescolar' => $nivel, 
            'tp_sexo' => $sexo,
            'nm_entrevistado' => $aluno,
            'cd_usuario' => $id_usuario
        );
        
        $dao1 = new dao_class();
        $id1 = $dao1->inserirEntrevistado($data_cadastro);
        
        //Inserir em tb_usuário e lembrar das chaves estrangeiras
        if (ehNumerico($id1)) {
            
             echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Cadastro realizado com sucesso!");';  
             echo 'window.location.href="formCadastrarAluno.php";';
             echo '</script>'; 
        } else {   
            header("location: mensagem_erro.php");          
        }      
    } else{
       
        //jogar na sessão as variaveis do formulário   
        $_SESSION['nascimento']= $nascimento; 
        $_SESSION['nome_aluno']= $aluno;
        $_SESSION['matricula']= $matricula;
        $_SESSION['nivel']= $nivel;
        $_SESSION['instituicao']= $instituicao;
        $_SESSION['sexo']= $sexo;
        $_SESSION['login']= $login;
        header("location: formCadastrarAluno.php");        
    }
    
    function validaFormCadastrarAluno() {
        
        $ehValido = true;
        $msgsErro = array();
    
        if (ehVazio($_POST['nome_aluno'])) {
            
            $msgErro = array('aluno' => "O nome do aluno é inválido.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        if (!ehNumerico($_POST['matricula']) 
                || (strlen($_POST['matricula']) != TAM_MATRICULA)
            ) {
            
            $msgErro = array('matricula' => "A matrícula passada é inválida.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        } 
        
        if (ehVazio($_POST['sexo'])) {
            $msgErro = array('sexo' => "O sexo selecionado é inválido.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nivel'])) {
            $msgErro = array('nivel' => "O nível selecionado é inválido.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nascimento']) || !verificaData($_POST['nascimento'])) {
            $msgErro = array('nascimento' => "A data de nascimento preenchida é inválida."
                ."A data deve está no formato \"dd/mm/aaaa\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['login'])) {
            $msgErro = array('login' => "Preencha o campo login.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
         if (ehVazio($_POST['senha1']) || ehVazio($_POST['senha2']) ) {
            $msgErro = array('senha' => "Preencha os dois campos senha!");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
         }
        
       /*if($_POST['senha1'] != $_POST['senha2']){
            echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("As senhas não conferem!");';  
             echo 'window.location.href="formCadastrarAluno.php";';
             echo '</script>'; 
            }*/
         
         if (!isValidEmail($_POST['login'])){
             $msgErro = array('email' => "formato de e-mail inválido!");
             array_push($msgsErro, $msgErro);
             $ehValido = false;  
         }

        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }

?>
