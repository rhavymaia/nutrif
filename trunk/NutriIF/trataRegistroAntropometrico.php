<?php

    session_start();

    // Importaзгo
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicializaзгo de variбveis.
    $aluno = $_POST['aluno'];
    $matricula = $_POST['matricula'];
    $nascimento = $_POST['nascimento'];
    $sexo = $_POST['sexo'];
    $nivel = $_POST['nivel'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $esporte = $_POST['esporte'];

    //Verificar os campos obrigatуrios, os tipos e formatos dos dados avaliados
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
       
        //jogar na sessгo as variaveis do formulбrio
        $_SESSION['peso']= $peso;
        $_SESSION['altura']= $altura;
        $_SESSION['nascimento']= $nascimento; 
        $_SESSION['aluno']= $aluno;
        $_SESSION['matricula']= $matricula;
        $_SESSION['nivel']= $nivel;
        $_SESSION['sexo']= $sexo;
        $_SESSION['esporte']= $esporte;
        
        header("location: formRegistroAntropometrico.php");        
    }
    
    function validaFormRegistroAntropometrico() {
        
        $ehValido = true;
        $msgsErro = array();
    
        if (ehVazio($_POST['aluno'])) {
            
            $msgErro = array('aluno' => "O nome do aluno й invбlido.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        if (!ehNumerico($_POST['matricula']) 
                || (strlen($_POST['matricula']) != TAM_MATRICULA)
            ) {
            
            $msgErro = array('matricula' => "A matrнcula passada й invбlida.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        } 
        
        if (ehVazio($_POST['sexo'])) {
            $msgErro = array('sexo' => "O sexo selecionado й invбlido.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nivel'])) {
            $msgErro = array('nivel' => "O nнvel selecionado й invбlido.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (!ehPontoFlutuante($_POST['peso'])) {
            $msgErro = array('peso' => "O peso preenchido й invбlido. O nъmero deve estб no formato \"0.0\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (!ehPontoFlutuante($_POST['altura'])) {
            $msgErro = array('altura' => "A altura preenchida й invбlida. O nъmero deve estб no formato \"0.0\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nascimento']) || !verificaData($_POST['nascimento'])) {
            $msgErro = array('nascimento' => "A data de nascimento preenchida й invбlida."
                ."A data deve estб no formato \"dd/mm/aaaa\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }              
        
        if (ehVazio($_POST['esporte'])) {
            $msgErro = array('esporte' => "Informe a quantidade de atividade fнsica realizada por semana.");
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
?>