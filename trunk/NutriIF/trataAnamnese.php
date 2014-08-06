<?php

    session_start();
    
    // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicialização de variáveis.
    $matricula = $_POST['matricula'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $esporte = $_POST['esporte'];

    //Verificar os campos obrigatórios, os tipos e formatos dos dados avaliados
    if(validaFormRegistroAntropometrico()){
        
        $dao = new dao_class();
        
        //consultar cd_entrevistado pela matrícula
        $rowEntrevistado = $dao->selectEntrevistado($matricula);
        
        $rowPerfilAlimentar = $dao->selecionarPerfilAlimentar($rowEntrevistado['cd_entrevistado']);
                
        $data_antropometria = array(
            'cd_entrevistado' => $rowEntrevistado['cd_entrevistado'],
            'cd_perfilalimentar' => $rowPerfilAlimentar['cd_perfilalimentar'],
            'nr_peso' => $peso,            
            'nr_altura' => $altura,
            'nr_nivel_esporte' => $esporte    
        );        
        
        $id = $dao->inserirDadosAntropometricos($data_antropometria);
        
        if (ehNumerico($id)) { 
           
             echo '<script language="javascript" type="text/javascript">';
             echo 'window.alert("Dados da anamnese cadastrados com sucesso!");';  
             echo 'window.location.href="formAnamnese.php";';
             echo '</script>'; 
         
        } else {           
            header("location: mensagem_erro.php");          
        }      
    } else{
       
        //jogar na sessão as variaveis do formulário
        $_SESSION['peso']= $peso;
        $_SESSION['altura']= $altura;
        $_SESSION['esporte']= $esporte;
        
        header("location: formRegistroAntropometrico.php");        
    }
    
    function validaFormRegistroAntropometrico() {
        
        $ehValido = true;
        $msgsErro = array();

        if (!ehNumerico($_POST['matricula']) 
                || (strlen($_POST['matricula']) != TAM_MATRICULA)
            ) {
            
            $msgErro = array('matricula' => "A matrícula passada é inválida.");
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

        if (ehVazio($_POST['esporte'])) {
            $msgErro = array('esporte' => "Informe a quantidade de atividade física realizada por semana.");
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
?>


