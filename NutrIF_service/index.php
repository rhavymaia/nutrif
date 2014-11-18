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
$slim->post('/calcularVCTDireto', 'calcularVCTDireto');
$slim->post('/calcularVCT', 'calcularVCT');
$slim->post('/calcularIMC', 'calcularIMC');
$slim->post('/verificarLogin', 'verificarLogin');
$slim->post('/verificarPercentil', 'verificarPercentil');
$slim->post('/cadastrarAnamnese', 'cadastrarAnamnese');
$slim->post('/verificarAnamnesesPercentilEntrevistado', 'verificarAnamnesesPercentilEntrevistado');
$slim->post('/cadastrarPesquisa', 'cadastrarPesquisa');

function authenticate(\Slim\Route $route) {
    
}

// Funções    
/**
 * Verificar status do servidor.
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
            $aluno->idEntrevistado = $idEntrevistado;
            $aluno->tpUsuario = TP_ALUNO;
            // Resposta com sucesso.
            $aluno->mensagem = "Cadastro realizado com sucesso!";
            echoRespnse(HTTP_CRIADO, $aluno);
        } else {
            $erro = new Erro();
            $erro->codigo = 005;
            $erro->mensagem = "Entrevistado já cadastrado.";
            echoRespnse(HTTP_CONFLITO, $erro);
        }
    } else if ($cdUsuario == USUARIO_EXISTENTE) {
        $erro = new Erro();
        $erro->codigo = 004;
        $erro->mensagem = "Usuário já cadastrado.";
        echoRespnse(HTTP_CONFLITO, $erro);
    } else {
        $erro = new Erro();
        $erro->codigo = 001;
        $erro->mensagem = "Impossivel criar usuario.";
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
            $erro = new Erro();
            $erro->codigo = 005;
            $erro->mensagem = "Nutricionista ja cadastrado(a).";
            echoRespnse(HTTP_CONFLITO, $erro);
        }
    } else if ($cd_usuario == USUARIO_EXISTENTE) {
        $erro = new Erro();
        $erro->codigo = 004;
        $erro->mensagem = "Usuario ja cadastrado.";
        echoRespnse(HTTP_CONFLITO, $erro);
    } else {
        $erro = new Erro();
        $erro->codigo = 001;
        $erro->mensagem = "Impossivel criar usuario.";
        echoRespnse(HTTP_ERRO_INTERNO, $erro);
    }
}

/**
 * Analisar o Valor calórico total (VCT);
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
function calcularVCT() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $aluno = json_decode($body);

    $matricula = $aluno->matricula;

    // Consultar a(s) anamnese(s) do entrevistado.
    $db = new DbHandler();
    $anamneses = $db->selectAnamnesesEntrevistado($matricula);

    $vcts = array();

    $anamnese = new Anamnese();

    // Calcular vct para cada anamnese.
    
    foreach ($anamneses as $anamnese) {

        $anamnese = (object) $anamnese;

        $entrevistado = $anamnese->getEntrevistado();

        $peso = $anamnese->getPeso();

        $altura = ($anamnese->getAltura());

        $sexo = $entrevistado->getSexo();

        $idade = converterData($entrevistado->getNascimento())/12;

        $nivelEsporte = $anamnese->getNivelEsporte();

        $vlNivelEsporte = 1;
        $tmb = 0;

        //Verificando valores para os níveis de atividade física
        if ($nivelEsporte == 1) {
            if ($sexo == "M") {
                $vlNivelEsporte = 1.55;
            } else
            if ($sexo == "F")
                $vlNivelEsporte = 1.56;
        }else
        if ($nivelEsporte == 2) {
            if ($sexo == "M")
                $vlNivelEsporte = 1.78;
            else
            if ($sexo == "F")
                $vlNivelEsporte = 1.64;
        }else
        if ($nivelEsporte == 3) {
            if ($sexo == "M")
                $vlNivelEsporte = 2.10;
            else
            if ($sexo == "F")
                $vlNivelEsporte = 1.82;
        }

        if ($sexo == "M") {
            if ($idade >= 10 && $idade < 18)
                $tmb = (16.6 * $peso) + (77 * $altura + 572);
            else
            if ($idade >= 18 && $idade < 30)
                $tmb = (15.4 * $peso) + (27 * $altura + 717);
            else
            if ($idade >= 30 && $idade <= 60)
                $tmb = (11.3 * $peso) + (16 * $altura + 901);
            else
            if ($idade > 60)
                $tmb = (8.8 * $peso) + (1.128 * $altura - 1071);
        }else
        if ($sexo == "F") {
            if ($idade >= 10 && $idade < 18)
                $tmb = (7.4 * $peso) + (482 * $altura + 217);
            else
            if ($idade >= 18 && $idade < 30)
                $tmb = (13.3 * $peso) + (334 * $altura + 35);
            else
            if ($idade >= 30 && $idade <= 60)
                $tmb = (8.7 * $peso) - (255 * $altura + 865);
            else
            if ($idade > 60)
                $tmb = (9.2 * $peso) + (637 * $altura - 302);
        }

        $vct = $tmb * $vlNivelEsporte;

        $vcts = array();            
        // Construir o JSON de resposta.
        $vcts = array_push($vcts, $vct);
    }

    echoRespnse(HTTP_CRIADO, $vcts);
}

function calcularVCTDireto() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $aluno = json_decode($body);

    $peso = $aluno->peso;
    $altura = $aluno->altura;
    $idade = $aluno->idade;
    $nivelEsporte = $aluno->nivelEsporte;
    $sexo = $aluno->sexo;

    $vlNivelEsporte = 0;
    $tmb = 0;

    //Verificando valores para os níveis de atividade física
    if ($nivelEsporte == 1) {
        if ($sexo == "M") {
            $vlNivelEsporte = 1.55;
        } else
        if ($sexo == "F")
            $vlNivelEsporte = 1.56;
    }else
    if ($nivelEsporte == 2) {
        if ($sexo == "M")
            $vlNivelEsporte = 1.78;
        else
        if ($sexo == "F")
            $vlNivelEsporte = 1.64;
    }else
    if ($nivelEsporte == 3) {
        if ($sexo == "M")
            $vlNivelEsporte = 2.10;
        else
        if ($sexo == "F")
            $vlNivelEsporte = 1.82;
    }

    if ($sexo == "M") {
        if ($idade >= 10 && $idade < 18)
            $tmb = (16.6 * $peso) + (77 * $altura + 572);
        else
        if ($idade >= 18 && $idade < 30)
            $tmb = (15.4 * $peso) + (27 * $altura + 717);
        else
        if ($idade >= 30 && $idade <= 60)
            $tmb = (11.3 * $peso) + (16 * $altura + 901);
        else
        if ($idade > 60)
            $tmb = (8.8 * $peso) + (1.128 * $altura - 1071);
    }else
    if ($sexo == "F") {
        if ($idade >= 10 && $idade < 18)
            $tmb = (7.4 * $peso) + (482 * $altura + 217);
        else
        if ($idade >= 18 && $idade < 30)
            $tmb = (13.3 * $peso) + (334 * $altura + 35);
        else
        if ($idade >= 30 && $idade <= 60)
            $tmb = (8.7 * $peso) - (255 * $altura + 865);
        else
        if ($idade > 60)
            $tmb = (9.2 * $peso) + (637 * $altura - 302);
    }
    // Construir o JSON de resposta.
    $vct = array(
        'vct' => (double) ($tmb * $vlNivelEsporte)
    );

    echoRespnse(HTTP_CRIADO, $vct);
}

/**
 * Descrição
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
    $dadosIMC = json_decode($body);
    $imc = 0;

    $peso = $dadosIMC->peso;
    $altura = $dadosIMC->altura;

    if (($peso > 0) && ($altura > 0))
        $imc = (double) number_format($peso / pow($altura, 2), 1);

    if ($imc <= 0) {
        $erro = new Erro();
        $erro->codigo = 002;
        $erro->mensagem = "Nao foi possivel calcular IMC!";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        // Construir o JSON de resposta.
        $jsonIMC = array(
            'imc' => $imc
        );

        echoRespnse(HTTP_ACEITO, $jsonIMC);
    }
}

/**
 * Descrição
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

    //TODO: Validação do dados de entrada para o login do usuário.

    $db = new DbHandler();
    $usuario = $db->selectLogin($login, $senha);

    if (empty($usuario)) {
        $erro = new Erro();
        $erro->codigo = 002;
        $erro->mensagem = "Usuário não encontrado.";

        echoRespnse(HTTP_REQUISICAO_INVALIDA, $erro);
    } else {
        echoRespnse(HTTP_ACEITO, $usuario->toArray());
    }
}

/**
 * Descrição
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

    //TODO: Validação do dados de entrada para o cálulo do Percentil.

    $db = new DbHandler();
    $percentil = $db->selecionarPercentil($imc, $sexo, $idadeMeses);

    if (empty($percentil)) {
        $erro = new Erro();
        $erro->codigo = 003;
        $erro->mensagem = "Percentil nao encontrado.";

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

    //TODO: Validação do dados de entrada para o cadastro da anamnese.
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
 * Inserir comentário da documentação.
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

    // Calcular percentil para cada anamnese.
    foreach ($anamneses as $anamnese) {

        $anamnese = (object) $anamnese;

        $entrevistado = $anamnese->getEntrevistado();

        $peso = $anamnese->getPeso();

        $alturaMetros = ($anamnese->getAltura()) / 100;

        $sexo = $entrevistado->getSexo();

        $idadeMeses = converterData($entrevistado->getNascimento());

        // Cálculo do IMC
        $imc = number_format($peso / pow($alturaMetros, 2), 1);

        if ($idadeMeses <= IDADE_PERCENTIL_19) {
            //pesquisar por percentil
            $percentil = $db->selecionarPercentil($imc, $sexo, $idadeMeses);

            if (!empty($percentil)) {
                array_push($percentis, $percentil);
            } else {

                $percentil = calcularPercentilMargens($imc, $sexo, $idadeMeses);
                array_push($percentis, $percentil);
                echoRespnse(HTTP_ACEITO, $percentis);
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
      } */
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
