<?php
    require_once ('validate/validate.php');
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
        $senha = $_POST['senha'];
        $usuario = $_POST['usuario'];
        
        if (($senha == 'nutr1f_us3r') && ($usuario == 'nutrif_user')){
            header("location: formRegistroAntropometrico.php"); 
        }else{
            $_SESSION['erro_login'] = "Senha inválida!";
            header("location: login.php");  
        }
   
?>
