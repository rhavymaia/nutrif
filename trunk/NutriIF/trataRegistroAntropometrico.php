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
    $esporte = $_POST['esporte'];

    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados
    if(validaFormRegistroAntropometrico()){
            
        $data_cadastro = array(
            'nr_matricula' => $matricula,
            'dt_nascimento' => $nascimento,
            'cd_nivelescolar' => $nivel,
            'tp_sexo' => $sexo,
            'nm_entrevistado' => $aluno
        );
        
        $data_antropometria = array(
            'nr_peso' => $peso,            
            'nr_altura' => $altura,
            'tp_entrevistado' => TP_ALUNO,
            'nr_nivel_esporte' => $esporte    
        );
        
        $dao1 = new dao_class();
        $id1 = $dao1->inserirEntrevistado($data_cadastro);
        
        $dao2 = new dao_class();
        $id2 = $dao2->inserirDadosAntropometricos($data_antropometria);
        
        if (ehNumerico($id1)&& ehNumerico($id2)) { 
           
             echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Cadastro realizado com sucesso!");';  
             echo 'window.location.href="formRegistroAntropometrico.php";';
             echo '</script>'; 
          // header("location: formRegistroAntropometrico.php");     
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
        $_SESSION['esporte']= $esporte;
        
        header("location: formRegistroAntropometrico.php");        
    }
    
    function validaFormRegistroAntropometrico() {
        
        $ehValido = true;
        $msgsErro = array();
    
        if (ehVazio($_POST['aluno'])) {
            
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
        
        if (!ehPontoFlutuante($_POST['peso'])) {
            $msgErro = array('peso' => "O peso preenchido é inválido. O número deve está no formato \"0.0\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (!verificaAltura($_POST['altura'])) {
            $msgErro = array('altura' => "A altura preenchida é inválida. O número deve estar em cm.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (ehVazio($_POST['nascimento']) || !verificaData($_POST['nascimento'])) {
            $msgErro = array('nascimento' => "A data de nascimento preenchida é inválida."
                ."A data deve está no formato \"dd/mm/aaaa\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }              
        
        if (ehVazio($_POST['esporte'])) {
            $msgErro = array('esporte' => "Informe a quantidade de atividade física realizada por semana.");
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
?>