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