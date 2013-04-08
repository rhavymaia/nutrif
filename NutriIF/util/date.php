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

?>
