<?php
    // Entidades
    require_once 'entidade/Server.class.php';
    require_once 'database/DbHandler.php';
    require_once 'util/constantes.php';
    
    // Slim
    require '../Slim/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();

    $slim = new \Slim\Slim();
    $slim->get('/verificar', 'verificar');
    $slim->post('/cadastrarAluno','cadastrarAluno');    
    
    function authenticate(\Slim\Route $route) {
    }

    // Fun��es                   
    function verificar() {
        $server = new Server();
        $server->online = true;
        
        // Responder a requisi��o. C�digo HTTP (cabe�alho) e Entidade (Body - JSON).
        echoRespnse(201, $server);
    }

    /**
     * Cadastrar Aluno.
     * @param $aluno
     *  {aluno:
     *      {
     *          nome: "valor"
     *          login: "user@local.com"
     *          senha: "valor"          
     *          matricula: [1-9]
     *          nascimento: "dd/mm/YYYY"
     *          nivel: [1-9]
     *          sexo: "M" | "F"         
     *      }
     *  }
     *  
     * @return 
     * @author Rhavy Maia Guedes rhavy.maia@gmail.com
     */
    function cadastrarAluno() {
        $request = \Slim\Slim::getInstance()->request();
        $body = $request->getBody();        
        $aluno = json_decode($body);
        
        // Persistir os dados no Banco.
        $db = new DbHandler();
        $cd_usuario = $db->inserirUsuario($aluno);

        $aluno->idUsuario = $cd_usuario;
        $id_entrevistado = $db->inserirEntrevistado($aluno);
        $aluno->idEntrevistado = $id_entrevistado;

        // Resposta
        echoRespnse(HTTP_CRIADO, $aluno);
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
