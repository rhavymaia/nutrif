<?php

/**
 * Description of MapaErro
 *
 * @author Rhavy
 */
class MapaErro {

    private static $instance;
    private static $erros;

    function __construct() {
        
    }

    // O m�todo singleton 
    public static function singleton() {
        if (!isset(self::$instance)) {
            self::$instance = new MapaErro();
            self::$erros = array(
                1 => "Impossivel criar usuario.",
                2 => "Usu�rio n�o encontrado.",
                3 => "Percentil nao encontrado.",
                4 => "Usu�rio j� cadastrado.",
                5 => "Entrevistado(a) j� cadastrado(a).",
                6 => "Nutricionista ja cadastrado(a).",
                7 => "N�o foi poss�vel calcular IMC.",
                8 => "N�o foi poss�vel encontrar anamnese.",
                9 => "Problema ao inserir a anamnese.",
                10 => "Problema ao inserir a pesquisa.",
                11 => "Dados inconpletos.",
                LOGIN_INVALIDO => "Login inv�lido.",
                SENHA_INVALIDO => "Senha inv�lida.",
                PESO_INVALIDO => "Peso inv�lido.",
                ALTURA_INVALIDO => "Altura inv�lida.",
                NIVEL_ESPORTIVO_INVALIDO => "N�vel esportivo inv�lido.",
                SEXO_INVALIDO => "Sexo inv�lido.",
                ID_PESQUISA_INVALIDO => "C�digo da Pesquisa inv�lida.",
                ID_NUTRICIONISTA_INVALIDO => "C�digo da Nutrionista inv�lido.",
                ID_ENTREVISTADO_INVALIDO => "C�digo do Entrevistado inv�lido.",
                ID_PERFIL_ALIMENTAR_INVALIDO=>"C�digo Perfil Alimentar inv�lido."
            );
        }

        return self::$instance;
    }

    /**
     * Encontrar o erro de acordo com seu c�digo. O mapa de erros est� cadastrado
     * no mapa erros.
     * 
     * @param type $codigo
     * @return \Erro
     */
    public function getErro($codigo) {
        
        $erro = new Erro();
        
        if (array_key_exists($codigo, self::$erros)) {
            $mensagem = self::$erros[$codigo];
            $erro->setCodigo($codigo);
            $erro->setMensagem($mensagem);
        } else {
            $erro->setCodigo($codigo);
            $erro->setMensagem("C�digo de erro n�o definido.");
        }     

        return $erro;
    }
}
