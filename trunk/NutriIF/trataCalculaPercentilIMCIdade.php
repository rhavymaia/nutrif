<?php

session_start();

// Cabeçalho e menu da página html.
require_once ('database/dao.class.php');
require_once ('validate/validate.php');
require_once ('util/date.php');
require_once ('util/constantes.php');

//Inicialização de variáveis.
$matricula = $_POST['matricula'];

if (validaFormCalculaPercentilIMC()) {
    
    // Verificar se a checagem não gera problemas de tipo.
    $rowEntrevistado = consultarEntrevistado($matricula);
    
    if ($rowEntrevistado) {

        $resultados = calcularPercentil($rowEntrevistado); 
        
        // Enviar para a próxima tela os valores
            $_SESSION['percentilMediano'] = $resultados[0];
            $_SESSION['percentilInferior'] = $resultados[1];
            $_SESSION['percentilSuperior'] = $resultados[2];
            $_SESSION['perfilIMC'] = $resultados[3];
            $_SESSION['imc'] = $resultados[4];
          header("location: formCalculaPercentilIMCIdade.php");        
    } else {
        $msg = ("Matrícula não encontrada");
        $_SESSION['matricula'] = $matricula;
        $_SESSION['erro'] = $msg;
        header("location: formCalculaPercentilIMCIdade.php");
    }
} else {
    header("location: formCalculaPercentilIMCIdade.php");
}

function consultarEntrevistado($matricula) {

    $dao = new dao_class();

    $rowEntrevistado = $dao->selectEntrevistado($matricula);
    
    // Peso em quilograma
    $peso = $rowEntrevistado['nr_peso'];
    
    // Altura em centímetro
    $alturaCm = $rowEntrevistado['nr_altura'];   

    // Calcular IMC com os dados do entrevistado.
    $alturaMetros = $alturaCm/100;

    // Cálculo do IMC
    $imc = number_format($peso/pow($alturaMetros, 2), 1);

    $entrevistado = array(
        'peso' => $peso,
        'alturaCm' => $alturaCm,
        'sexo' => $rowEntrevistado['tp_sexo'],
        'dtNascimento' => $rowEntrevistado['dt_nascimento'],
        'idadeMeses' => getIdade($rowEntrevistado['dt_nascimento']),
        'imc' => $imc
    );

    return $entrevistado;
}

function validaFormCalculaPercentilIMC() {
        
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

function calcularPercentil($rowEntrevistado){
    
    //Inicialização das variáveis
    $perfilIMC= 0;
    $percentilInferior = 0;
    $percentilSuperior = 0;
    $percentilMediano = 0;
    
    
        $dados = $rowEntrevistado;
        
        // Para idade abaixo de 228 meses (19 Anos)
        if ($dados['idadeMeses'] <= IDADE_PERCENTIL_19) {
            $dao = new dao_class();
            
            $percentilMediano = $dao->selectPercentil($dados['imc'], 
                    $dados['sexo'], $dados['idadeMeses']);

            // Buscar percentis nas proximidades
            if (!$percentilMediano) {

                // Margens dos percentis baseado no cálculo inicial.
                $margemIMCInferior = $dados['imc'] - MARGEM_LIMITE_PERCENTIL;
                $margemIMCSuperior = $dados['imc'] + MARGEM_LIMITE_PERCENTIL;

                // Valores crescentes e decrescentes do IMC.
                $imcDecrescente = $dados['imc'];
                $imcCrescente = $dados['imc'];

                // Verificação do percentil inferior.
                while ($percentilInferior == 0 && $imcDecrescente >= $margemIMCInferior) {
                    $imcDecrescente = $imcDecrescente - 0.1;
                    $percentilInferior = $dao->selectPercentil($imcDecrescente, $dados['sexo'], $dados['idadeMeses']);
                }

                // Verificação do percentil superior.
                while ($percentilSuperior == 0 && $imcCrescente <= $margemIMCSuperior) {
                    $imcCrescente = $imcCrescente + 0.1;
                    $percentilSuperior = $dao->selectPercentil($imcCrescente, $dados['sexo'], $dados['idadeMeses']);
                }
            }
   
            } else {
            
            // Tratar pessoas maiores de 19 anos           
            if ($dados['imc'] < 18.5) {
                $perfilIMC = PERFIL_MAGREZA;
            } else if (($dados['imc'] >= 18.5) && ($dados['imc'] <= 24.9)) {
                $perfilIMC = PERFIL_EUTROFICO;
            } else if (($dados['imc'] >= 25.0) && ($dados['imc'] <= 29.9)) {
                $perfilIMC = PERFIL_SOBREPESO;
            } else if (($dados['imc'] >= 30.0) && ($dados['imc'] <= 34.9)) {
                $perfilIMC = PERFIL_OBESO;
            } else if ($dados['imc'] >= 35.0) {
                $perfilIMC = PERFIL_OBESO_MORBIDO;
            }
}
        $resultados = array();
    
        $resultados[0]= $percentilMediano;
        $resultados[1]= $percentilInferior;
        $resultados[2]= $percentilSuperior;
        $resultados[3]= $perfilIMC;
        $resultados[4]= $dados['imc'];

    return $resultados;
}
?>