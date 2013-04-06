-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 29/10/2012 às 12:23:22
-- Versão do Servidor: 5.5.25a
-- Versão do PHP: 5.4.4

--
-- Banco de Dados: `nutrir`
--

-- --------------------------------------------------------
CREATE DATABASE nutrif;
--
-- Estrutura da tabela `tb_entrevistado`
--
CREATE TABLE IF NOT EXISTS `tb_nivel` (
	cd_nivel int NOT NULL,
	nm_nivel varchar(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS `tb_entrevistado` (
  `cd_entrevistado` bigint(11) NOT NULL COMMENT 'O código do entrevistado é a matrícula do Aluno',
  `dt_nascimento` date NOT NULL,
  `nr_peso` double NOT NULL,
  `cd_nivel` int NOT NULL,
  `nr_altura` double NOT NULL,
  `tp_sexo` char NOT NULL COMMENT 'Feminino/ Masculino',
  `tp_entrevitado` varchar(15) NOT NULL COMMENT 'Bolsitsa/ Não Bolsista',
  `nr_nivel_esporte` int(11) NOT NULL,
  `nr_vct` double NOT NULL COMMENT 'Valor Calórico Total',
  `cd_pesquisa` int(11) NOT NULL,
  `cd_resultado` int(11) NOT NULL,
  PRIMARY KEY (`matricula`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_escola`
--

CREATE TABLE IF NOT EXISTS `tb_escola` (
  `cd_escola` int(11) NOT NULL AUTO_INCREMENT,
  `nm_escola` varchar(25) NOT NULL,
  PRIMARY KEY (`cd_escola`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_nutricionista`
--

CREATE TABLE IF NOT EXISTS `tb_nutricionista` (
  `cd_nutricionista` int(11) NOT NULL AUTO_INCREMENT,
  `nm_nutricionista` varchar(50) NOT NULL,
  `nm_senha` varchar(8) NOT NULL,
  `cd_escola` int(11) NOT NULL,
  PRIMARY KEY (`cd_nutricionista`)
);

-----------------------------------------------------------

--
-- Estrutura da tabela `tb_pesquisa`
--

CREATE TABLE IF NOT EXISTS `tb_pesquisa` (
  `cd_pesquisa` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pesquisa` varchar(25) NOT NULL,
  `dt_pesquisa` date NOT NULL,
  `cd_escola` int(11) NOT NULL,
  PRIMARY KEY (`cd_pesquisa`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_resposta`
--

CREATE TABLE IF NOT EXISTS `tb_resposta` (
  `cd_resposta` int(11) NOT NULL AUTO_INCREMENT,
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
  `r17_a` int NOT NULL,
  `r17_b` int NOT NULL,
  `r17_c` int NOT NULL,
  `r17_d` int NOT NULL,
  `r18_cafe_da_manha` varchar(1) NOT NULL,
  `r18_lanche_da_manha` varchar(1) NOT NULL,
  `r18_almoco` varchar(1) NOT NULL,
  `r18_lanche_da_tarde` varchar(1) NOT NULL,
  `r18_jantar` varchar(1) NOT NULL,
  `r18_lanche_da_noite` varchar(1) NOT NULL,
  `resultado` int(11) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cd_entrevistado` bigint(12) NOT NULL,
  PRIMARY KEY (`cd_resposta`)
);
