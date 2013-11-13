<?php

session_start();

// Cabeçalho e menu da página html.
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
            
                //case 120 . 131 ://10 a 11
                if (($dados['idadeMeses'] >= 120) && ($dados['idadeMeses'] < 131)){
                    $vct = ($dados['peso'] * 37.7);
                  }
              //  case 132 . 143 ://11 a 12
                  
                elseif (($dados['idadeMeses'] >= 132) && ($dados['idadeMeses'] < 143)){
                    $vct = ($dados['peso'] * 35.1);
                }
                //case 144 . 155 ://12 a 13
                elseif (($dados['idadeMeses'] >= 144) && ($dados['idadeMeses'] < 155)){
                    $vct = ($dados['peso'] * 33.4);
                }
                
                //case 156 . 167 ://13 a 14
                elseif (($dados['idadeMeses'] >= 156) && ($dados['idadeMeses'] < 167)){
                    $vct = ($dados['peso'] * 31.4);
                } 
                
                //case 168 . 179 ://14 a 15
                elseif (($dados['idadeMeses'] >= 168) && ($dados['idadeMeses'] < 179)){
                        $vct = ($dados['peso'] * 29.9);
                }
                    
                //case 180 . 191 ://15 a 16
                 elseif (($dados['idadeMeses'] >= 180) && ($dados['idadeMeses'] < 191)){
                        $vct = ($dados['peso'] * 28.7);
                 }
                
                //case 192 . 203 ://16 a 17
                 elseif (($dados['idadeMeses'] >= 192) && ($dados['idadeMeses'] < 203)){
                      $vct = ($dados['peso'] * 27.9);
                 }
                
                //case 204 . 227 ://17 a 18
                 elseif ($dados['idadeMeses'] >= 204){
                        $vct = ($dados['peso'] * 27.5);
                 }
        }else{
                            
                //case 120 . 131 ://10 a 11
                if (($dados['idadeMeses'] >= 120) && ($dados['idadeMeses'] < 131)){
                       $vct = ($dados['peso'] * 34.3);
                }
                
                //case 132 . 143 ://11 a 12
                elseif (($dados['idadeMeses'] >= 132) && ($dados['idadeMeses'] < 143)){
                    $vct = ($dados['peso'] * 31.5);
                }
                
                //case 144 . 155 ://12 a 13
                 elseif (($dados['idadeMeses'] >= 144) && ($dados['idadeMeses'] < 155)){
                    $vct = ($dados['peso'] * 29.1);
                 }
                
                //case 156 . 167 ://13 a 14
                 elseif (($dados['idadeMeses'] >= 156) && ($dados['idadeMeses'] < 167)){
                    $vct = ($dados['peso'] * 27.5);
                 }
                
                //case 168 . 179 ://14 a 15
                 elseif (($dados['idadeMeses'] >= 168) && ($dados['idadeMeses'] < 179)){
                    $vct = ($dados['peso'] * 26.7);
                 }
                    
                //case 180 . 191 ://15 a 16
                 elseif (($dados['idadeMeses'] >= 180) && ($dados['idadeMeses'] < 191)){
                    $vct = ($dados['peso'] * 26.3);
                 }
                
                //case 192 . 203 ://16 a 17
                 elseif (($dados['idadeMeses'] >= 192) && ($dados['idadeMeses'] < 203)){
                    $vct = ($dados['peso'] * 26.0);
                 }
                
                //case 204 . 227 ://17 a 18
                  elseif ($dados['idadeMeses'] >= 204){
                    $vct = ($dados['peso'] * 25.9);
                  }
            
        }
        
        $_SESSION['vct'] = $vct;
        header("location: formCalculaVCT.php");
        
     } else{
        $msg = ("Matrícula não encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formCalculaVCT.php");
        }
    }  else {
    $msg = ("Informe uma matrícula válida. Somente números são permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formCalculaVCTVET.php");
}