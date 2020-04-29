-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 18 Septembre 2019 à 12:54
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `kysoft`
--
CREATE DATABASE IF NOT EXISTS `kysoft` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `kysoft`;

-- --------------------------------------------------------

--
-- Structure de la table `caracteriser`
--

CREATE TABLE IF NOT EXISTS `caracteriser` (
  `idPdt` int(5) NOT NULL,
  `idCat` int(2) NOT NULL,
  PRIMARY KEY (`idPdt`,`idCat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `caracteriser`
--

INSERT INTO `caracteriser` (`idPdt`, `idCat`) VALUES
(8, 3),
(9, 3),
(10, 7),
(11, 3),
(11, 4),
(13, 5),
(14, 6);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` int(2) NOT NULL AUTO_INCREMENT,
  `nomCat` varchar(30) NOT NULL,
  PRIMARY KEY (`idCat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCat`, `nomCat`) VALUES
(3, 'Composant'),
(4, 'Périphérique'),
(5, 'Ecran'),
(6, 'Câbles'),
(7, 'Nettoyage');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idPdt` int(5) NOT NULL AUTO_INCREMENT,
  `nomPdt` varchar(30) NOT NULL,
  `puhtPdt` float NOT NULL,
  `descPdt` text NOT NULL,
  PRIMARY KEY (`idPdt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idPdt`, `nomPdt`, `puhtPdt`, `descPdt`) VALUES
(8, 'Clavier STO', 20, 'NC'),
(9, 'Ram 2Mo', 450, 'NC'),
(10, 'Aerosol RGB anti-poussiere', 10, 'NC'),
(11, 'SSD externe 100TO', 999999, 'NC'),
(13, 'Ecran 0,0001 ms 1400GHz', 350, 'NC'),
(14, 'Cable jack casque 10cm', 0, 'NC');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(40) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `mdp`) VALUES
('admin', 'admin'),
('test', 'test'),
('test@test.fr', 'test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
