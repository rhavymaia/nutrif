<?php
    require_once ('validate/validate.php');
//session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
   include("seguranca.php");

// Verifica se um formul�rio foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$usuario = (isset($_POST['nome'])) ? $_POST['nome'] : '';

$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

 
// Utiliza uma fun��o criada no seguranca.php pra validar os dados digitados
if (validaUsuario($usuario, $senha) == true) {
// O usu�rio e a senha digitados foram validados, manda pra p�gina interna
header("Location: index.php");
} else {
// O usu�rio e/ou a senha s�o inv�lidos, manda de volta pro form de login
// Para alterar o endere�o da p�gina de login, verifique o arquivo seguranca.php
expulsaVisitante();
}
}

  /* if (($usuario == "nutrif_user") && ($senha == "nutr1f_us3r")){
       echo("login realizado com sucesso!");
   }else{
       echo ("nome do usu�rio ou senha incorreto");
   }
   */
?>
