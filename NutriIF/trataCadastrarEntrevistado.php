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
   
    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados
    if(validaFormRegistroAntropometrico()){
            
        $data_cadastro = array(
            'nr_matricula' => $matricula,
            'dt_nascimento' => $nascimento,
            'cd_nivelescolar' => $nivel, 
            'tp_sexo' => $sexo,
            'nm_entrevistado' => $aluno
        );
        $dao1 = new dao_class();
        $id1 = $dao1->inserirEntrevistado($data_cadastro);
        
        if (ehNumerico($id1)) { 
           
             echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Cadastro realizado com sucesso!");';  
             echo 'window.location.href="formCadastrarEntrevistado.php";';
             echo '</script>'; 
        } else {           
            header("location: mensagem_erro.php");          
        }      
    } else{
       
        //jogar na sessão as variaveis do formulário   
        $_SESSION['nascimento']= $nascimento; 
        $_SESSION['aluno']= $aluno;
        $_SESSION['matricula']= $matricula;
        $_SESSION['nivel']= $nivel;
        $_SESSION['sexo']= $sexo;
        header("location: formCadastrarEntrevistado.php");        
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
        
        if (ehVazio($_POST['nascimento']) || !verificaData($_POST['nascimento'])) {
            $msgErro = array('nascimento' => "A data de nascimento preenchida é inválida."
                ."A data deve está no formato \"dd/mm/aaaa\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }              

        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
?>