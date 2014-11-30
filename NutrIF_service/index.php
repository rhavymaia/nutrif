<?php

// Entidades    
require_once './database/DbHandler.php';
require_once './util/Constantes.php';
require_once './util/DataUtil.php';
require_once './entidade/Server.class.php';
require_once './entidade/Entrevistado.class.php';
require_once './entidade/Usuario.class.php';
require_once './entidade/Percentil.class.php';
require_once './entidade/Vct.class.php';
require_once './entidade/Imc.class.php';
require_once './entidade/Anamnese.class.php';
require_once './entidade/Erro.class.php';
require_once './util/MapaErro.php';
require_once './util/JsonUtil.php';
require_once './util/NumeroUtil.php';
require_once './controller/PercentilController.php';
require_once './controller/IMCController.php';
require_once './controller/VCTController.php';
require_once './validate/LoginValidate.php';
require_once './validate/VCTValidate.php';

// Slim
require '../Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$slim = new \Slim\Slim();
$slim->get('/statusServer', 'statusServer');
$slim->post('/verificarLogin', 'verificarLogin'); //implementar oAuth
$slim->post('/cadastrarAluno', 'cadastrarAluno');
$slim->post('/cadastrarNutricionista', 'cadastrarNutricionista');
$slim->post('/cadastrarAnamnese', 'cadastrarAnamnese');
$slim->post('/cadastrarPesquisa', 'cadastrarPesquisa');
$slim->post('/calcularVCT', 'calcularVCT');
$slim->post('/calcularVCTAnamnese', 'calcularVCTAnamnese');
$slim->post('/calcularVCTAnamneses', 'calcularVCTAnamneses');
$slim->post('/calcularIMC', 'calcularIMC');

/**
 * Altenticação do usuário.
 * 
 * @param \Slim\Route $route
 */
function authenticate(\Slim\Route $route) {}

// Funções    
/**
 * Verificar status do servidor.
 * 
 */
function statusServer() {
    $server = new Server();
    $server->online = "true";
    
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
 * @return $aluno (http - 200)
 *  {
 *      idUsuario: [1-9],
 *      idEntrevistado: [1-9]
 *  }
 * @return $erro (http - 400)
 *  {
 *      codigo: [1-9],
 *      mensagem: "Erro"
 *  } 
 * @author Rhavy Maia Guedes rhavy.maia@gmail.com
 */
function cadastrarAluno() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $aluno = json_decode($body);

    //TODO: Validação do dados de entrada para o cadastro do entrevistado.  
    // Persistir os dados na tabela tb_usuario.
    $db = new DbHandler();
    $cdUsuario = $db->inserirUsuario($aluno, TP_ALUNO);

    if ($cdUsuario != ID_NAO_RETORNADO && $cdUsuario != USUARIO_EXISTENTE) {
        
        $aluno->idUsuario = $cdUsuario;
        $idEntrevistado = $db->inserirEntrevistado($aluno);

        if ($idEntrevistado != ENTREVISTADO_EXISTENTE) {
            // Entrevistado cadastrado com sucesso.
            $aluno->idEntrevistado = $idEntrevistado;
            $aluno->tpUsuario = TP_ALUNO;            
            echoRespnse(HTTP_CRIADO, $aluno);
        } else {
            // Entrevistado(a) já cadastrado(a).
            $erro = MapaErro::singleton()->getErro(5);
            echoRespnse(HTTP_CONFLITO, $erro);
        }
    } else if ($cdUsuario == USUARIO_EXISTENTE) {
        // Usuário já cadastrado.
        $erro = MapaErro::singleton()->getErro(4);
        echoRespnse(HTTP_CONFLITO, $erro);
    } else {
        // Impossivel criar usuario.
        $erro = MapaErro::singleton()->getErro(1);
        echoRespnse(HTTP_ERRO_INTERNO, $erro);
    }
}

/**
 * Cadastrar Nutricionista.
 * @param $nutricionista
 *  
 *  {
 *      nome: "valor",
 *      login: "user@local.com",
 *      senha: "valor",          
 *      crn: [4-10],
 *      siape: [8],
 *      nascimento: "dd/mm/YYYY",
 *      instituicao: [1-9]
 *      sexo: "M" | "F"         
 *  }
 *  
 * @return $nutricionista (http - 200)
 *  {
 *      idUsuario: [1-9],
 *      idNutricionista: [1-9]
 *  }
 * @return $erro (http - 400)
 *  {
 *      codigo: [1-9],
 *      mensagem: "Erro"
 *  } 
 * @author Larissa Félix larissafelix.felix@gmail.com
 */
function cadastrarNutricionista() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $nutricionista = json_decode($body);

    //TODO: Validação do dados de entrada para o cadastro do entrevistado.
    // Persistir os dados no Banco.
    $db = new DbHandler();
    $cd_usuario = $db->inserirUsuario($nutricionista, TP_NUTRICIONISTA);

    if ($cd_usuario != ID_NAO_RETORNADO && $cd_usuario != USUARIO_EXISTENTE) {
        
        $nutricionista->idUsuario = $cd_usuario;
        $id_nutricionista = $db->inserirNutricionista($nutricionista);

        if ($id_nutricionista != ENTREVISTADO_EXISTENTE) {
            
            $nutricionista->idNutricionista = $id_nutricionista;
            $nutricionista->tpUsuario = TP_NUTRICIONISTA;

            //Resposta com sucesso
            echoRespnse(HTTP_CRIADO, $nutricionista);
        } else {
            // Nutricionista já cadastrado(a).
            $erro = MapaErro::singleton()->getErro(6);
            echoRespnse(HTTP_CONFLITO, $erro);
        }
    } else if ($cd_usuario == USUARIO_EXISTENTE) {
        // Usuário já cadastrado.
        $erro = MapaErro::singleton()->getErro(4);
        echoRespnse(HTTP_CONFLITO, $erro);
    } else {
        // Impossivel criar usuario.
        $erro = MapaErro::singleton()->getErro(1);
        echoRespnse(HTTP_ERRO_INTERNO, $erro);
    }
}

/** @param $anamnese
  {
  "nutricionista": [1-9],
  "entrevistado": [1-9],
  "pesquisa": [1-9],
  "peso": [1-9],
  "altura": [1-9],
  "nivelEsporte": [1-5],
  "perfilAlimentar": [1-9]
  }
 */
function cadastrarAnamnese() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $anamnese = json_decode($body);

    //TODO: Validação do dados de entrada para o cadastro da anamnese.
    // Persistir os dados no Banco.
    $db = new DbHandler();
    $cdAnamnese = $db->inserirAnamnese($anamnese);

    if (!empty($cdAnamnese)) {
        echoRespnse(HTTP_CRIADO, $anamnese);
    } else {
        // Não foi possível encontrar anamnese.
        $erro = MapaErro::singleton()->getErro(9);
        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);       
    }
}

function cadastrarPesquisa() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $pesquisa = json_decode($body);

    //TODO: Validação do dados de entrada para o cadastro da pesquisa.
    // Persistir os dados no Banco.
    $db = new DbHandler();
    $cdPesquisa = $db->inserirPesquisa($pesquisa);

    if (empty($cdPesquisa)) {
        $erro = MapaErro::singleton()->getErro(10);
        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_CRIADO, $pesquisa);
    }
}

/**
 * Descrição
 * @param $usuario
 *  {
 *      'login':'valor',
 *      'senha':'valor'
 *  }
 * 
 * @return $usuario HTTP-202
 *  {
 *      codigo: 21,
 *      login: "user4@local.com",
 *      nome:"João Silva",
 *      tipoUsuario: "1",
 *      ativo: TRUE | FALSE,
 *  }
 * @return $erro HTTP-400
 */
function verificarLogin() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $usuarioJson = json_decode($body);

    $login = $usuarioJson->login;
    $senha = $usuarioJson->senha;

    // Validação do dados de entrada para o login do usuário.
    $validacao = LoginValidate::validate($login, $senha);
    
    if ($validacao == VALIDO) {
        
        $db = new DbHandler();
        $usuario = $db->selectLogin($login, $senha);

        if (!empty($usuario)) {
            // Dados do usuário.
            echoRespnse(HTTP_ACEITO, $usuario);            
        } else {
            // Usuário não encontrado e não autorizado.
            $erro = MapaErro::singleton()->getErro(2);
            echoRespnse(NAO_AUTORIZADO, $erro);            
        }
    } else {
        
        $erro = MapaErro::singleton()->getErro($validacao);
        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    }    
}

/**
 * 
 * Calcular os Valores Calóricos Totais baseado no peso, altura, nível esportivo
 * e data de nascimento do entrevistado.
 * 
 * @param $anamnese
 * {
 *  "peso": [0-9].[0-9],
 *  "altura": [0-9].[0-9], {cm}
 *  "nivelEsporte": 1 | 2 | 3,
 *  "entrevistado":{
 *      "nascimento": "YYYY/MM/DD",
 *      "sexo" 'M' | 'F':
 *  }
 * }
 * 
 * @return $vct
 * {
 *  "valor":[0-9].[0-9],
 *  "anamnese":{
 *      "entrevistado":{
 *          "nascimento":"YYYY/MM/DD",
 *          "sexo":'M' | 'F'},
 *      "peso":[0-9].[0-9],
 *      "altura":[0-9].[0-9],
 *      "nivelEsporte": 1 | 2 | 3
 *  }
 * }
 */
function calcularVCT() {

    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $anamneseJson = json_decode($body);

    // Entrevistado
    $nascimento = $anamneseJson->entrevistado->nascimento;
    $sexo = strtoupper($anamneseJson->entrevistado->sexo);

    // Anamnese.
    $peso = $anamneseJson->peso;
    $altura = $anamneseJson->altura;
    $nivelEsporte = $anamneseJson->nivelEsporte;

    // Validação dos dados: peso, altura, nível esportivo, sexo, data de
    // nascimento.
    
    $validacao = VCTValidate::validate($peso, $altura, $nivelEsporte, 
            $sexo, $nascimento);
    
    if ($validacao == VALIDO) {
        
        $anamnese = new Anamnese();
        $anamnese->setPeso($peso);
        $anamnese->setAltura($altura);
        $anamnese->setNivelEsporte($nivelEsporte);

        // Entrevistado
        $entrevistado = new Entrevistado();
        $entrevistado->setNascimento($nascimento);
        $entrevistado->setSexo($sexo);

        $anamnese->setEntrevistado($entrevistado);

        // Construir o JSON de resposta.
        $vct = VCTController::calculaVCT($anamnese);
        $vct->setAnamnese($anamnese);

        echoRespnse(HTTP_OK, $vct);
    } else {
        
        $erro = MapaErro::singleton()->getErro($validacao);
        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    }
}

/**
 * Analisar o Valor calórico total (VCT) de uma anamnese;
 * 
 * @param $anamnese 
 *  {
 *      "codigo"  : *[0-9]
 *  }
 * 
 * @return $vct
 * {
 *  "valor":[0-9].[0-9],
 *  "anamnese":{
 *      "entrevistado":{
 *          "nascimento":"YYYY/MM/DD",
 *          "sexo":'M' | 'F'},
 *      "peso":[0-9].[0-9],
 *      "altura":[0-9].[0-9],
 *      "nivelEsporte": 1 | 2 | 3
 *  }
 * }
 */
function calcularVCTAnamnese() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $anamnese = json_decode($body);

    $codigo = $anamnese->codigo;
    
    // Consultar a(s) anamnese(s) pelo código.
    $db = new DbHandler();
    $anamneseConsulta = $db->selectAnamnese($codigo);
    
    if (!empty($anamneseConsulta)) {
        $vct = VCTController::calculaVCT($anamneseConsulta);
        $vct->setAnamnese($anamneseConsulta);

        echoRespnse(HTTP_OK, $vct);
    } else {
        // Não foi possível encontrar anamnese.
        $erro = MapaErro::singleton()->getErro(8);        
        echoRespnse(HTTP_NAO_ENCONTRADO, $erro);
    }
}

/**
 * Analisar o Valor calórico total (VCT) das anamneses de um usuário (entrevistado);
 * 
 * @param $aluno 
 *  {
 *      "matricula"  : [1-4]
 *  }
 * 
 * @return $vct
 * {
 *  "valor":[0-9].[0-9],
 *  "anamnese":{
 *      "entrevistado":{
 *          "nascimento":"YYYY/MM/DD",
 *          "sexo":'M' | 'F'},
 *      "peso":[0-9].[0-9],
 *      "altura":[0-9].[0-9],
 *      "nivelEsporte": 1 | 2 | 3
 *  }
 * }
 */
function calcularVCTAnamneses() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $aluno = json_decode($body);

    $matricula = $aluno->matricula;

    // Consultar a(s) anamnese(s) do entrevistado.
    $db = new DbHandler();
    $anamneses = $db->selectAnamnesesEntrevistado($matricula);

    if (sizeof($anamneses) < 0) {
        
        $vcts = array();

        // Calcular vct para cada anamnese.    
        foreach ($anamneses as $anamnese) {

            $vct = VCTController::calculaVCT($anamnese);
            $vct->setAnamnese($anamnese);

            // Construir o JSON de resposta.
            array_push($vcts, $vct);
        }
        
        echoRespnse(HTTP_OK, $vcts);
        
    } else {
        // Não foi possível encontrar anamnese.
        $erro = MapaErro::singleton()->getErro(8);        
        echoRespnse(HTTP_NAO_ENCONTRADO, $erro);
    }
}

/**
 * Descrição
 * @param $entrevistado
 * {
 *  "peso" : *[1-9].*[1-9],
 *  "altura" : *[1-9].*[1-9]
 * }
 * 
 * @return @return $percentil HTTP-202
 * {
 *  "valor": *[1-9].*[1-9]
 * }
 */
function calcularIMC() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $entrevistado = json_decode($body);

    $peso = $entrevistado->peso;
    $altura = $entrevistado->altura;

    $valor = IMCController::calculaIMC($peso, $altura);
    
    if ($valor > 0) {
        // Enviar o IMC com seu valor.
        $imc = new Imc();
        $imc->setValor($valor);
        echoRespnse(HTTP_ACEITO, $imc);        
    } else {
        // Não foi possível calcular IMC.
        $erro = MapaErro::singleton()->getErro(7);
        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    }
}

/**
 * 
 * @param type $name Description
 * 
 * @return type Description
 */
function calcularPerfilAntropometrico() {
    
    // Anamnese: Peso, altura, idade, sexo
    
    // Acima de 19 calcular IMC.
    
    // Abaixo de 19 anos verificar percentil: IMC x Idade.
}

function calcularPerfilAntropometricoAnamnese() {
    
}

function echoRespnse($status_code, $response) {
    $slim = \Slim\Slim::getInstance();
    // Http response code    
    $slim->status($status_code);
    // setting response content type to json
    $slim->response()->header('Content-Type', 'application/json;charset=utf-8');
    // Chamada ao método estático para conversão de caracter UTF-8.
    // Tranforma o array ou objeto em JSON.
    echo json_encode(JsonUtil::objectToArray($response));
    //echo json_encode($response, JSON_HEX_QUOT | JSON_HEX_TAG);    
    //echo json_encode($response, JSON_FORCE_OBJECT, true);
    //echo Zend_Json::encode($response);

    $slim->stop();
}

$slim->run();
?>
