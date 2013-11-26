<?php

/**
 * Descrever a função.
 * 
 * @param type $msqsErro
 */
function showListErro($msgsErro) {

    if (isset($msgsErro)) {        
        if (is_array($msgsErro)){
            foreach ($msgsErro as $msgErro) {
                foreach ($msgErro as $campo => $mensagem) {
                    echo("<li>" . $mensagem . "</li>");
                }
            }
        } else {
            echo("<li>" . $msgsErro . "</li>");
        }
        
    }
}
?>
