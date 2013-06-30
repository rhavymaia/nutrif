CREATE TABLE IF NOT EXISTS tb_imc_percentil (
  cd_imc_percentil int(11) NOT NULL AUTO_INCREMENT,
  cd_fator int(11) NOT NULL, -- Código da tabela Ex: (1) - Peso (kg) para idade (meses).
  tp_sexo char(1) NOT NULL,
  vl_fator double NOT NULL, -- Valor do Fator: Idade, comprimento, estatura.
  nr_p_01 double NOT NULL,  
  nr_p_3 double NOT NULL,
  nr_p_5 double NOT NULL,
  nr_p_10 double NOT NULL,
  nr_p_15 double NOT NULL,
  nr_p_50 double NOT NULL,
  nr_p_85 double NOT NULL,
  nr_p_97 double NOT NULL,
  nr_p_999 double NOT NULL,
  PRIMARY KEY (`cd_imc_percentil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;