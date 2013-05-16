<?php

    /**
     * Descrever a função
     * 
     * @param type $date
     * @return boolean|string
     */
    function converteData($date) {

        $char = strpos($date, "/") !== false ? "/" : "-";

        $date_array = explode($char, $date);

        if (count($date_array) != 3)
            return false;

        $dataFormatada = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];

        return $dataFormatada;
    }
    
        function CalculaIdade($date){ 

           // Separa em dia, mês e ano
           list($dia, $mes, $ano) = explode('/', $date);

           // Descobre que dia é hoje e retorna a unix timestamp
           $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
           // Descobre a unix timestamp da data de nascimento do fulano
           $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

           // Depois apenas fazemos o cálculo já citado 
           $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
           
           return $idade;

        }

?>
