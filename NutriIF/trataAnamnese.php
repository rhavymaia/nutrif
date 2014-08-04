<?php

    session_start();
    
    // Importa��o
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/date.php');
    require_once ('util/constantes.php');
    
    //Inicializa��o de vari�veis.
    $matricula = $_POST['matricula'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $esporte = $_POST['esporte'];

    //Verificar os campos obrigat�rios, os tipos e formatos dos dados avaliados
    if(validaFormRegistroAntropometrico()){
        
        $dao = new dao_class();
        
        //consultar cd_entrevistado pela matr�cula
        $rowEntrevistado = $dao->selectEntrevistado($matricula);
                
        $data_antropometria = array(
            'cd_entrevistado' => $rowEntrevistado['cd_entrevistado'],
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
       
        //jogar na sess�o as variaveis do formul�rio
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
            
            $msgErro = array('matricula' => "A matr�cula passada � inv�lida.");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        } 
         
        if (!ehPontoFlutuante($_POST['peso'])) {
            $msgErro = array('peso' => "O peso preenchido � inv�lido. O n�mero deve est� no formato \"0.0\".");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }
        
        if (!verificaAltura($_POST['altura'])) {
            $msgErro = array('altura' => "A altura preenchida � inv�lida. O n�mero deve estar em cm.");
            array_push($msgsErro, $msgErro);
            $ehValido = false;            
        }

        if (ehVazio($_POST['esporte'])) {
            $msgErro = array('esporte' => "Informe a quantidade de atividade f�sica realizada por semana.");
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
    }
?>


