<?php
    require_once ('validate/validate.php');
//session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
   include("seguranca.php");

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$usuario = (isset($_POST['nome'])) ? $_POST['nome'] : '';

$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

 
// Utiliza uma função criada no seguranca.php pra validar os dados digitados
if (validaUsuario($usuario, $senha) == true) {
// O usuário e a senha digitados foram validados, manda pra página interna
header("Location: index.php");
} else {
// O usuário e/ou a senha são inválidos, manda de volta pro form de login
// Para alterar o endereço da página de login, verifique o arquivo seguranca.php
expulsaVisitante();
}
}

  /* if (($usuario == "nutrif_user") && ($senha == "nutr1f_us3r")){
       echo("login realizado com sucesso!");
   }else{
       echo ("nome do usuário ou senha incorreto");
   }
   */
?>
