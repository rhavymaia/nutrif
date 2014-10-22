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

    public static function object_to_array($var) {
        $result = array();
        $references = array();

        // loop over elements/properties
        foreach ($var as $key => $value) {
            // recursively convert objects
            if (is_object($value) || is_array($value)) {
                // but prevent cycles
                if (!in_array($value, $references)) {
                    $result[$key] = JsonUtil::object_to_array($value);
                    $references[] = $value;
                }
            } else {
                // simple values are untouched
                $result[$key] = utf8_encode($value);
            }
        }
        return $result;
    }

    public static function recursive_utf8($data) {
        if (!is_array($data) || !is_object($data)) {
            return utf8_encode($data);
        }
        $result = array();
        foreach ($data as $index => $item) {
            if (is_array($item)) {
                $result[$index] = array();
                foreach ($item as $key => $value) {
                    $result[$index][$key] = recursive_utf8($value);
                }
            } else if (is_object($item)) {
                $result[$index] = array();
                foreach (get_object_vars($item) as $key => $value) {
                    $result[$index][$key] = recursive_utf8($value);
                }
            } else {
                $result[$index] = recursive_utf8($item);
            }
        }
        return $result;
    }

    public static function my_json_encode($in) {
        $_escape = function ($str) {
            return addcslashes($str, "\v\t\n\r\f\"\\/");
        };
        $out = "";
        if (is_object($in)) {
            $class_vars = get_object_vars(($in));
            $arr = array();
            foreach ($class_vars as $key => $val) {
                $arr[$key] = "\"{$_escape($key)}\":\"{$val}\"";
            }
            $val = implode(',', $arr);
            $out .= "{{$val}}";
        } elseif (is_array($in)) {
            $obj = false;
            $arr = array();
            foreach ($in AS $key => $val) {
                if (!is_numeric($key)) {
                    $obj = true;
                }
                $arr[$key] = my_json_encode($val);
            }
            if ($obj) {
                foreach ($arr AS $key => $val) {
                    $arr[$key] = "\"{$_escape($key)}\":{$val}";
                }
                $val = implode(',', $arr);
                $out .= "{{$val}}";
            } else {
                $val = implode(',', $arr);
                $out .= "[{$val}]";
            }
        } elseif (is_bool($in)) {
            $out .= $in ? 'true' : 'false';
        } elseif (is_null($in)) {
            $out .= 'null';
        } elseif (is_string($in)) {
            $out .= "\"{$_escape($in)}\"";
        } else {
            $out .= $in;
        }
        return "{$out}";
    }

}
