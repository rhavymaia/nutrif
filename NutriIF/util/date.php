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
    
    //função que formata a data
    function formata_data($data)
    {
     //recebe o parâmetro e armazena em um array separado por -
     $data = explode('-', $data);
     //armazena na variavel data os valores do vetor data e concatena /
     $data = $data[1].'/'.$data[2].'/'.$data[0];

     //retorna a string da ordem correta, formatada
     return $data;
    }
       
    function getIdade($aniversario) {
        $curr = 'now';
        $year_curr = date("Y", strtotime($curr));

        $days = !($year_curr % 4) || !($year_curr % 400) & ($year_curr % 100) ? 366: 355;

        list($d, $m, $y) = explode('/', $aniversario);
        $idade = floor(((strtotime($curr) - mktime(0, 0, 0, $m, $d, $y)) / 86400) / $days);
    return $idade*12;

}
    

?>
