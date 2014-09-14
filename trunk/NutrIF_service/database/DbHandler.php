<?php

require_once './util/constantes.php';
require_once './entidade/Usuario.class.php';

/**
 * Descriзгo
 *
 * @author Rhavy Maia rhavy.maia@gmail.com
 * @author Larissa Fйlix
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
     * Inserir o usuбrio.
     * @param type $usuario
     */
    public function inserirUsuario($usuario, $tipoUsuario) {

        //caso usuбrio nгo seja criado o valor 0 serб atribuнdo
        $cdUsuario = ID_NAO_RETORNADO;

        if (!$this->ehUsuarioExistente($usuario->login)) {   
            // Caso o usuбrio nгo exista serб construнda o Insert na tb_usuario.
            $stmt = $this->conn->prepare("INSERT INTO tb_usuario(nm_login, "
                    . "nm_senha, nm_usuario, dt_nascimento, nm_sexo, "
                    . "cd_tipousuario, fl_ativo)"
                    . " values(?, ?, ?, ?, ?, ".$tipoUsuario.", "
                    .USUARIO_ATIVO.")");

            $nascimento = $data = implode("-",
                    array_reverse(explode("/",$usuario->nascimento)));
            $sexo = strtolower($usuario->sexo);
            
            // Parвmetros: tipos das entradas, entradas.
            $stmt->bind_param("sssss", $usuario->login, $usuario->senha, 
                    $usuario->nome, $nascimento, $sexo);

            // Executar a consulta.
            $result = $stmt->execute();        
            if ($result) {
                $cdUsuario = $stmt->insert_id;
            }
            $stmt->close();
        } else {
            // Cуdigo para usuбrio jб existente.
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
     * Inserir entrevistado.
     * @param type $entrevistado
     * @return type
     */
    public function inserirEntrevistado($entrevistado) {

        // insert query
        $stmt = $this->conn->prepare("INSERT INTO"
                . " tb_entrevistado(cd_usuario, nr_matricula, cd_nivelescolar)"
                . " values(?, ?, ?)");

        // Parвmetros: tipos das entradas, entradas.
        $stmt->bind_param("iii", $entrevistado->idUsuario, $entrevistado->matricula, 
                $entrevistado->nivel);

        $result = $stmt->execute();
        if ($result) {
            $cd_entrevistado = $stmt->insert_id;
        }

        $stmt->close();

        return $cd_entrevistado;
    }
    
    /**
     * 
     * @param type $nutricionista
     * @return type
     */
    public function inserirNutricionista($nutricionista){
        
         // insert query
        $stmt = $this->conn->prepare("INSERT INTO"
                . " tb_nutricionista(cd_usuario, nm_crn, nm_siape, cd_instituicao)"
                . " values(?, ?, ?, ?)");
        
        // Parвmetros: tipos das entradas, entradas.
        $stmt->bind_param("iiii", $nutricionista->idUsuario, $nutricionista->crn,
                $nutricionista->siape, $nutricionista->instituicao);
        
        $result = $stmt->execute();        
        if ($result) {
            $cd_nutricionista = $stmt->insert_id; 
        }    

        $stmt->close();
        
        return $cd_nutricionista;
    }
    
    
    /**
     * Descriзгo
     * @param type $login
     * @param type $senha
     * @return type
     */
    public function selectLogin($login, $senha) {

        $usuario = NULL;
        
        $sql = "SELECT usuario.nm_login, usuario.nm_usuario, "
                . "usuario.cd_tipousuario, "
                . "usuario.cd_usuario "
                . " FROM tb_usuario AS usuario"
                . " WHERE"
                . " usuario.nm_login = ?"
                . " AND usuario.nm_senha = ?";

        $stmt = $this->conn->prepare($sql);

        // Parвmetros: tipos das entradas, entradas.
        $stmt->bind_param("ss", $login, $senha);
        $resultStmt = $stmt->execute();
        $stmt->store_result();
        
        if ($resultStmt && $stmt->num_rows>0) {            
            $stmt->bind_result($login, $nome, $tipoUsuario, $codigo);
            $stmt->fetch();            
            $usuario = new Usuario();
            $usuario->setLogin($login);
            $usuario->setCodigo($codigo);
            $usuario->setNome($nome);
            $usuario->setTipoUsuario($tipoUsuario);                     
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
    public function selecionarPercentil($imc, $sexo, $idadeMeses){
        
        $percentil = NULL;
        
        // Consultar o Percentil na tabela tb_imc_percentil.            
        $sql = "SELECT imc.cd_percentil, percentil.vl_percentil, imc.tp_sexo, "
            . "imc.vl_fator, imc.vl_imc_percentil"
            . " FROM"
            . " tb_imc_percentil AS imc, tb_percentil AS percentil"
            . " WHERE" 
            . " imc.tp_sexo = ?"
            . " AND imc.cd_fator = ".FATOR
            . " AND imc.vl_fator = ?"
            . " AND imc.vl_imc_percentil = ?"
            . " AND imc.cd_percentil = percentil.cd_percentil";

         $stmt = $this->conn->prepare($sql);

        // Parвmetros: tipos das entradas, entradas.
        $stmt->bind_param("sid", $sexo, $idadeMeses, $imc);
        $resultStmt = $stmt->execute();
        $stmt->store_result();
        
        if ($resultStmt && $stmt->num_rows>0) {
            
            $stmt->bind_result($cdPercentil, $vlPercentil, $tpSexo, 
                    $vlFatorIdade, $imcPercentil);
            $stmt->fetch();  
            
            $percentil = new Percentil();
            $percentil->setCdPercentil($cdPercentil);
            $percentil->setVlPercentil($vlPercentil);   
            $percentil->setImc($imcPercentil);
            $percentil->setIdadeMeses($vlFatorIdade);
            $percentil->setSexo($tpSexo);
            
        }
        
        $stmt->close(); 
        
        return $percentil;
    }
    
}

?>