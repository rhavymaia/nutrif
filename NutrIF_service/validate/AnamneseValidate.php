<?php

/**
 * Validar os dados do VCT.
 *
 * @author Rhavy
 */
class AnamneseValidate {

    /**
     * 
     * nutricionista": [1-9],
 *  "entrevistado": [1-9],
 *  "pesquisa": [1-9],
 *  "peso": [1-9],
 *  "altura": [1-9],
 *  "nivelEsporte": [1-5],
 *  "perfilAlimentar": [1-9]
     */
    public static function validate($idNutricionista, $idEntrevistado, 
            $idPesquisa, $peso, $altura, $nivelEsportivo, $idPerfilAlimentar) {

        $validate = VALIDO;

        if (empty($peso) || !is_numeric($peso)) {
            $validate = PESO_INVALIDO;
        }

        if (empty($altura) || !is_numeric($altura)) {
            $validate = ALTURA_INVALIDO;
        }

        if (empty($nivelEsportivo) || !is_numeric($nivelEsportivo)) {
            $validate = NIVEL_ESPORTIVO_INVALIDO;
        }

        if (empty($idNutricionista) || !is_numeric($idNutricionista)) {
            $validate = ID_NUTRICIONISTA_INVALIDO;
        }
        
        if (empty($idEntrevistado) || !is_numeric($idEntrevistado)) {
            $validate = ID_ENTREVISTADO_INVALIDO;
        }
        
        if (empty($idPesquisa)|| !is_numeric($idPesquisa)) {
            $validate = ID_PESQUISA_INVALIDO;
        }
        
        if (empty($idPerfilAlimentar)|| !is_numeric($idPerfilAlimentar)) {
            $validate = ID_PERFIL_ALIMENTAR_INVALIDO;
        }

        return $validate;
    }
}
