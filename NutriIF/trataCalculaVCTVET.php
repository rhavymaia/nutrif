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
            'idadeAnos' => idadeAnos($rowEntrevistado['dt_nascimento']),
            'esporte' => $rowEntrevistado['nr_nivel_esporte']
                
        );
        return $vetor;
    }
    
     function idadeAnos($data) {
        
        $birthday = new DateTime($data);
        $date = new DateTime();        
        $years = $birthday->diff($date);

        return $years;
    }    
    
    function coeficienteAtividade($codigo, $sexo){
        if ($sexo == 'M'){
            switch ($codigo){            
                        case 1: $valor = 1.55;
                            break;       
                        case 2: $valor = 1.78;
                            break;       
                        case 3: $valor = 2.10;
                            break;
                    }
        }else{
            switch ($codigo){            
                        case 1: $valor = 1.56;
                            break;       
                        case 2: $valor = 1.64;
                            break;       
                        case 3: $valor = 1.82;
                            break;
                    }
        }
        return $valor;
    }

 $dados = capturarDadosVCT($matricula);

    
    if ($dados) {
        if ($dados['sexo'] == 'M'){
           $VCT = ((66 + (13.7 * $dados['peso'])) + (5.0 * $dados['altura']) - (6.8 * $dados['idadeAnos']));
        }else{
           $VCT = ((665 + (9.6 * $dados['peso'])) + (1.8 * $dados['altura']) - (4.7 * $dados['idadeAnos'])); 
        }
        
        if ($dados['sexo'] == 'M'){
            if(($dados['idadeAnos'] >= 10) || ($dados['idadeAnos'] < 18)){
                //TBM : Taxa de Metabolismo Basal
                $TBM = ((16.6 * $dados['peso'] )+ (77 * $dados['altura'] + 572));
            }
            elseif(($dados['idadeAnos'] >= 18) || ($dados['idadeAnos'] < 30)){
                $TBM = (15.4 * $dados['peso'] + 27 * $dados['altura']  + 717);
            }
            elseif(($dados['idadeAnos'] >= 30) || ($dados['idadeAnos'] < 60)){
                $TBM = (11.3 * $dados['peso'] + 16 * $dados['altura']  + 901);
            }
            elseif($dados['idadeAnos'] >= 60){
                $TBM = (8.8 * $dados['peso'] + 1128 * $dados['altura']  - 1071);
            }
        }else{ 
            if(($dados['idadeAnos'] >= 10) || ($dados['idadeAnos'] < 18)){
                $TBM = ((7.4 * $dados['peso'] )+ (482 * $dados['altura'] + 217));
            }
            elseif(($dados['idadeAnos'] >= 18) || ($dados['idadeAnos'] < 30)){
                $TBM = (13.3 * $dados['peso'] + 334 * $dados['altura']  + 35);
            }
             elseif(($dados['idadeAnos'] >= 30) || ($dados['idadeAnos'] < 60)){
                $TBM = (8.7 * $dados['peso'] - 255 * $dados['altura']  + 865);
            }
            elseif($dados['idadeAnos'] >= 60){
                $TBM = (9.2 * $dados['peso'] + 637 * $dados['altura']  - 302);
            }
        }
        
        $coefAtividade = coeficienteAtividade($dados['esporte'], $dados['sexo']);
        $VET = $TBM * $coefAtividade;
        
        $_SESSION['vct'] = $VCT;
        $_SESSION['vet'] = $VET;
        header("location: formCalculaVCTVET.php");
        
     } else{
        $msg = ("Matrícula não encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formCalculaVCTVET.php");
        }
    }  else {
    $msg = ("Informe uma matrícula válida. Somente número são permitidos");
    $_SESSION['erro'] = $msg;
    header("location: formCalculaVCTVET.php");
}     
