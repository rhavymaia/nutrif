-- 09/09/2014
ALTER TABLE `tb_usuario` ADD `nm_sexo` VARCHAR(1) NOT NULL AFTER `dt_nascimento`;

-- 13/09
ALTER TABLE  `tb_nutricionista` ADD  `nm_siape` INT NOT NULL;
ALTER TABLE  `tb_nutricionista` CHANGE  `nm_crn`  `nm_crn` INT NOT NULL;

-- 14/09/2014
ALTER TABLE `tb_usuario` ADD `vl_authkey` VARCHAR(32) NOT NULL AFTER `nm_senha`;

-- 15/09/2014
ALTER TABLE  `tb_nutricionista` CHANGE  `cd_nutricionista`  `cd_nutricionista` INT( 11 ) NOT NULL AUTO_INCREMENT
