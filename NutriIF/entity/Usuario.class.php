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
    
    private $nascimento;
    
    private $tipoUsuario;
    
    private $ativo;
    
    private $dataRegistro;

    public function __construct() {}

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function getNascimento() {
        return $this->nascimento;
    }
    
    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }

    public function getDataRegistro() {
        return $this->dataRegistro;
    }
}

?>
