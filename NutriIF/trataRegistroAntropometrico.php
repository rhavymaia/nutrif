<?php

    session_start();

    // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicialização de variáveis.
    $aluno = $_POST['aluno'];
    $matricula = $_POST['matricula'];
    $nascimento = $_POST['nascimento'];
    $sexo = $_POST['sexo'];
    $nivel = $_POST['nivel'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados
    if(!ehVazio($aluno) 
            && !ehVazio($matricula) 
            && !ehVazio($nascimento) 
            && !ehVazio($sexo)
            && !ehVazio($nivel)
            && ehPontoFlutuante($peso)
            && ehPontoFlutuante($altura)
            && verificaData($nascimento)
            &&(ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA))){
            
        $data = array(
            'nr_matricula' => $matricula,
            'dt_nascimento' => $nascimento,
            'nr_peso' => $peso,
            'cd_nivel' => $nivel,
            'nr_altura' => $altura,
            'tp_sexo' => $sexo,
            'tp_entrevistado' => TP_ALUNO
        );
        
        $dao = new dao_class();
        $id = $dao->inserirEntrevistado($data);
        
        
        
        
        if (ehNumerico($id)) {
           header("location: mensagem_sucesso.php");
           unset($_SESSION['erro']);
        } else {
           header("location: mensagem_erro.php"); 
           
           
        }      
    } else{
       
        //jogar na sessão as variaveis do formulário
        $_SESSION['peso']= $peso;
        $_SESSION['altura']= $altura;
        $_SESSION['nascimento']= $nascimento; 
        $_SESSION['aluno']= $aluno;
        $_SESSION['matricula']= $matricula;
        $_SESSION['nivel']= $nivel;
        $_SESSION['sexo']= $sexo;
         
             
        // É necessário que ao retorna para a página de cadastro dos dados
        // antropométricos os valores sejam preenchidos novamente.
        /*echo "<script>alert('Preencha todos os campos com dados válidos!'); 
            window.location.href='formRegistroAntropometrico.php';</script>";*/
        
        header("location: formRegistroAntropometrico.php");
        $_SESSION['erro']= "Preencha todos os campos com dados válidos!";
           
    }	
   
   
?>

	
