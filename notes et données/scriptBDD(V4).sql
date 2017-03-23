/* CREATION DES TABLES */

/* Création table Interruption */

CREATE TABLE `projetgsb`.`interruption` ( `codeInterruption` INT(11) NOT NULL , PRIMARY KEY (`codeInterruption`)) ENGINE = InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `interruption` (`codeInterruption`) VALUES(0);

/* Création table Version */

CREATE TABLE `projetgsb`.`version` ( `numversion` FLOAT NOT NULL DEFAULT '1' , PRIMARY KEY (`numversion`)) ENGINE = InnoDB;

INSERT INTO `version` (`numversion`) VALUES(1);

/* Création table Visite */ 

CREATE TABLE `projetgsb`.`visite` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `date` DATE NOT NULL , `rdv` TINYINT(1) NOT NULL , 
	`heureArriveeCabinet` TIME NOT NULL , 	`heureDebutEntretien` TIME NOT NULL , `heureDepartCabinet` TIME NOT NULL , 
	`idVisiteur` CHAR(4) NOT NULL , `idMedecin` INT(11) NOT NULL , 	PRIMARY KEY (`id`)) ENGINE = InnoDB;

/* Création table Médecin */

CREATE TABLE `projetgsb`.`medecin` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `nom` VARCHAR(45) NOT NULL , 
	`prenom` VARCHAR(45) NOT NULL , `idVisiteur` CHAR(11) NOT NULL , `idCabinet` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

/* Création table Cabinet */

CREATE TABLE `projetgsb`.`cabinet` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `adresse` VARCHAR(45) NOT NULL , 
	`ville` VARCHAR(45) NOT NULL , `cp` CHAR(5) NOT NULL , `latitude` FLOAT NOT NULL , `longitude` FLOAT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



/* CREATION DES CLES ETRANGERES */

/* Table medecin */

ALTER TABLE `medecin`
  ADD CONSTRAINT `fk_visiteur_idvis` FOREIGN KEY (`idVisiteur`) REFERENCES `utilisateur`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_cabinet_id` FOREIGN KEY (`idCabinet`) REFERENCES `cabinet`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* Table visite */

ALTER TABLE `visite`
  ADD CONSTRAINT `fk_visiteur_id` FOREIGN KEY (`idVisiteur`) REFERENCES `utilisateur`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_medecin_id` FOREIGN KEY (`idMedecin`) REFERENCES `medecin`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;



/* CREATION DES TRIGGER */


/* Déclencheurs `cabinet` */

DELIMITER $$
CREATE TRIGGER `versionModifCabinet1` AFTER INSERT ON `cabinet` FOR EACH ROW BEGIN 

UPDATE version SET numversion = numversion + 0.1;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `versionModifCabinet2` AFTER UPDATE ON `cabinet` FOR EACH ROW BEGIN 

UPDATE version SET numversion = numversion + 0.1;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `versionModifCabinet3` AFTER DELETE ON `cabinet` FOR EACH ROW BEGIN 

UPDATE version SET numversion = numversion + 0.1;

END
$$
DELIMITER ;



/* Déclencheurs `medecin` */

DELIMITER $$
CREATE TRIGGER `versionModifMedecin1` AFTER INSERT ON `medecin` FOR EACH ROW BEGIN 

UPDATE version SET numversion = numversion + 0.1;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `versionModifMedecin2` AFTER UPDATE ON `medecin` FOR EACH ROW BEGIN 

UPDATE version SET numversion = numversion + 0.1;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `versionModifMedecin3` AFTER DELETE ON `medecin` FOR EACH ROW BEGIN 

UPDATE version SET numversion = numversion + 0.1;

END
$$
DELIMITER ;