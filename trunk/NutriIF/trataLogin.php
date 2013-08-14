<?php
    require_once ('validate/validate.php');
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
   $usuario = $_POST['nome'];
   $senha = $_POST['senha'];
   
   if (($usuario == "nutrif_user") && ($senha == "nutr1f_us3r")){
       echo("login realizado com sucesso!");
   }else{
       echo ("nome do usuário ou senha incorreto");
   }
   
?>
