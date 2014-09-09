<?php
require_once './util/constantes.php';
/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
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
     * @param type $dados
     */
    public function inserirUsuario($aluno) {
        
        //caso usuário não seja criado o valor 0 será atribuído
         $cd_usuario = 0;
         
        // insert query
        $stmt = $this->conn->prepare("INSERT INTO"
                . " tb_usuario(nm_login, nm_senha, nm_usuario,"
                . " dt_nascimento, cd_tipousuario, fl_ativo)"
                . " values(?, ?, ?, ?, ".TP_ALUNO.", ".USUARIO_ATIVO.")");
        
        $nascimento = $data = implode("-",
                array_reverse(explode("/",$aluno->nascimento)));
        
        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("ssss", $aluno->login, $aluno->senha, $aluno->nome, 
                $nascimento);
        
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
        
        // Parâmetros: tipos das entradas, entradas.
        $stmt->bind_param("iii", $entrevistado->idUsuario, $entrevistado->matricula,
                $entrevistado->nivel);
        
        $result = $stmt->execute();        
        if ($result) {
            $cd_entrevistado = $stmt->insert_id; 
        }    

        $stmt->close();
        
        return $cd_entrevistado;
    }
}
?>
