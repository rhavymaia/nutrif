<?php
    require_once './entidade/Server.class.php';
    // Slim
    require '../Slim/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();

    $slim = new \Slim\Slim();
    
    $slim->response()->header('Content-Type', 'application/json;charset=utf-8');
    
    $slim->get('/verificar', 'verificar');
    $slim->post('/cadastrarAluno','cadastrarAluno');    
    
    // Funções                   
    function verificar() {
        $server = new Server();
        $server->online = true;
        echoRespnse(201, $server);
    }

    function cadastrarAluno() {        
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
