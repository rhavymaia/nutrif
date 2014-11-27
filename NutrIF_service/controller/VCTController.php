<?php

/**
 * Description of VCTController
 *
 * @author Projeto IFPB-CG 01
 */
class VCTController {

    public static function calculaVCT($anamnese) {

        $entrevistado = $anamnese->getEntrevistado();
        
        $sexo = strtoupper($entrevistado->getSexo());
        $idade = DataUtil::calcularIdadeAnos(
                $entrevistado->getNascimento());

        $altura = ($anamnese->getAltura());
        $peso = $anamnese->getPeso();
        $nivelEsporte = $anamnese->getNivelEsporte();
        
        $vlNivelEsporte = 0;
        $taxaMetabolicaBasal = 0;

        //Verificando valores para os níveis de atividade física.
        if ($nivelEsporte == NIVEL_ESPORTE_LEVE) {
            if ($sexo == MASCULINO) {
                $vlNivelEsporte = 1.55;
            } else if ($sexo == FEMININO) {
                $vlNivelEsporte = 1.56;
            }
        } else if ($nivelEsporte == NIVEL_ESPORTE_MODERADO) {
            if ($sexo == MASCULINO) {
                $vlNivelEsporte = 1.78;
            } else if ($sexo == FEMININO) {
                $vlNivelEsporte = 1.64;
            }
        } else if ($nivelEsporte == NIVEL_ESPORTE_INTENSO) {
            if ($sexo == MASCULINO) {
                $vlNivelEsporte = 2.10;
            } else if ($sexo == FEMININO) {
                $vlNivelEsporte = 1.82;
            }
        }

        // Cálculo da taxa metabolica basal por idade e sexo.
        if ($sexo == MASCULINO) {
            if ($idade >= 10 && $idade < 18) {
                $taxaMetabolicaBasal = (16.6 * $peso) + (77 * $altura + 572);
            } else if ($idade >= 18 && $idade < 30) {
                $taxaMetabolicaBasal = (15.4 * $peso) + (27 * $altura + 717);
            } else if ($idade >= 30 && $idade <= 60) {
                $taxaMetabolicaBasal = (11.3 * $peso) + (16 * $altura + 901);
            } else if ($idade > 60) {
                $taxaMetabolicaBasal = (8.8 * $peso) + (1.128 * $altura - 1071);
            }
        } else if ($sexo == FEMININO) {
            if ($idade >= 10 && $idade < 18) {
                $taxaMetabolicaBasal = (7.4 * $peso) + (482 * $altura + 217);
            } else if ($idade >= 18 && $idade < 30) {
                $taxaMetabolicaBasal = (13.3 * $peso) + (334 * $altura + 35);
            } else if ($idade >= 30 && $idade <= 60) {
                $taxaMetabolicaBasal = (8.7 * $peso) - (255 * $altura + 865);
            } else if ($idade > 60) {
                $taxaMetabolicaBasal = (9.2 * $peso) + (637 * $altura - 302);
            }
        }

        $vct = new Vct();
        
        // VCT = Taxa Metabolica Basal * Nivel esporte
        $vct->setValor($taxaMetabolicaBasal * $vlNivelEsporte);
        $vct->setAnamnese($anamnese);

        return $vct;
    }

}
