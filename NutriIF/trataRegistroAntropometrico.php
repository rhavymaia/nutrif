<?php

    session_start();

    // Importa��o
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicializa��o de vari�veis.
    $aluno = $_POST['aluno'];
    $matricula = $_POST['matricula'];
    $nascimento = $_POST['nascimento'];
    $sexo = $_POST['sexo'];
    $nivel = $_POST['nivel'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    //Verificar os campos obrigat�rios, os tipos e formatos dos dados avaliados
    if(validaFormRegistroAntropometrico()){
            
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
        } else {           
            header("location: mensagem_erro.php");          
        }      
    } else{
       
        //jogar na sess�o as variaveis do formul�rio
        $_SESSION['peso']= $peso;
        $_SESSION['altura']= $altura;
        $_SESSION['nascimento']= $nascimento; 
        $_SESSION['aluno']= $aluno;
        $_SESSION['matricula']= $matricula;
        $_SESSION['nivel']= $nivel;
        $_SESSION['sexo']= $sexo;
        
        header("location: formRegistroAntropometrico.php");        
    }
    
    function validaFormRegistroAntropometrico() {
        
        $ehValido = true;
        $msgsErro = array();
    
        if (ehVazio($_POST['aluno'])) {
            
            $msgErro = array('aluno' => "O nome do aluno � inv�lido.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        if (!ehNumerico($_POST['matricula']) 
                || (strlen($_POST['matricula']) != TAM_MATRICULA)
            ) {
            
            $msgErro = array('matricula' => "A matr�cula passada � inv�lida.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        } 
        
        if (ehVazio($_POST['sexo'])) {
            $msgErro = array('matricula' => "O sexo selecionado � inv�lido.");
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nivel'])) {
            $msgErro = array('matricula' => "O n�vel selecionado � inv�lido.");
            $ehValido = false;            
        }
        
        if (!ehPontoFlutuante($_POST['peso'])) {
            $msgErro = array('matricula' => "O peso preenchido � inv�lido. O n�mero deve est� no formato \"0.0\".");
            $ehValido = false;            
        }
        
        if (!ehPontoFlutuante($_POST['altura'])) {
            $msgErro = array('matricula' => "A altura preenchida � inv�lida. O n�mero deve est� no formato \"0.0\".");
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nascimento']) || !verificaData($_POST['nascimento'])) {
            $msgErro = array('matricula' => "A data de nascimento preenchida � inv�lida."
                ."A data deve est� no formato \"dd/mm/aaaa\".");
            $ehValido = false;            
        }              
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
?>

	
