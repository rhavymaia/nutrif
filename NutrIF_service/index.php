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
    $slim->post('/analisarVCT','analisarVCT');
    $slim->post('/calcularIMC','calcularIMC');    
    
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
    
    /**
     * Analisar o Valor calórico total (VCT);
     * 
     * @param $aluno 
     * 	{
     *      'peso' : *[1-9].*[1-9],
     *      'alturaCm' : *[1-9].*[1-9],
     *      'sexo' : 'M' | 'F',
     *      'idade' : [1-9],
     *      'nivelEsporte' : [1-4]
     *  }
     * 
     * @return $vct 
     * {
     *      'vct' : *[1-9].*[1-9]
     * }
     */
    function analisarVCT(){
        $request = \Slim\Slim::getInstance()->request();
        $body = $request->getBody();        
        $aluno = json_decode($body);
        
        $aluno->peso;
        $aluno->alturaCm;
        $aluno->sexo;
        $aluno->idade; 
        $aluno->nivelEsporte;
        
        if($aluno->sexo == 'M'){
        $tmb = 655 + (9.6 *  $aluno->peso) + (1.8 *  $aluno->alturaCm) - (4.7 *  $aluno->idade);
              $vct = array(
                'vct' => $tmb * $aluno->nivelEsporte
            );
             
        }else{
         $tmb = 655 + (14 *  $aluno->peso) + (5 *  $aluno->alturaCm) - (6.7 *  $aluno->idade);  
            $vct = array(
                'vct' => $tmb * $aluno->nivelEsporte
            );
        }
        
        
        echoRespnse(HTTP_CRIADO, $vct);
       
        // Implementar lógica e negócio.
    }
    
    /**
     * 
     * @param $imc
     * {
     *      'idUsuario' : [1-9],
     *      'peso' : *[1-9].*[1-9],
     *      'alturaCm' : *[1-9].*[1-9],
     *      'idade': [1-9]
     * }
     */
    function calcularIMC() {
        $request = \Slim\Slim::getInstance()->request();
        $body = $request->getBody();        
        $imc = json_decode($body);
        
        $imc->idUsuario;
        $imc->peso;
        $imc->altura;
        $imc->idade; 
        
        // Sugestão de OO.
        $imcObjt = new Anamnese();
        
        // Implementar lógica do IMC. 
        
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
