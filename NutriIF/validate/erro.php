<?php

/**
 * Descrever a função.
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

function ErroMatricula($mensagem) {

    if (isset($mensagem)){
                echo("<li>" . $mensagem . "</li>");            }
}

?>
