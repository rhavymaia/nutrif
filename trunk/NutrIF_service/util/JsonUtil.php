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
    public static function utf8json($inArray) {

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
                $newArray[$key] = utf8json($val);
            } else if (is_object($val)) {
                $newArray[$key] = utf8_encode(json_encode($val->toArray()));
            } else {
                /* encode string values */
                $newArray[$key] = utf8_encode($val);
            }
        }
        /* return utf8 encoded array */
        return $newArray;
    }

}
