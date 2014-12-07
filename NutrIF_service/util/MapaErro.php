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

    // O método singleton 
    public static function singleton() {
        if (!isset(self::$instance)) {
            self::$instance = new MapaErro();
            self::$erros = array(
                1 => "Impossivel criar usuario.",
                2 => "Usuário não encontrado.",
                3 => "Percentil nao encontrado.",
                4 => "Usuário já cadastrado.",
                5 => "Entrevistado(a) já cadastrado(a).",
                6 => "Nutricionista ja cadastrado(a).",
                7 => "Não foi possível calcular IMC.",
                8 => "Não foi possível encontrar anamnese.",
                9 => "Problema ao inserir a anamnese.",
                10 => "Problema ao inserir a pesquisa.",
                11 => "Dados inconpletos.",
                LOGIN_INVALIDO => "Login inválido.",
                SENHA_INVALIDO => "Senha inválida.",
                PESO_INVALIDO => "Peso inválido.",
                ALTURA_INVALIDO => "Altura inválida.",
                NIVEL_ESPORTIVO_INVALIDO => "Nível esportivo inválido.",
                SEXO_INVALIDO => "Sexo inválido.",
                ID_PESQUISA_INVALIDO => "Código da Pesquisa inválida.",
                ID_NUTRICIONISTA_INVALIDO => "Código da Nutrionista inválido.",
                ID_ENTREVISTADO_INVALIDO => "Código do Entrevistado inválido.",
                ID_PERFIL_ALIMENTAR_INVALIDO=>"Código Perfil Alimentar inválido."
            );
        }

        return self::$instance;
    }

    /**
     * Encontrar o erro de acordo com seu código. O mapa de erros está cadastrado
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
            $erro->setMensagem("Código de erro não definido.");
        }     

        return $erro;
    }
}
