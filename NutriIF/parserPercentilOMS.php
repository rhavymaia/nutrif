<?php
require_once ('database/dao.class.php');

define("FATOR", 8);

$txt_file = file_get_contents('configuration/file.txt');
$rows = explode("\n", $txt_file);
array_shift($rows);

foreach($rows as $row => $data){
    echo 'Linha: '. $data;
    $values = explode("|", $data);
    echo " Quantidade de valores: ".count($values);
    
    if (count($values)== 11){
        // Gênero - M (1) F(2)   
        $sexo = $values[0] == 1 ? "M": "F";
        $idade = $values[1];
        $fator = FATOR;
        
        echo "Sexo: ".$sexo." Idade(meses): ".$idade." Fator: ".$fator;
        
        for($i=2; $i<count($values); $i++){
            
            $cdPercentil = getCdPercentil($i);
            $vlPercentil = str_replace(",", ".", $values[$i]);
            echo "Percentil: ".$cdPercentil." - ".$vlPercentil;
            
            
            $data = array(
                'cd_fator' => $fator,
                'tp_sexo' => $sexo,
                'vl_fator' => $idade,
                'cd_percentil' => $cdPercentil,  
                'vl_imc_percentil' => $vlPercentil,
            );
            
            //print_r($data);
            
            $dao = new dao_class();
            $id = $dao->inserirIMCPercentil($data);
            
            if ($id==0) {
                echo " Falha!";
            } else {
                echo " Inserido!";
            }
        }
        
        echo "</br>";
    }
}

function getCdPercentil($i) {
    switch ($i) {
        case 2:return "1";
            break;
        case 3: return "2";
            break;
        case 4: return "3";
            break;
        case 5: return "4";
            break;
        case 6: return "5";
            break;
        case 7: return "6";
            break;
        case 8: return "7";
            break;
        case 9: return "8";
            break;
        case 10: return "9";
            break;
        
    }
}

?>
