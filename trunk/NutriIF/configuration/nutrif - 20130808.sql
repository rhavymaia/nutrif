--
-- Banco de Dados: `nutrif`
--
CREATE DATABASE `nutrif` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `nutrif`;
-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_entrevistado`
--

CREATE TABLE IF NOT EXISTS `tb_entrevistado` (
    `cd_entrevistado` int(11) NOT NULL AUTO_INCREMENT,
    `nr_matricula` bigint(11) NOT NULL,    
    `nm_entrevistado` varchar(200) NOT NULL,
    `dt_nascimento` date NOT NULL,
    `cd_nivelescolar` int(11) NOT NULL,
    `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`cd_entrevistado`),
    UNIQUE KEY `nr_matricula` (`nr_matricula`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_anamnese`
--

CREATE TABLE IF NOT EXISTS `tb_anamnese` (
    `cd_anamnese` int(11) NOT NULL AUTO_INCREMENT,
    `cd_nutricionista` int(11),
    `cd_entrevistado` int(11),
    `cd_pesquisa` int(11) NOT NULL,
    `dt_anaminese` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `nr_peso` double NOT NULL,
    `nr_altura` double NOT NULL,
    `tp_sexo` char(1) NOT NULL,
    `tp_entrevistado` int(15) NOT NULL,
    `nr_nivel_esporte` int(11) NOT NULL,
    `cd_perfilalimentar` int(11),
    PRIMARY KEY (`cd_anamnese`)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Estrutura da tabela `tb_instituicao`
--

CREATE TABLE IF NOT EXISTS `tb_instituicao` (
    `cd_instituicao` int(11) NOT NULL AUTO_INCREMENT,
    `nm_instituicao` varchar(25) NOT NULL,
    `nm_campi` varchar(25) NOT NULL,
    `nm_logradouro` varchar(255) NOT NULL,
    `cd_cidade` int(11) NOT NULL,
    `cd_estado` int(11) NOT NULL,
    PRIMARY KEY (`cd_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_instituicao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nivelescolar`
-- Nível de escolaridade
--

CREATE TABLE IF NOT EXISTS `tb_nivelescolar` (
  `cd_nivelescolar` int(11) NOT NULL,
  `nm_nivel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_nivel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nutricionista`
--

CREATE TABLE IF NOT EXISTS `tb_nutricionista` (
    `cd_nutricionista` int(11) NOT NULL,
    `nm_nutricionista` varchar(50) NOT NULL,
    `cd_instituicao` int(11) NOT NULL,
    `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cd_nutricionista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

--
-- Extraindo dados da tabela `tb_nutricionista`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--
CREATE TABLE IF NOT EXISTS `tb_usuario` (
    `cd_usuario` int(11) NOT NULL AUTO_INCREMENT,
    `nm_login` varchar(50) NOT NULL,
    `nm_senha` varchar(8) NOT NULL,
    `dt_nascimento` date NOT NULL,
    `cd_tipousuario` char NOT NULL,
    `fl_ativo` boolean NOT NULL DEFAULT '1',
    `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cd_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipousuario`
--
CREATE TABLE IF NOT EXISTS `tb_tipousuario` (
    `cd_tipousuario` int(11) NOT NULL AUTO_INCREMENT,
    `nm_tipousuario` varchar(50) NOT NULL,
    `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cd_tipousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pesquisa`
--

CREATE TABLE IF NOT EXISTS `tb_pesquisa` (
    `cd_pesquisa` int(11) NOT NULL AUTO_INCREMENT,
    `nm_pesquisa` varchar(25) NOT NULL,
    `dt_inicio` date NOT NULL,
    `dt_fim` date NOT NULL,
    `cd_instituicao` int(11) NOT NULL,
    `cd_nutricionista` int(11),
    `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`cd_pesquisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_pesquisa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_resposta`
--

CREATE TABLE IF NOT EXISTS `tb_perfilalimentar` (
  `cd_perfilalimentar` int(11) NOT NULL AUTO_INCREMENT,
  `cd_entrevistado` int(11) NOT NULL,
  `cd_anamnese` int(11) NOT NULL,
  `r1` varchar(1) NOT NULL,
  `r2` varchar(1) NOT NULL,
  `r3` varchar(1) NOT NULL,
  `r4` varchar(1) NOT NULL,
  `r5` varchar(1) NOT NULL,
  `r6` varchar(1) NOT NULL,
  `r7` varchar(1) NOT NULL,
  `r8` varchar(1) NOT NULL,
  `r9` varchar(1) NOT NULL,
  `r10` varchar(1) NOT NULL,
  `r11` varchar(1) NOT NULL,
  `r12` varchar(1) NOT NULL,
  `r13` varchar(1) NOT NULL,
  `r14` varchar(1) NOT NULL,
  `r15` varchar(1) NOT NULL,
  `r16` varchar(1) NOT NULL,
  `r17_a` int(11) NOT NULL,
  `r17_b` int(11) NOT NULL,
  `r17_c` int(11) NOT NULL,
  `r17_d` int(11) NOT NULL,
  `r18_cafe_da_manha` varchar(1) NOT NULL,
  `r18_lanche_da_manha` varchar(1) NOT NULL,
  `r18_almoco` varchar(1) NOT NULL,
  `r18_lanche_da_tarde` varchar(1) NOT NULL,
  `r18_jantar` varchar(1) NOT NULL,
  `r18_lanche_da_noite` varchar(1) NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cd_perfilalimentar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tb_resposta`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_percentil`
--

CREATE TABLE IF NOT EXISTS tb_percentil (
  cd_percentil int(11) NOT NULL,
  vl_percentil double NOT NULL,
  PRIMARY KEY (`cd_percentil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `tb_percentil` (`cd_percentil`, `vl_percentil`) VALUES
(1, 0.1),
(2, 3),
(3, 5),
(4, 10),
(5, 15),
(6, 50),
(7, 85),
(8, 97),
(9, 99.9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imc_percentil`
--

CREATE TABLE IF NOT EXISTS `tb_imc_percentil` (
  `cd_imc_percentil` int(11) NOT NULL AUTO_INCREMENT,
  `cd_fator` int(11) NOT NULL,
  `tp_sexo` char(1) NOT NULL,
  `vl_fator` double NOT NULL,
  `cd_percentil` int(11) NOT NULL,
  `vl_imc_percentil` double NOT NULL,
  PRIMARY KEY (`cd_imc_percentil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;