<?php

// Entidades    
require_once 'database/DbHandler.php';
require_once 'util/constantes.php';
require_once 'entidade/Server.class.php';
require_once './entidade/Usuario.class.php';
require_once './entidade/Percentil.class.php';
require_once './entidade/Erro.php';
require_once './util/JsonUtil.php';
require_once './util/funcoesPercentil.php';

// Slim
require '../Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$slim = new \Slim\Slim();
$slim->get('/statusServer', 'statusServer');
$slim->post('/cadastrarAluno', 'cadastrarAluno');
$slim->post('/cadastrarNutricionista', 'cadastrarNutricionista');
$slim->post('/analisarVCT', 'analisarVCT');
$slim->post('/calcularIMC', 'calcularIMC');
$slim->post('/verificarLogin', 'verificarLogin');
$slim->post('/verificarPercentil', 'verificarPercentil');
$slim->post('/cadastrarAnamnese', 'cadastrarAnamnese');
$slim->post('/verificarAnamnesesPercentilEntrevistado', 
        'verificarAnamnesesPercentilEntrevistado');
$slim->post('/cadastrarPesquisa', 'cadastrarPesquisa');


function authenticate(\Slim\Route $route) {
    
}

// Fun��es    
/**
 * Verificar status do servidor.
 */
function statusServer() {
    $server = new Server();
    $server->online = true;
    // Responder a requisi��o. C�digo HTTP (cabe�alho) e Entidade (Body - JSON).
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

    //TODO: Valida��o do dados de entrada para o cadastro do entrevistado.  
    // Persistir os dados na tabela tb_usuario.
    $db = new DbHandler();
    $cdUsuario = $db->inserirUsuario($aluno, TP_ALUNO);

    if ($cdUsuario != ID_NAO_RETORNADO && $cdUsuario != USUARIO_EXISTENTE) {
        $aluno->idUsuario = $cdUsuario;
        $idEntrevistado = $db->inserirEntrevistado($aluno);

        if ($idEntrevistado != ENTREVISTADO_EXISTENTE) {
            $aluno->idEntrevistado = $idEntrevistado;
            $aluno->tpUsuario = TP_ALUNO;
            // Resposta com sucesso.
            $aluno->mensagem = "Cadastro realizado com sucesso!";
            echoRespnse(HTTP_CRIADO, $aluno);
        } else {
            $erro = new Erro();
            $erro->codigo = 005;
            $erro->mensagem = "Entrevistado j� cadastrado.";
            echoRespnse(HTTP_CONFLITO, $erro);
        }
    } else if ($cdUsuario == USUARIO_EXISTENTE) {
        $erro = new Erro();
        $erro->codigo = 004;
        $erro->mensagem = "Usu�rio j� cadastrado.";
        echoRespnse(HTTP_CONFLITO, $erro);
    } else {
        $erro = new Erro();
        $erro->codigo = 001;
        $erro->mensagem = "Imposs�vel criar usu�rio.";
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
 * @author Larissa F�lix larissafelix.felix@gmail.com
 */
function cadastrarNutricionista() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $nutricionista = json_decode($body);

    //TODO: Valida��o do dados de entrada para o cadastro do entrevistado.
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
            $erro = new Erro();
            $erro->codigo = 005;
            $erro->mensagem = "Nutricionista j� cadastrado(a).";
            echoRespnse(HTTP_CONFLITO, $erro);
        }
    } else if ($cd_usuario == USUARIO_EXISTENTE) {
        $erro = new Erro();
        $erro->codigo = 004;
        $erro->mensagem = "Usu�rio j� cadastrado.";
        echoRespnse(HTTP_CONFLITO, $erro);
    } else {
        $erro = new Erro();
        $erro->codigo = 001;
        $erro->mensagem = "Imposs�vel criar usu�rio.";
        echoRespnse(HTTP_ERRO_INTERNO, $erro);
    }
}

/**
 * Analisar o Valor cal�rico total (VCT);
 * 
 * @param $aluno 
 *  {
 *      'peso' : *[1-9].*[1-9],
 *      'altura' : *[1-9].*[1-9],
 *      'sexo' : 'M' | 'F',
 *      'idade' : [1-9],
 *      'nivelEsporte' : [1-4]
 *  }
 * 
 * @return $vct 
 *  {
 *      'vct' : *[1-9].*[1-9]
 *  }
 */
function analisarVCT() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $aluno = json_decode($body);

    $peso = $aluno->peso;
    $alturaCm = ($aluno->altura * FATOR_CENTIMETRO);
    $idade = $aluno->idade;

    //TODO: Valida��o do dados de entrada.
    // Receber altura em metros e converter para cent�metros.
    if ($aluno->sexo == MASCULINO) {
        //TODO: Inserir explica��o da f�rmula;
        $tmb = 655 + (9.6 * $peso) + (1.8 * $alturaCm) - (4.7 * $idade);
    } else {
        //TODO: Inserir explica��o da f�rmula;
        $tmb = 655 + (14 * $peso) + (5 * $alturaCm) - (6.7 * $idade);
    }

    // Construir o JSON de resposta.
    $vct = array(
        'vct' => ($tmb * $aluno->nivelEsporte)
    );

    echoRespnse(HTTP_CRIADO, $vct);
}

/**
 * Descri��o
 * @param $entrevistado
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
    $entrevistado = json_decode($body);


    $peso = $entrevistado->peso;
    $altura = $entrevistado->altura;

    $imc = number_format($peso / pow($altura, 2), 1);

    // Construir o JSON de resposta.
    $jsonIMC = array(
        'imc' => $imc
    );
    echoRespnse(HTTP_CRIADO, $jsonIMC);
}

/**
 * Descri��o
 * @param $usuario
 *  {
 *      login:"valor",
 *      senha:"valor"
 *  }
 * 
 * @return $usuario HTTP-202
 *  {
 *      codigo: 21,
 *      login: "user4@local.com",
 *      nome:"Jo�o Silva",
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

    //TODO: Valida��o do dados de entrada para o login do usu�rio.

    $db = new DbHandler();
    $usuario = $db->selectLogin($login, $senha);

    if (empty($usuario)) {
        $erro = new Erro();
        $erro->codigo = 002;
        $erro->mensagem = "Usu�rio n�o encontrado.";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_ACEITO, $usuario->toArray());
    }
}

/**
 * Descri��o
 * @param $percentil
 *  {
 *    sexo: "M" | "F",
 *    idadeMeses: [1-9], 
 *    imc: [1-9] 
 *  }
 * 
 * @return $percentil HTTP-202
 *  {
 *      vlPercentil: [1-9],
 *      cdPercentil: [1-9],
 *      sexo: "M" | "F",
 *      imc: [1-9],
 *      idadeMeses": [1-9]
 * }
 * @return $erro HTTP-400
 */
function verificarPercentil() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $percentilJson = json_decode($body);

    $imc = $percentilJson->imc;
    $idadeMeses = $percentilJson->idadeMeses;
    $sexo = $percentilJson->sexo;

    //TODO: Valida��o do dados de entrada para o c�lulo do Percentil.

    $db = new DbHandler();
    $percentil = $db->selecionarPercentil($imc, $sexo, $idadeMeses);

    if (empty($percentil)) {
        $erro = new Erro();
        $erro->codigo = 003;
        $erro->mensagem = "Percentil n�o encontrado.";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_ACEITO, $percentil->toArray());
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

    //TODO: Valida��o do dados de entrada para o cadastro da anamnese.
    // Persistir os dados no Banco.
    $db = new DbHandler();
    $cdAnamnese = $db->inserirAnamnese($anamnese);

    if (empty($cdAnamnese)) {
        $erro = new Erro();
        $erro->codigo = 002;
        $erro->mensagem = "Problema ao inserir a anamnese.";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_CRIADO, $anamnese);
    }
}

/**
 * Inserir coment�rio da documenta��o.
 * {
 *  "matricula": *[1-9]
 * }
 */
function verificarAnamnesesPercentilEntrevistado() {
    
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $percentilJson = json_decode($body);

    $matricula = $percentilJson->matricula;

    // Consultar a(s) anamnese(s) do entrevistado.
    $db = new DbHandler();
    $anamneses = $db->selectAnamnesesEntrevistado($matricula);

    $percentis = array();
    $cars = array();

    // Calcular percentil para cada anamnese.
    foreach ($anamneses as $anamnese) {

        $anamnese = (object) $anamnese;

        $entrevistado = $anamnese->getEntrevistado();

        $peso = $anamnese->getPeso();

        $alturaMetros = ($anamnese->getAltura()) / 100;

        $sexo = $entrevistado->getSexo();

        $idadeMeses = converterData($entrevistado->getNascimento());

        // C�lculo do IMC
        $imc = number_format($peso / pow($alturaMetros, 2), 1);
        
        if ($idadeMeses <= IDADE_PERCENTIL_19) {         
            //pesquisar por percentil
            $percentil = $db->selecionarPercentil($imc, $sexo, $idadeMeses);
            
            if (!empty($percentil)) {
                array_push($percentis, $percentil);               
            } else {
                //echoRespnse(HTTP_ACEITO, array('a'=> 'AAA', 'b'=> 'AAA'));
                echoRespnse(HTTP_ACEITO, array('teste' => array('a'=> 'AAA', 'b'=> 'AAA')));
                //$percentil = calcularPercentilMargens($imc, $sexo, $idadeMeses);
                
                $teste = array("a"=> "AAA", "b"=> "AAA", "c"=> "AAA", "d"=> "AAA");
                //array_push($percentis, $teste);   
            }
        } else {
            array_push($percentis, $imc);
        }
    }
/*
    // Retornar percentis e anamneses.
    if (empty($percentis)) {
        $erro = new Erro();
        $erro->codigo = count($percentis);
        $erro->mensagem = "Percentil nao encontrado";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_ACEITO, $percentis);
    }*/
}

function cadastrarPesquisa() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $pesquisa = json_decode($body);

    //TODO: Valida��o do dados de entrada para o cadastro da pesquisa.
    // Persistir os dados no Banco.
    $db = new DbHandler();
    $cdPesquisa = $db->inserirPesquisa($pesquisa);

    if (empty($cdPesquisa)) {
        $erro = new Erro();
        $erro->codigo = 002;
        $erro->mensagem = "Problema ao inserir a pesquisa.";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_CRIADO, $pesquisa);
    }
}


function echoRespnse($status_code, $response) {
    $slim = \Slim\Slim::getInstance();
    // Http response code    
    $slim->status($status_code);
    // setting response content type to json
    $slim->response()->header('Content-Type', 'application/json;charset=utf-8');
    // Chamada ao m�todo est�tico para convers�o de caracter UTF-8.
    // Tranforma o array ou objeto em JSON.
    echo json_encode(JsonUtil::utf8json($response));
    $slim->stop();
}

$slim->run();
?>
