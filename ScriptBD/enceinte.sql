-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 14 fév. 2023 à 21:15
-- Version du serveur : 10.5.15-MariaDB-0+deb11u1
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gonfiantinig`
--

-- --------------------------------------------------------

--
-- Structure de la table `enceinte`
--

CREATE TABLE `enceinte` (
  `idProduitEnceinte` int(10) NOT NULL,
  `sensibiliteEnceinte` float NOT NULL,
  `puissanceEnceinte` float NOT NULL,
  `marqueEnceinte` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enceinte`
--

INSERT INTO `enceinte` (`idProduitEnceinte`, `sensibiliteEnceinte`, `puissanceEnceinte`, `marqueEnceinte`) VALUES
(44, 770, 45, 'Edifier'),
(45, 1000, 120, 'Cambridge Audio'),
(46, 450, 85, 'Davis Acoustics');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enceinte`
--
ALTER TABLE `enceinte`
  ADD KEY `idProduitEnceinte` (`idProduitEnceinte`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enceinte`
--
ALTER TABLE `enceinte`
  ADD CONSTRAINT `enceinte_ibfk_1` FOREIGN KEY (`idProduitEnceinte`) REFERENCES `produits` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
