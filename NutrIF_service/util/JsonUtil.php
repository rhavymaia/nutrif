<?php

/**
 * Classe utilitária para manipulação do JsonUtil
 *
 * @author Rhavy Maia Guedes
 */
class JsonUtil {

    /**
     * Codificar caracter em UTF-8.
     * 
     * @staticvar int $depth
     * @param type $inArray
     * @return boolean
     */
    public static function utf8ToJson($inArray) {

        static $depth = 0;

        /* our return object */
        $newArray = array();
        /* safety recursion limit */
        $depth ++;
        if ($depth >= '30') {
            return false;
        }
        /* step through inArray */
        foreach ($inArray as $key => $val) {
            if (is_array($val)) {
                /* recurse on array elements */
                $newArray[$key] = utf8json(json_encode($val));
            } else if (!is_null($val) && is_object($val)) {
                $newArray[$key] = utf8_encode(json_encode($val->toArray()));
            } else {
                /* encode string values */
                $newArray[$key] = utf8_encode(json_encode($val));
            }
        }
        /* return utf8 encoded array */
        return $newArray;
    }
    
    /**
     * Converter objetos em array.
     * 
     * @param type $var
     * @return type
     */
    public static function objectToArray($var) {
        $result = array();
        $references = array();

        // loop over elements/properties
        foreach ($var as $key => $value) {
            // recursively convert objects
            if (is_object($value) || is_array($value)) {
                // but prevent cycles
                if (!in_array($value, $references)) {
                    // Verificar se o valor é nulo. Não adiciona tuplas 
                    // vazias ao json
                    if (!is_null($value) && !empty($value)) {
                        $result[$key] = JsonUtil::objectToArray($value);
                        $references[] = $value;
                    }                   
                }
            } else {
                // Verificar se o valor é nulo. Não adiciona tuplas 
                // vazias ao json
                if (!is_null($value) && !empty($value))
                    // simple values are untouched
                    $result[$key] = utf8_encode($value);
            }
        }
        return $result;
    }
}
