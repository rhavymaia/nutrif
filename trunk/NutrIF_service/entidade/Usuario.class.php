<?php

/**
 * Description of Usuario
 *
 * @author Rhavy
 */
class Usuario {

    private $codigo;
    
    private $login;
    
    private $senha;
    
    private $nome;
    
    private $nascimento;
    
    private $tipoUsuario;
    
    private $ativo;
    
    private $dataRegistro;

    public function __construct() {}

    public function getCodigo() {
        return $this->codigo;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNascimento() {
        return $this->nascimento;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getDataRegistro() {
        return $this->dataRegistro;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }
}
?>
