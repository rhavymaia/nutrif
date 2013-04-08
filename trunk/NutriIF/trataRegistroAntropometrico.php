<?php

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

    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados.
    if(!ehVazio($aluno) 
            && !ehVazio($matricula) 
            && !ehVazio($nascimento) 
            && !ehVazio($sexo)
            && !ehVazio($nivel)
            && !ehVazio($peso) 
            && !ehVazio($altura)
            && verificaData($nascimento)
            &&(ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA))){
            
        $data = array(
            'nr_matricula' => $matricula,
            'dt_nascimento' => $nascimento,
            'nr_peso' => $peso,
            'cd_nivel' => $nivel,
            'nr_altura' => $altura,
            'tp_sexo' => $sexo,
            'tp_entrevitado' => TP_ALUNO
        );
        
        $dao = new dao_class();
        $id = $dao->inserirEntrevistado($data);
        
        if (ehNumerico($id)) {
           header("location: mensagem_sucesso.php"); 
        } else {
           header("location: mensagem_erro.php"); 
        }      
    } else{
        
        // É necessário que ao retorna para a página de cadastro dos dados
        // antropométricos os valores sejam preenchidos novamente.
        echo "<script>alert('Preencha todos os campos com dados válidos!'); 
            window.location.href='formRegistroAntropometrico.php';</script>";
    }				
?>

	
