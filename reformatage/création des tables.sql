-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: mysql1.paris1.alwaysdata.com
-- Generation Time: Nov 24, 2016 at 10:10 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sushinoss_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `NOTE` int(11) NOT NULL DEFAULT '5',
  `AVIS` varchar(1024) DEFAULT NULL,
  `DATE` date NOT NULL,
  `DATEDERNIERVOTE` date DEFAULT NULL,
  `NUMUSER` int(11) NOT NULL,
  PRIMARY KEY (`NUMUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`NOTE`, `AVIS`, `DATE`, `DATEDERNIERVOTE`, `NUMUSER`) VALUES
(4, NULL, '2014-10-02', NULL, 2),
(6, 'Super !', '2015-06-20', '2016-11-02', 3),
(8, 'Miam.', '2015-09-30', '2016-10-15', 4);

--
-- Triggers `avis`
--
DROP TRIGGER IF EXISTS `maxProduits`;
DELIMITER //
CREATE TRIGGER `maxProduits` BEFORE INSERT ON `avis`
 FOR EACH ROW Begin 

DECLARE v_nb int;
DECLARE MAX_PRODUIT CONDITION FOR SQLSTATE '10000';
select COUNT(numproduit) into v_nb from preference where new.numuser = numuser;

if v_nb > 5 THEN
SIGNAL MAX_PRODUIT
SET MESSAGE_TEXT = 'Nombe maximum de produit favoris atteint';

end if;

End
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `NUMCOMMANDE` int(11) NOT NULL AUTO_INCREMENT,
  `RUE` varchar(250) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `VILLE` varchar(200) DEFAULT NULL,
  `NUMRUE` decimal(8,0) DEFAULT NULL,
  `CODEPOSTAL` varchar(6) DEFAULT NULL,
  `TYPECOMMANDE` varchar(200) NOT NULL,
  PRIMARY KEY (`NUMCOMMANDE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`NUMCOMMANDE`, `RUE`, `DATE`, `VILLE`, `NUMRUE`, `CODEPOSTAL`, `TYPECOMMANDE`) VALUES
(1, NULL, '2015-10-02', NULL, NULL, NULL, 'A emporter'),
(2, NULL, '2015-11-04', NULL, NULL, NULL, 'A Emporter'),
(3, 'Rue de l honneur', '2015-12-07', 'Pietache', '35', '07100', 'Livraison');

-- --------------------------------------------------------

--
-- Table structure for table `commandeEnregistree`
--

CREATE TABLE IF NOT EXISTS `commandeEnregistree` (
  `NUMCOMMANDE` int(11) NOT NULL,
  `NUMUSER` int(11) NOT NULL,
  PRIMARY KEY (`NUMCOMMANDE`,`NUMUSER`),
  KEY `FK_PASSE_UNE2` (`NUMUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandeEnregistree`
--

INSERT INTO `commandeEnregistree` (`NUMCOMMANDE`, `NUMUSER`) VALUES
(1, 4),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `compatibilite`
--

CREATE TABLE IF NOT EXISTS `compatibilite` (
  `NUMPRODUIT` int(11) NOT NULL,
  `NUMPRODUIT2` int(11) NOT NULL,
  PRIMARY KEY (`NUMPRODUIT`,`NUMPRODUIT2`),
  KEY `FK_EST_COMPATIBLE` (`NUMPRODUIT2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compatibilite`
--

INSERT INTO `compatibilite` (`NUMPRODUIT`, `NUMPRODUIT2`) VALUES
(1, 2),
(1, 3),
(3, 2),
(4, 6),
(5, 2),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `NUMIMAGE` int(11) NOT NULL AUTO_INCREMENT,
  `SOURCEMOYEN` varchar(1024) NOT NULL,
  `SOURCEPETIT` varchar(1024) DEFAULT NULL,
  `SOURCEGRAND` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`NUMIMAGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`NUMIMAGE`, `SOURCEMOYEN`, `SOURCEPETIT`, `SOURCEGRAND`) VALUES
(1, 'src/img/img002', 'src/img/img001', 'src/img/img003'),
(2, 'src/img/img102', 'src/img/img101', 'src/img/img103'),
(3, 'src/img/img202', 'src/img/img201', 'src/img/img203'),
(4, 'src/img/img302', 'src/img/img301', 'src/img/img303'),
(5, 'src/img/img402', 'src/img/img401', 'src/img/img403'),
(6, 'src/img/img502', 'src/img/img501', 'src/img/img503'),
(7, 'src/img/img602', 'src/img/img601', 'src/img/img603');

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE IF NOT EXISTS `preference` (
  `NUMUSER` int(11) NOT NULL,
  `NUMPRODUIT` int(11) NOT NULL,
  `CLASSEMENT` decimal(2,0) DEFAULT NULL,
  PRIMARY KEY (`NUMUSER`,`NUMPRODUIT`),
  KEY `FK_PREFERE` (`NUMPRODUIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`NUMUSER`, `NUMPRODUIT`, `CLASSEMENT`) VALUES
(3, 3, '1'),
(4, 1, '1'),
(4, 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `NUMPRODUIT` int(11) NOT NULL AUTO_INCREMENT,
  `NUMIMAGE` int(11) NOT NULL,
  `DESCRIPTION` varchar(512) NOT NULL,
  `PRIX` decimal(8,0) NOT NULL,
  `TYPEPRODUIT` varchar(100) NOT NULL,
  `LIBELLE` varchar(50) NOT NULL,
  PRIMARY KEY (`NUMPRODUIT`),
  KEY `FK_APPARTIENT` (`TYPEPRODUIT`),
  KEY `FK_POSSEDE3` (`NUMIMAGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`NUMPRODUIT`, `NUMIMAGE`, `DESCRIPTION`, `PRIX`, `TYPEPRODUIT`, `LIBELLE`) VALUES
(1, 2, 'Sushi au saumon', '10', 'Sushi', 'Sushi noss'),
(2, 3, 'Sauce de base', '1', 'Sauce', 'Ketchup'),
(3, 4, 'Riz au lait', '3', 'Accompagnement', 'Rix titi'),
(4, 5, 'Maki au poulet', '6', 'Maki', 'Makizu chichi'),
(5, 6, 'Sushi au cabillaud', '5', 'Sushi', 'Sushi rah'),
(6, 7, 'Boîte d algues rouges', '9', 'Accompagnement', 'Alges à gogo');

-- --------------------------------------------------------

--
-- Table structure for table `quantiteProduit`
--

CREATE TABLE IF NOT EXISTS `quantiteProduit` (
  `NUMCOMMANDE` int(11) NOT NULL,
  `NUMPRODUIT` int(11) NOT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  PRIMARY KEY (`NUMCOMMANDE`,`NUMPRODUIT`),
  KEY `FK_CONTIENT` (`NUMPRODUIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quantiteProduit`
--

INSERT INTO `quantiteProduit` (`NUMCOMMANDE`, `NUMPRODUIT`, `QUANTITE`) VALUES
(1, 1, 2),
(1, 2, 1),
(1, 6, 1),
(2, 3, 4),
(2, 5, 1),
(3, 2, 4),
(3, 3, 2),
(3, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `typeProduit`
--

CREATE TABLE IF NOT EXISTS `typeProduit` (
  `LIBELLE` varchar(50) NOT NULL,
  PRIMARY KEY (`LIBELLE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeProduit`
--

INSERT INTO `typeProduit` (`LIBELLE`) VALUES
('Accompagnement'),
('Maki'),
('Sauce'),
('Sushi');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `NUMUSER` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(20) NOT NULL,
  `PRENOM` varchar(20) NOT NULL,
  `MAIL` varchar(50) NOT NULL,
  `VILLE` varchar(200) DEFAULT NULL,
  `RUE` varchar(250) DEFAULT NULL,
  `CODEPOSTAL` varchar(6) DEFAULT NULL,
  `TELEPHONE` varchar(11) DEFAULT NULL,
  `TYPEUSER` varchar(20) NOT NULL,
  `PSEUDO` varchar(25) NOT NULL,
  `MDP` varchar(1024) NOT NULL,
  `NUMRUE` varchar(100) DEFAULT NULL,
  `DATEINSCRIPTION` date DEFAULT NULL,
  PRIMARY KEY (`NUMUSER`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`NUMUSER`, `NOM`, `PRENOM`, `MAIL`, `VILLE`, `RUE`, `CODEPOSTAL`, `TELEPHONE`, `TYPEUSER`, `PSEUDO`, `MDP`, `NUMRUE`, `DATEINSCRIPTION`) VALUES
(1, 'Menvu', 'Gérard', 'adr@mail.fr', NULL, NULL, NULL, '0404040404', 'ADMIN', 'gmenvu', '1234', NULL, NULL),
(2, 'Atan', 'Charles', 'addmail.en', NULL, NULL, NULL, '0505050505', 'USER', 'catan', '2345', NULL, NULL),
(3, 'Doeuf', 'John', 'ddd@mail.us', NULL, NULL, NULL, '0202020202', 'USER', 'jdoeuf', '3456', NULL, NULL),
(4, 'Pietrac', 'Nicolas', 'aha@mail.net', 'Ploubelec', 'rue des Alouettes', '14100', '0606060606', 'USER', 'npietrac', '4567', '42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `NUMAVIS` int(11) NOT NULL,
  `NUMUSER` int(11) NOT NULL,
  `VOTE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`NUMAVIS`,`NUMUSER`),
  KEY `FK_VOTE2` (`NUMUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`NUMAVIS`, `NUMUSER`, `VOTE`) VALUES
(2, 4, 0),
(3, 2, 1),
(3, 4, 1),
(4, 2, 0),
(4, 3, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_POSTE_UN2` FOREIGN KEY (`NUMUSER`) REFERENCES `utilisateur` (`NUMUSER`);

--
-- Constraints for table `commandeEnregistree`
--
ALTER TABLE `commandeEnregistree`
  ADD CONSTRAINT `FK_PASSE_UNE` FOREIGN KEY (`NUMCOMMANDE`) REFERENCES `commande` (`NUMCOMMANDE`),
  ADD CONSTRAINT `FK_PASSE_UNE2` FOREIGN KEY (`NUMUSER`) REFERENCES `utilisateur` (`NUMUSER`);

--
-- Constraints for table `compatibilite`
--
ALTER TABLE `compatibilite`
  ADD CONSTRAINT `FK_EST_COMPATIBLE` FOREIGN KEY (`NUMPRODUIT2`) REFERENCES `produit` (`NUMPRODUIT`),
  ADD CONSTRAINT `FK_EST_COMPATIBLE2` FOREIGN KEY (`NUMPRODUIT`) REFERENCES `produit` (`NUMPRODUIT`);

--
-- Constraints for table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `FK_PREFERE` FOREIGN KEY (`NUMPRODUIT`) REFERENCES `produit` (`NUMPRODUIT`),
  ADD CONSTRAINT `FK_PREFERE2` FOREIGN KEY (`NUMUSER`) REFERENCES `utilisateur` (`NUMUSER`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_APPARTIENT` FOREIGN KEY (`TYPEPRODUIT`) REFERENCES `typeProduit` (`LIBELLE`),
  ADD CONSTRAINT `FK_POSSEDE3` FOREIGN KEY (`NUMIMAGE`) REFERENCES `image` (`NUMIMAGE`);

--
-- Constraints for table `quantiteProduit`
--
ALTER TABLE `quantiteProduit`
  ADD CONSTRAINT `FK_CONTIENT` FOREIGN KEY (`NUMPRODUIT`) REFERENCES `produit` (`NUMPRODUIT`),
  ADD CONSTRAINT `FK_CONTIENT2` FOREIGN KEY (`NUMCOMMANDE`) REFERENCES `commande` (`NUMCOMMANDE`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_VOTE` FOREIGN KEY (`NUMAVIS`) REFERENCES `avis` (`NUMUSER`),
  ADD CONSTRAINT `FK_VOTE2` FOREIGN KEY (`NUMUSER`) REFERENCES `utilisateur` (`NUMUSER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
