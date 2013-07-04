<?php

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
        
        for($i=3; $i>=11; $i++){
            
        }
        
        echo "</br>";
    }
}
?>
