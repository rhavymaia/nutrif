<?php
    /**
     *  Verificar o formato da data preenchida pelo usu�rio. O formato esperado 
     * � dd/mm/YYYY.
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
     * Essa fun��o Verifica se o valor est� preenchido. O valor 0 ou '0' � 
     * considerado como preenchido.
     * 
     * @param type $alternativa
     * @return boolean
     */
    function ehPreenchido($alternativa){  
  
        if(isset($alternativa) && trim($alternativa)!= VAZIO){
           return true; 
        }
        
        return false; 
    } 
    
    /**
     * Descrever a fun��o.
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
     * Descrever a fun��o.
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
     * Essa fun��o testa se a vari�vel � vazia ou n�o.
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
     * Essa fun��o testa se o valor da vari�vel � num�rico ou n�o.
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
     * Essa fun��o testa se o valor da vari�vel tem ponto flutuante ou n�o.
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
 
    function isValidEmail($email){
	//Verifica se o valor � v�lido
	//Caso falhe, n�o � necess�rio continuar
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	return false;
		 
	//Extrai o dom�nio
	list($user, $host) = explode("@", $email);
	//Verifica se o dom�nio esta acess�vel
	if (!checkdnsrr($host, "MX") && !checkdnsrr($host, "A"))
            return false;	 
	return true;
    }
    
        // Define uma fun��o que poder� ser usada para validar e-mails usando regexp
    function validaEmail($email) {
        $conta = "^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$";

        $pattern = $conta.$domino.$extensao;

        if (ereg($pattern, $email))
        return true;
        else
        return false;
        }
    
    

?>
