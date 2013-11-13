<?php

session_start();
    require_once ('database/dao.class.php');
    require_once ('validate/validate.php');
    require_once ('util/constantes.php');
    
    session_destroy();
    
    header("location: index.php");
?>
