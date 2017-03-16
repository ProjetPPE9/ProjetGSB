--
-- Création de la table `cabinet`
--

CREATE TABLE `cabinet` (
  `id` int(11) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `cp` int(5) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déclencheurs `cabinet`
--
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

--
-- Création de la table `interruption`
--

CREATE TABLE `interruption` (
  `codeInterruption` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `interruption`
--

INSERT INTO `interruption` (`codeInterruption`) VALUES
(0);

-- --------------------------------------------------------

--
-- Création de la table `medecin`
--

CREATE TABLE `medecin` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `idVisiteur` char(11) NOT NULL,
  `idCabinet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déclencheurs `medecin`
--
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

-- --------------------------------------------------------

--
-- Création de la table `version`
--

CREATE TABLE `version` (
  `numversion` float NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `version`
--

INSERT INTO `version` (`numversion`) VALUES
(1);

-- --------------------------------------------------------

--
-- Création de la table `visite`
--

CREATE TABLE `visite` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `rdv` tinyint(1) NOT NULL,
  `heureArriveeCabinet` time NOT NULL,
  `heureDebutEntretien` time NOT NULL,
  `heureDepartCabinet` time NOT NULL,
  `idVisiteur` char(11) NOT NULL,
  `idMedecin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour la table `cabinet`
--
ALTER TABLE `cabinet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_visiteur_id` (`idVisiteur`),
  ADD KEY `fk_cabinet_id` (`idCabinet`);

--
-- Index pour la table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_visiteur_id` (`idVisiteur`),
  ADD KEY `fk_medecin_id` (`idMedecin`);

--
-- AUTO_INCREMENT pour la table `cabinet`
--
ALTER TABLE `cabinet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `visite`
--
ALTER TABLE `visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;