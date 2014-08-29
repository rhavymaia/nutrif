<?php

/**
 * Descrever a função.
 * 
 * @param type $msqsErro
 */
function showListErro($msgsErro) {

    if (isset($msgsErro)) {        
        if (is_array($msgsErro)){
            echo '<div class="caixa_erro">';
            foreach ($msgsErro as $msgErro) {
                foreach ($msgErro as $campo => $mensagem) {
                    
                    echo(  $mensagem  );
                    echo '<br>';
                }
            }
            echo '</div>';
        } else {
            echo("<li>" . $msgsErro . "</li>");
        }
        
    }
}
?>
