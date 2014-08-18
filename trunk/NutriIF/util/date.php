<?php

    /**
     * An�lise, convers�es e formata��o de datas
     * 
     * @param type $date
     * @return boolean|string
     */

    // Retirada de caracteres especiais da data e formata��o
    function converteData($date) {

        $char = strpos($date, "/") !== false ? "/" : "-";

        $date_array = explode($char, $date);

        if (count($date_array) != 3)
            return false;

        $dataFormatada = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];

        return $dataFormatada;
    }
    
    //fun��o que formata a data
    function formata_data($data)
    {
     //recebe o par�metro e armazena em um array separado por -
     $data = explode('-', $data);
     //armazena na variavel data os valores do vetor data e concatena /  
     $data = $data[2].'/'.$data[1].'/'.$data[0];

     //retorna a string da ordem correta, formatada
     return $data;
    }
       // fun��o que calcula idade do usuario em meses
    function getIdade($data) {
        
        $birthday = new DateTime($data);
        $date = new DateTime();        
        $diff = $birthday->diff($date);
        $months = $diff->format('%m') + 12 * $diff->format('%y');

        return $months;
    }
?>
