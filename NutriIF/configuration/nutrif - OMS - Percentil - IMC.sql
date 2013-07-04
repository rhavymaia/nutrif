CREATE TABLE IF NOT EXISTS tb_imc_percentil (
  cd_imc_percentil int(11) NOT NULL AUTO_INCREMENT,
  cd_fator int(11) NOT NULL, -- Código da tabela Ex: (1) - Peso (kg) para idade (meses).
  tp_sexo char(1) NOT NULL,
  vl_fator double NOT NULL, -- Valor do Fator: Idade, comprimento, estatura.
  cd_percentil int(11) NOT NULL,  
  vl_imc_percentil double NOT NULL,
  PRIMARY KEY (`cd_imc_percentil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;


CREATE TABLE IF NOT EXISTS tb_percentil (
  cd_percentil int(11) NOT NULL AUTO_INCREMENT,
  vl_percentil double NOT NULL,
  PRIMARY KEY (`cd_percentil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

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