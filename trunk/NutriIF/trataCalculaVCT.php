<?php

session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

$matricula = $_POST['matricula'];

if (validaFormCalculaVCT()){
     
    function capturarDadosVCT($matricula) {

        $dao = new dao_class();

       // $rowEntrevistado = $dao->selectEntrevistado($matricula);
        
        $rowDadosAntropometricos = $dao->selectDadosAntropometricos($matricula);

        $vetor = array(
            'peso' => $rowDadosAntropometricos['nr_peso'],
            'alturaCm' => $rowDadosAntropometricos['nr_altura'],
            'sexo' => $rowDadosAntropometricos['tp_sexo'],
            'idade' => getIdade($rowDadosAntropometricos['dt_nascimento'])/12,//verificar função pra converter data de nasc em idade normal
            'nivel_esporte' => $rowDadosAntropometricos['nr_nivel_esporte']
        );
        return $vetor;
    }
        
 $dados = capturarDadosVCT($matricula);

    
    if ($dados && $dados['idade'] != 0) {
        if ($dados['sexo'] == 'M'){
            
            $tmb = 655 + (9.6 * $dados['peso']) + (1.8 * $dados['alturaCm']) - (4.7 * $dados['idade']);
               /* if (($dados['idade'] >= 10) && ($dados['idade'] <= 18)){
                    $vct = (($dados['peso'] * 16.6)+ (77 * $dados['alturaCm'])+ 572);
                  }
                  
                elseif (($dados['idade'] > 18) && ($dados['idade'] <= 30)){
                    $vct = (($dados['peso'] * 15.4)+ (27 * $dados['alturaCm'])+ 717);
                }
                elseif (($dados['idade'] > 30) && ($dados['idade'] <= 60)){
                    $vct = (($dados['peso'] * 11.3)+ (16 * $dados['alturaCm'])+ 901);
                }
                elseif (($dados['idade'] > 60)){
                     $vct = (($dados['peso'] * 8.8)+ (1128 * $dados['alturaCm'])- 1071);
                }   
                * 
                */ 
        }else{
             $tmb = 655 + (14 * $dados['peso']) + (5 * $dados['alturaCm']) - (6.7 * $dados['idade']);
             
            /*
               if (($dados['idade'] >= 10) && ($dados['idade'] <= 18)){
                    $vct = (($dados['peso'] * 7.4)+ (482 * $dados['alturaCm'])+ 217);
                  }
                  
                elseif (($dados['idade'] > 18) && ($dados['idade'] <= 30)){
                    $vct = (($dados['peso'] * 13.3)+ (334 * $dados['alturaCm'])+ 35);
                }
                elseif (($dados['idade'] > 30) && ($dados['idade'] <= 60)){
                    $vct = (($dados['peso'] * 8.7)+ (255 * $dados['alturaCm'])+ 865);
                }
                elseif (($dados['idade'] > 60)){
                     $vct = (($dados['peso'] * 9.2)+ (637 * $dados['alturaCm'])- 302);
                }    
             * 
             */
        }
            
            $vct = $tmb*$dados['nivel_esporte'];
            $_SESSION['vct'] = $vct;
            header("location: formCalculaVCT.php");
        }else{
            $msg = ("Matrícula não encontrada");
            //$_SESSION['matricula'] = $matricula; 
            //**É preciso colocar a matrícula na sessão? pois não está apagando nas outras páginas
            $_SESSION['erro'] = $msg;
            header("location: formCalculaVCT.php");
        }
    } else {
        header("location: formCalculaVCT.php");
        }
   /* }  else {
    header("location: formCalculaVCT.php");
}*/

function validaFormCalculaVCT() {
        
        $ehValido = true;
        $msgsErro = array();
        
        $matricula = $_POST['matricula'];
        
        if (!ehNumerico($matricula) || !(strlen($matricula) == TAM_MATRICULA)) {
            
            $msgErro = array('matricula' => "Informe uma matrícula válida. Somente número são permitidos");
            array_push($msgsErro, $msgErro);
            
            $ehValido = false;            
        }
        
        $_SESSION['erro'] = $msgsErro;
        
        return $ehValido;
}
?>