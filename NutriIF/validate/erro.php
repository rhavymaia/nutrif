<?php

/**
 * Descrever a fun��o.
 * 
 * @param type $msqsErro
 */
function showListErro($msgsErro) {

    if (isset($msgsErro)) {

        foreach ($msgsErro as $msgErro) {
            foreach ($msgErro as $campo => $mensagem) {
                echo("<li>" . $mensagem . "</li>");
            }
        }
    }
}

?>
