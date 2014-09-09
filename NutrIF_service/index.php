<?php
    // Entidades
    require_once 'entidade/Server.class.php';
    require_once 'database/DbHandler.php';
    require_once 'util/constantes.php';
    
    // Slim
    require '../Slim/Slim/Slim.php';
    \Slim\Slim::registerAutoloader();

    $slim = new \Slim\Slim();
    $slim->get('/statusServer', 'statusServer');
    $slim->post('/cadastrarAluno','cadastrarAluno');    
    
    function authenticate(\Slim\Route $route) {
    }

    // Funções    
    /**
     * Verificar status do servidor.
     */
    function statusServer() {
        $server = new Server();
        $server->online = true;    
        // Responder a requisição. Código HTTP (cabeçalho) e Entidade (Body - JSON).
        echoRespnse(HTTP_CRIADO, $server);
    }

    /**
     * Cadastrar Aluno.
     * @param $aluno
     *  
     *  {
     *      nome: "valor",
     *      login: "user@local.com",
     *      senha: "valor",          
     *      matricula: [1-9],
     *      nascimento: "dd/mm/YYYY",
     *      nivel: [1-3],
     *      sexo: "M" | "F"         
     *  }
     *  
     *  
     * @return $aluno (http - 200)
     *  {
     *      idUsuario: [1-9],
     *      idEntrevistado: [1-9]
     *  }
     * @return $erro (http - 400)
     *  {
     *      codigo: [1-9],
     *      mensagem: "Erro"
     * } 
     * @author Rhavy Maia Guedes rhavy.maia@gmail.com
     */
    function cadastrarAluno() {
        $request = \Slim\Slim::getInstance()->request();
        $body = $request->getBody();        
        $aluno = json_decode($body);
        
        // Persistir os dados no Banco.
        $db = new DbHandler();
        $cd_usuario = $db->inserirUsuario($aluno);
        
        if($cd_usuario != 0){
            $aluno->idUsuario = $cd_usuario;
            $id_entrevistado = $db->inserirEntrevistado($aluno);
            $aluno->idEntrevistado = $id_entrevistado;
            // Resposta
            echoRespnse(HTTP_CRIADO, $aluno);
        }else{
            $erro = array(
                "codigo" => 001,
                "mensagem" => "Impossivel criar usuario."
            );
            echoRespnse(HTTP_ERRO_INTERNO, $erro);            
        }        
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
