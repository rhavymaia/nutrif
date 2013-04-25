<?php
    /**
     *  Verificar o formato da data preenchida pelo usuário. O formato esperado 
     * é dd/mm/YYYY.
     * 
     * @autor Rhavy Maia Guedes
     * @param type $date
     * @return boolean
     */
    function verificaData($date) {
        
        $char = strpos($date, "/") !== false ? "/" : "-";

        $date_array = explode($char, $date);

        if (count($date_array) != 3) {
            return false;
        } else {
            return checkdate($date_array[1], $date_array[0], 
                    $date_array[2]) ? true : false;
        }
    }

    /**
     * Descrever a função
     * 
     * @param type $alternativa
     * @return boolean
     */
    function verificaAlternatica($alternativa) {

        if (isset($alternativa) && is_int((int) $alternativa)) {
            return true;
        }

        return false;
    }
    
    /**
     * Descrever a função
     * 
     * @param type $peso
     * @return boolean
     */
    function verificaPeso($peso){
        //TODO: Desenvolver a lógica da função.
        return true;
    }
    
    /**
     * Descrever a função
     * 
     * @param type $altura
     * @return boolean
     */
    function verificaAltura($altura){
        //TODO: Desenvolver a lógica da função.
        
        return true;
    }
    
    /**
     * Descrever a função
     * 
     * @param type $valor
     * @return type
     */
    function ehVazio($valor){
        
        $ehVazio = true;
        $semEspacoBranco = trim($valor);
        
        if (isset($valor)) {
           $ehVazio = empty($semEspacoBranco); 
        }
        
        return $ehVazio;
    }
    
    /**
     * Descrever a função
     * 
     * @param type $valor
     * @return type
     */
    function ehNumerico($valor) {
        
        $ehNumerico = false;
        
        if(!ehVazio($valor)) {            
            $ehNumerico = is_numeric($valor);
        }
        
        return $ehNumerico;
    }
    
    /**
     * Descrever a função
     * 
     * @param type $valor
     * @return type
     */
    function ehPontoFlutuante($valor){
        
        return (is_numeric ($valor) && fmod((float) $valor, 1) !== 0);
    }
?>
