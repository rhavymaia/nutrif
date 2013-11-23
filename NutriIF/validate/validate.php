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
     * Descrever a função.
     * 
     * @param type $alternativa
     * @return boolean
     */
    function verificaAlternativa($alternativa){  
  
        if(isset($alternativa)){ 
            return true; 
        } 
          
        return false; 
    } 
    
    /**
     * Descrever a função.
     * 
     * @param type $peso
     * @return boolean
     */
    function verificaPeso($peso){
       if ($peso> 0)
        return true;
       else
           return false;
    }
    
    /**
     * Descrever a função.
     * 
     * @param type $altura
     * @return boolean
     */
    function verificaAltura($altura){
                        
         /* if (is_int($altura) && ($altura> 0 && $altura<=250))
                $verificaAltura = true;   */

        $verificaAltura = is_int(intval($altura));   

      return $verificaAltura;
    }
    
    /**
     * Essa função testa se a variável é vazia ou não.
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
     * Essa função testa se o valor da variável é numérico ou não.
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
     * Essa função testa se o valor da variável tem ponto flutuante ou não.
     * 
     * @param type $valor
     * @return type
     */
    function ehPontoFlutuante($valor){
        
        return (is_numeric ($valor) && fmod((float) $valor, 1) !== 0);
    }
    
    function ehNulo($data) {
        /** only if you need this
          if (is_string($data)) {
          $data = strtolower($data);
          }
         */
        switch ($data) {
            // Add whatever your definition of null is
            // This is just an example
            //-----------------------------
            case 'unknown': // continue
            case 'undefined': // continue
            //-----------------------------
            case 'null': // continue
            case 'NULL': // continue
            case NULL:
                return true;
        }
        // return false by default
        return false;
    }
?>
