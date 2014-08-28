<?php

    // Serviços
    require '../Slim/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();

    $slim = new \Slim\Slim();
    
    $slim->response()->header('Content-Type', 'application/json;charset=utf-8');
    
    $slim->get('/verificar', 'verificar');
    $slim->post('/cadastrarAluno','cadastrarAluno');
    
    $slim->run();
    
    // Funções    
    require_once ('database/dao.class.php');
    
    function verificar() {
	echo 'true';
    }
    
    function cadastrarAluno() {
        $request = \Slim\Slim::getInstance()->request();
        $aluno = json_decode($request->getBody());
        // Captura valores
        $aluno->nome;
        $aluno->media;
        
        // Revalida
        // Enviar para o Banco de dados
         $data_cadastro = array(
            'nr_matricula' => $matricula,
            'dt_nascimento' => $nascimento,
            'cd_nivelescolar' => $nivel,
            'nm_entrevistado' => $aluno
        );
        $dao = new dao_class();
        $id = $dao->inserirEntrevistado($data_cadastro);
        
        echo json_encode($aluno);
    }
?>
