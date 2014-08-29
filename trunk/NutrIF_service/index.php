<?php
    // Entidades
    require_once 'entidade/Server.class.php';
    require_once 'database/dao.class.php';
    require_once 'util/constantes.php';
    
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

    /**
     * Cadastrar Aluno.
     * @param $aluno
     *  {aluno:
     *      {
     *          nome: "valor"
     *          login: "user@local.com"
     *          senha: "valor"          
     *          matricula: [1-9]
     *          nascimento: dd/mm/YYYY
     *          nivel: [1-9]
     *          sexo: 'M' | 'F'         
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
        $dao =  new dao_class();
        $data_cadastro_usuario = array(
            'cd_tipousuario'=> TP_ALUNO,
            'nm_login'=> $aluno->login,
            'nm_senha'=> $aluno->senha
        );
        //$id_usuario = $dao->inserirUsuario($data_cadastro_usuario);

        $data_cadastro = array(
            'nr_matricula' => $aluno->matricula,
            'dt_nascimento' => $aluno->nascimento,
            'cd_nivelescolar' => $aluno->nivel, 
            'tp_sexo' => $aluno->sexo,
            'nm_entrevistado' => $aluno->nome
        );        
        //$id_entrevistado = $dao->inserirEntrevistado($data_cadastro);

         // Resposta
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
