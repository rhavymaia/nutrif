<?php

session_start();

// Cabe�alho e menu da p�gina html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

$matricula = $_POST['matricula'];

if (ehNumerico($matricula) && (strlen($matricula) == TAM_MATRICULA)){
     
    function capturarDadosVCT($matricula) {

        $dao = new dao_class();

        $rowEntrevistado = $dao->selectEntrevistado($matricula);

        $vetor = array(
            'peso' => $rowEntrevistado['nr_peso'],
            'alturaCm' => $rowEntrevistado['nr_altura'],
            'sexo' => $rowEntrevistado['tp_sexo'],
            'idadeMeses' => getIdade($rowEntrevistado['dt_nascimento'])                
        );
        return $vetor;
    }
        
 $dados = capturarDadosVCT($matricula);

    
    if ($dados) {
        if ($dados['sexo'] == 'M'){
            switch ($dados['idadeMeses']){
                
                case 120 . 131 ://10 a 11
                    $vct = ($dados['peso'] * 37.7);
                    break;
                
                case 132 . 143 ://11 a 12
                    $vct = ($dados['peso'] * 35.1);
                    break;
                
                case 144 . 155 ://12 a 13
                    $vct = ($dados['peso'] * 33.4);
                    break;
                
                case 156 . 167 ://13 a 14
                    $vct = ($dados['peso'] * 31.4);
                    break;
                
                case 168 . 179 ://14 a 15
                    $vct = ($dados['peso'] * 29.9);
                    break;
                    
                case 180 . 191 ://15 a 16
                    $vct = ($dados['peso'] * 28.7);
                    break;
                
                case 192 . 203 ://16 a 17
                    $vct = ($dados['peso'] * 27.9);
                    break;
                
                case 204 . 227 ://17 a 18
                    $vct = ($dados['peso'] * 27.5);
                    break;
            }
        }else{
            
            switch ($dados['idadeMeses']){
                
                case 120 . 131 ://10 a 11
                    $vct = ($dados['peso'] * 34.3);
                    break;
                
                case 132 . 143 ://11 a 12
                    $vct = ($dados['peso'] * 31.5);
                    break;
                
                case 144 . 155 ://12 a 13
                    $vct = ($dados['peso'] * 29.1);
                    break;
                
                case 156 . 167 ://13 a 14
                    $vct = ($dados['peso'] * 27.5);
                    break;
                
                case 168 . 179 ://14 a 15
                    $vct = ($dados['peso'] * 26.7);
                    break;
                    
                case 180 . 191 ://15 a 16
                    $vct = ($dados['peso'] * 26.3);
                    break;
                
                case 192 . 203 ://16 a 17
                    $vct = ($dados['peso'] * 26.0);
                    break;
                
                case 204 . 227 ://17 a 18
                    $vct = ($dados['peso'] * 25.9);
                    break;
            }
        }
        
        $_SESSION['vct'] = $vct;
        header("location: formCalculaVCTVET.php");
        
     } else{
        $msg = ("Matr�cula n�o encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formCalculaVCTVET.php");
        }
    }  else {
    $msg = ("Informe uma matr�cula v�lida. Somente n�mero s�o permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formCalculaVCTVET.php");
}     
