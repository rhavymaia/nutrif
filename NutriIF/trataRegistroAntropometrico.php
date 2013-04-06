<?php

    // Importação
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    
    //Definir código para base de dados
    $nome = $_POST['nome_aluno'];
    $matricula = $_POST['matr_aluno'];
    $datanasc = $_POST['data_nasc'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];

    //Se todos os campos estiverem preenchidos, os tipos e formatos dos dados 
    //serão avaliados
    if(((!empty($nome)) 
            && (!empty($matricula)) 
            && (!empty($datanasc)) 
            && (!empty($peso)) 
            && (!empty($altura)))
            &&((strlen($nome)<=50)&&(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/',$datanasc))
                    &&(is_numeric($matricula))&& (strlen($matricula) == 11))){
                            
        header("location: mensagem.php");
        // Inserir no Banco de dados
        $data = array(
                'tp_entrevistado' => $_POST['entrevistado'],
                'tp_sexo' => $_POST['sexo'],
                'cd_nivel' => $_POST['nivel'], 
                'nr_serie' => $_POST['serie'],
                'dt_nascimento' => $_POST['dataNascimento'],
                'cd_municipio' => $_POST['municipio']
        );

        $dao = new dao_class();
        $id = $dao->inserirEntrevistado($data);
    }
    else{
        echo "<script>alert('Preencha todos os campos com dados válidos!'); window.location.href='formRegistroAntropometrico.php';</script>";
    }				
?>

	
