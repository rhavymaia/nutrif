<?php

/**
 * Description of DataUtil
 *
 * @author Projeto IFPB-CG 01
 */
class DataUtil {

    public static function calcularIdadeMeses($data) {

        $birthday = new DateTime($data);
        $date = new DateTime();
        $diff = $birthday->diff($date);
        $months = $diff->format('%m') + 12 * $diff->format('%y');

        return $months;
    }

    public static function calcularIdadeAnos($data) {

        // Separa em dia, mês e ano
        list($dia, $mes, $ano) = explode('/', 
                DataUtil::formataDataBrasileiro($data));

        // Descobre que dia é hoje e retorna a unix timestamp
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);

        //TODO: Explicar cálculo.
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        return $idade;
    }

    public static function formataDataBrasileiro($data) {

        //recebe o parâmetro e armazena em um array separado por -
        $data = explode('-', $data);
        //armazena na variavel data os valores do vetor data e concatena /  
        $data = $data[2] . '/' . $data[1] . '/' . $data[0];

        //retorna a string da ordem correta, formatada
        return $data;
    }

}
