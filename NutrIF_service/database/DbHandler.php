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
     * @param type $aluno
     */
    public function inserirUsuario($aluno, $tipo_usuario) {

        //caso usuбrio nгo seja criado o valor 0 serб atribuнdo
        $cd_usuario = 0;

        // insert query
        $stmt = $this->conn->prepare("INSERT INTO"
                . " tb_usuario(nm_login, nm_senha, nm_usuario,"
                . " dt_nascimento, nm_sexo, cd_tipousuario, fl_ativo)"
                . " values(?, ?, ?, ?, ?, ".$tipo_usuario.", ".USUARIO_ATIVO.")");
        
        $nascimento = $data = implode("-",
                array_reverse(explode("/",$aluno->nascimento)));
        
        // Parвmetros: tipos das entradas, entradas.
        $stmt->bind_param("sssss", $aluno->login, $aluno->senha, $aluno->nome, 
                $nascimento, $aluno->sexo);
        
        // Executar a consulta.
        $result = $stmt->execute();        
        if ($result) {
            $cd_usuario = $stmt->insert_id;
        }

        $stmt->close();

        return $cd_usuario;
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
        $stmt->bind_param("iii", $entrevistado->idUsuario, $entrevistado->matricula, $entrevistado->nivel);

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
        
        $sql = "SELECT usuario.nm_login, usuario.nm_usuario, usuario.cd_tipousuario, "
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