<?php

require_once './util/Constantes.php';
require_once './entidade/Usuario.class.php';
require_once './entidade/Pesquisa.class.php';
require_once './entidade/Entrevistado.class.php';
require_once './entidade/Anamnese.class.php';
require_once './util/PassHash.php';

/**
 * Descrição
 *
 * @author Rhavy Maia rhavy.maia@gmail.com
 * @author Larissa Félix
 * @author Elias Gabriel Almeida
 * @link URL Tutorial link
 */
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';

        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /**
     * Inserir o usuário.
     * @param type $usuario
     */
    public function inserirUsuario($usuario, $tipoUsuario) {

        //caso usuário não seja criado o valor 0 será atribuído
        $cdUsuario = ID_NAO_RETORNADO;

        if (!$this->ehUsuarioExistente($usuario->login)) {
            // Caso o usuário não exista será construída o Insert na tb_usuario.
            $stmt = $this->conn->prepare("INSERT INTO tb_usuario(nm_login, "
                    . "nm_senha, nm_apikey, nm_usuario, dt_nascimento,"
                    . " nm_sexo, cd_tipousuario, fl_ativo)"
                    . " values(?, ?, ?, ?, ?, ?, " . $tipoUsuario . ", "
                    . USUARIO_ATIVO . ")");

            $nascimento = $data = implode("-", array_reverse(explode("/", $usuario->nascimento)));
            $sexo = strtoupper($usuario->sexo);
            
            $passwordHash = PassHash::hash($usuario->senha);
            $apiKey = $this->gerarApiKey();

            // Parâmetros: tipos das entradas, entradas.
            $stmt->bind_param("ssssss", $usuario->login, $passwordHash, 
                    $apiKey, $usuario->nome, $nascimento, $sexo);           

            // Executar a consulta.
            $result = $stmt->execute();
            if ($result) {
                $cdUsuario = $stmt->insert_id;
            }
            $stmt->close();
        } else {
            // Código para usuário já existente.
            $cdUsuario = USUARIO_EXISTENTE;
        }

        return $cdUsuario;
    }

    /**
     * Verifica login(e-mail) baseado em e-mail duplicado no banco.
     * 
     * @param String $login
     * @return boolean
     */
    private function ehUsuarioExistente($login) {
        $stmt = $this->conn->prepare("SELECT usuario.cd_usuario "
                . "FROM tb_usuario AS usuario "
                . "WHERE usuario.nm_login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Generating random Unique MD5 String for user Api key
     */
    private function gerarApiKey() {
        return md5(uniqid(rand(), true));
    }

    /**
     * Inserir entrevistado.
     * @param type $entrevistado
     * @return type
     */
    public function inserirEntrevistado($entrevistado) {

        $cdEntrevistado = ID_NAO_RETORNADO;

        if (!$this->ehEntrevistadoExistente($entrevistado->matricula)) {
            // insert query
            $stmt = $this->conn->prepare("INSERT INTO"
                    . " tb_entrevistado(cd_usuario, nr_matricula,"
                    . " cd_nivelescolar)"
                    . " values(?, ?, ?)");

            // Parâmetros: tipos das entradas, entradas.
            $stmt->bind_param("iii", $entrevistado->idUsuario, $entrevistado->matricula, $entrevistado->nivel);

            $result = $stmt->execute();
            if ($result) {
                $cdEntrevistado = $stmt->insert_id;
            }

            $stmt->close();
        } else {
            $cdEntrevistado = ENTREVISTADO_EXISTENTE;
        }

        return $cdEntrevistado;
    }

    /**
     * 
     * @param type $matricula
     * @return type
     */
    private function ehEntrevistadoExistente($matricula) {

        $stmt = $this->conn->prepare("SELECT entrevistado.cd_entrevistado "
                . "FROM tb_entrevistado AS entrevistado "
                . "WHERE entrevistado.nr_matricula = ?");
        $stmt->bind_param("i", $matricula);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * 
     * @param type $nutricionista
     * @return type
     */
    public function inserirNutricionista($nutricionista) {

        $cdNutricionista = ID_NAO_RETORNADO;

        if (!$this->ehNutricionistaExistente($nutricionista->crn, $nutricionista->siape)) {
            // insert query
            $stmt = $this->conn->prepare("INSERT INTO"
                    . " tb_nutricionista(cd_usuario, nm_crn, nm_siape,"
                    . " cd_instituicao)"
                    . " values(?, ?, ?, ?)");

            // Parâmetros: tipos das entradas, entradas.
            $stmt->bind_param("iiii", $nutricionista->idUsuario, $nutricionista->crn, 
                    $nutricionista->siape, $nutricionista->instituicao);

            $result = $stmt->execute();
            if ($result) {
                $cdNutricionista = $stmt->insert_id;
                $stmt->close();
            }
        } else {
            //Lembrar de mudar os nomes das constantes para servir pra aluno e nutricionista
            $cdNutricionista = ENTREVISTADO_EXISTENTE;
        }
        return $cdNutricionista;
    }

    /**
     * 
     * @param type $crn
     * @param type $siap
     * @return type
     */
    private function ehNutricionistaExistente($crn, $siap) {

        $stmt = $this->conn->prepare("SELECT cd_nutricionista "
                . "FROM tb_nutricionista "
                . "WHERE nm_crn = ? OR nm_siape = ?");
        $stmt->bind_param("ii", $crn, $siap);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    /**
     * Descrição
     * @param type $login
     * @param type $senha
     * @return type
     */
    public function checkLogin($login, $senhaPlana) {

        $autorizado = FALSE;

        $sql = "SELECT usuario.nm_login, usuario.nm_senha"
                . " FROM tb_usuario AS usuario"
                . " WHERE"
                . " usuario.nm_login = ?"
                . " AND usuario.fl_ativo = ". USUARIO_ATIVO;
        
        $stmt = $this->conn->prepare($sql);

        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("s", $login);
        $resultStmt = $stmt->execute();
        $stmt->store_result();
        
        if ($resultStmt && $stmt->num_rows > 0) { 
            
            $stmt->bind_result($login, $senhaHash);
            $stmt->fetch();
            
            if (PassHash::check_password($senhaHash, $senhaPlana)) {
                $autorizado = TRUE;
            }
        }

        $stmt->close();

        return $autorizado;
    }
    
    function getUsuarioByLogin($login) {
        
        $usuario = NULL;

        $sql = "SELECT usuario.nm_login, usuario.nm_usuario, "
                . " usuario.cd_tipousuario, usuario.cd_usuario,"
                . " usuario.dt_nascimento, usuario.nm_sexo,"
                . " usuario.nm_apikey, usuario.fl_ativo"
                . " FROM tb_usuario AS usuario"
                . " WHERE"
                . " usuario.nm_login = ?";
        
        $stmt = $this->conn->prepare($sql);

        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("s", $login);
        $resultStmt = $stmt->execute();
        $stmt->store_result();

        if ($resultStmt && $stmt->num_rows > 0) {
            $stmt->bind_result($login, $nome, $tipoUsuario, $codigo, 
                    $dtNascimento, $sexo, $apikey, $ativo);
            $stmt->fetch();
            $usuario = new Usuario();
            $usuario->setLogin($login);
            $usuario->setCodigo($codigo);
            $usuario->setNome($nome);
            $usuario->setTipoUsuario($tipoUsuario);
            $usuario->setNascimento($dtNascimento);
            $usuario->setSexo($sexo);
            $usuario->setApiKey($apikey);
            $usuario->setAtivo($ativo);
        }

        $stmt->close();

        return $usuario;
    }

    /**
     * 
     * @param type $imc
     * @param type $sexo
     * @param type $idadeMeses
     * @return \Percentil
     */    
    public function selecionarPercentil($imc, $sexo, $idadeMeses) {

        $percentil = NULL;

        // Consultar o Percentil na tabela tb_imc_percentil.            
        $sql = "SELECT percentil.cd_percentil, percentil.vl_percentil, "
                . "imc.tp_sexo, imc.vl_fator, imc.vl_imc_percentil"
                . " FROM"
                . " tb_imc_percentil AS imc, tb_percentil AS percentil"
                . " WHERE"
                . " imc.tp_sexo = ?"
                . " AND imc.cd_fator = " . FATOR
                . " AND imc.vl_fator = ?"
                . " AND imc.vl_imc_percentil = ".$imc
                . " AND imc.cd_percentil = percentil.cd_percentil";
        
        $stmt = $this->conn->prepare($sql);

        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("si", $sexo, $idadeMeses);
        $result = $stmt->execute();
        $stmt->store_result();
        
        if ($result && $stmt->num_rows > 0) {
            
            $stmt->bind_result($cdPercentil, $vlPercentil, 
                    $tpSexo, $vlFatorIdade, $imcPercentil);
            $stmt->fetch();

            //Percentil
            $percentil = new Percentil();
            $percentil->setCodigo($cdPercentil);
            $percentil->setValorPercentil($vlPercentil);
            $percentil->setImc($imcPercentil);
            $percentil->setIdadeMeses($vlFatorIdade);
            $percentil->setSexo($tpSexo);
        }

        $stmt->close();

        return $percentil;
    }

    /**
     * 
     * @param type $anamnese
     * @return type
     */
    function inserirAnamnese($anamnese) {

        $cdAnamnese = ID_NAO_RETORNADO;

        $stmt = $this->conn->prepare("INSERT INTO"
                . " tb_anamnese(cd_nutricionista, cd_entrevistado, cd_pesquisa,"
                . " nr_peso, nr_altura, nr_nivel_esporte, cd_perfilalimentar)"
                . " values(?, ?, ?, ?, ?, ?, ?)");

        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("iiiiddi", $anamnese->nutricionista, 
                $anamnese->entrevistado, $anamnese->pesquisa, 
                $anamnese->peso, $anamnese->altura, $anamnese->nivelEsporte, 
                $anamnese->perfilAlimentar);

        $result = $stmt->execute();
        if ($result) {
            $cdAnamnese = $stmt->insert_id;
            $stmt->close();
        }

        return $cdAnamnese;
    }

    public function selectAnamnese($codigo) {

        $anamnese = NULL;

        $sql = "SELECT a.cd_anamnese, e.cd_entrevistado, e.nr_matricula,"
            ." u.nm_usuario, u.dt_nascimento, u.nm_sexo, a.nr_peso, a.nr_altura,"
            ." a.nr_nivel_esporte"
            ." FROM tb_entrevistado AS e, tb_usuario AS u, tb_anamnese AS a"
            ." WHERE e.cd_usuario = u.cd_usuario"
            ." AND e.cd_entrevistado = a.cd_entrevistado"
            ." AND a.cd_anamnese = ?";

        $stmt = $this->conn->prepare($sql);

        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("i", $codigo);
        $resultStmt = $stmt->execute();
        $stmt->store_result();

        if ($resultStmt && $stmt->num_rows > 0) {
            
            // Campos de retorno da anamnese.
            $stmt->bind_result($codigoAnamnese, $codigoEntrevistado, $matricula, 
                    $nome, $nascimento, $sexo, $peso, $altura, $nivelEsporte);
            $stmt->fetch();
            
            $entrevistado = new Entrevistado();
            $entrevistado->setCodigo($codigoEntrevistado);
            $entrevistado->setNome($nome);
            $entrevistado->setMatricula($matricula);
            $entrevistado->setNascimento($nascimento);
            $entrevistado->setSexo($sexo);                

            $anamnese = new Anamnese();
            $anamnese->setCodigo($codigoAnamnese);
            $anamnese->setPeso($peso);
            $anamnese->setAltura($altura);   
            $anamnese->setNivelEsporte($nivelEsporte);
            $anamnese->setEntrevistado($entrevistado);           
        }

        $stmt->close();

        return $anamnese;
    }
    
    /**
     * Descrição
     * @param type $matricula
     * @return array
     */
    public function selectAnamnesesEntrevistado($matricula) {
        
        $anamneses = array();

        // Montar consulta.
        $sql = "SELECT e.cd_entrevistado, e.nr_matricula, u.dt_nascimento,"
            . " u.nm_sexo, a.nr_peso, a.nr_altura, a.nr_nivel_esporte"
            ." FROM tb_entrevistado AS e, tb_usuario AS u, tb_anamnese AS a"
            ." WHERE e.cd_usuario = u.cd_usuario"
            ." AND e.cd_entrevistado = a.cd_entrevistado"
            ." AND e.nr_matricula = ".$matricula;

        $result = $this->conn->query($sql);
           
        if ($result) {
            while ($row = $result->fetch_assoc()) {       
                
                $entrevistado = new Entrevistado();
                $entrevistado->setCodigo($row["cd_entrevistado"]);
                $entrevistado->setMatricula($row["nr_matricula"]);
                $entrevistado->setNascimento($row["dt_nascimento"]);
                $entrevistado->setSexo($row["nm_sexo"]);                

                $anamnese = new Anamnese();
                $anamnese->setPeso($row["nr_peso"]);
                $anamnese->setAltura($row["nr_altura"]);   
                $anamnese->setEntrevistado($entrevistado);
                
                array_push($anamneses, $anamnese);
            }  
        }
        
        return $anamneses;        
    }

    /**
     * Descrição
     * @param type $matricula
     * @return \Anamnese
     */
    public function selectDadosAntropometricos($matricula) {

        $dadosAntropometricos = NULL;
        // Montar consulta.
        $sql = "SELECT nr_peso, nr_altura, nr_nivel_esporte ".
                "FROM tb_anamnese ".
                "WHERE nr_matricula = ?";

         $stmt = $this->conn->prepare($sql);
        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("i", $matricula);
        $resultStmt = $stmt->execute();
        $stmt->store_result();

        if ($resultStmt && $stmt->num_rows > 0) {

            $stmt->bind_result($peso, $altura, $nivelEsporte);
            $stmt->fetch();

            $dadosAntropometricos = new Anamnese();
            $dadosAntropometricos->setPeso($peso);
            $dadosAntropometricos->setAltura($altura);
            $dadosAntropometricos->setNivelEsporte($nivelEsporte);        
        }

        $stmt->close();

        return $dadosAntropometricos;
    }
    
    private function ehPesquisaExistente($cdPesquisa) {

        $stmt = $this->conn->prepare("SELECT cd_pesquisa "
                . "FROM tb_pesquisa "
                . "WHERE cd_pesquisa = ?");
        
        $stmt->bind_param("i", $cdPesquisa);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    function inserirPesquisa($pesquisa){

        $cdPesquisa = ID_NAO_RETORNADO;
        
        $stmt = $this->conn->prepare("INSERT INTO "
                . " tb_pesquisa(nm_pesquisa, dt_inicio, dt_fim, "
                . " cd_instituicao, cd_nutricionista) "
                . " VALUES(?, ?, ?, ?, ?)");

        // Parâmetros: tipos das entradas, entradas.
        
        $dataInicio = implode("-", array_reverse(explode("/", $pesquisa->dataInicio)));
        $dataFim = implode("-", array_reverse(explode("/", $pesquisa->dataFim)));
        
        $stmt->bind_param("sssii", $pesquisa->nome,$dataInicio, 
                $dataFim, $pesquisa->instituicao, $pesquisa->nutricionista);

        $result = $stmt->execute();
        if ($result) {
            $cdPesquisa = $stmt->insert_id;
            $stmt->close();
        }   

        return $cdPesquisa;
    }  
   


}

?>
