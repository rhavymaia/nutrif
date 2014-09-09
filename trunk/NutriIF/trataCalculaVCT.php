<?php
require_once 'restclient/restclient.php';
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
        
         $restClient = new RestClient(
                array('base_url' => "http://localhost/NutrIF_service")
        );
         
         $header = array('user_agent' => "nutrif-php/1.0", 'content-type' => "application/json");
        // Método get.
         $result = $restClient->get('analisarVCT', $vetor, $header);
         $vct = $result->info->http_code;
   
            $_SESSION['vct'] = $vct;
            header("location: formCalculaVCT.php");
        }else{
            $msg = ("Matrícula não encontrada");
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