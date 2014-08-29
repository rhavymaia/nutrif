<?php
    // Entidades
    require_once 'entidade/Server.class.php';
    // Slim
    require '../Slim/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();

    $slim = new \Slim\Slim();
    $slim->get('/verificar', 'verificar');
    $slim->post('/cadastrarAluno','cadastrarAluno');    
    
    function authenticate(\Slim\Route $route) {
    }

    // Funções                   
    function verificar() {
        $server = new Server();
        $server->online = true;
        
        // Responder a requisição. Código HTTP (cabeçalho) e Entidade (Body - JSON).
        echoRespnse(201, $server);
    }

    function cadastrarAluno() {
         $request = \Slim\Slim::getInstance()->request();
         $body = $request->getBody();
         $aluno = json_decode($body);
         
         // Persistir os dados no Banco.
         echoRespnse(201, $aluno);
    }
    
    function echoRespnse($status_code, $response) {
        $slim = \Slim\Slim::getInstance();
        // Http response code
        $slim->status($status_code);

        // setting response content type to json
        $slim->contentType('application/json');

        echo json_encode($response);
    }

    $slim->run();
?>
