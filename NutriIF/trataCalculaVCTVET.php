<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

$matricula = $_POST['matricula'];
