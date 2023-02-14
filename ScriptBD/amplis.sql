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
-- Structure de la table `amplis`
--

CREATE TABLE `amplis` (
  `idProduitAmplis` int(200) NOT NULL,
  `puissanceAmplis` int(20) NOT NULL,
  `sensibiliteAmplis` float NOT NULL,
  `marqueAmplis` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `amplis`
--

INSERT INTO `amplis` (`idProduitAmplis`, `puissanceAmplis`, `sensibiliteAmplis`, `marqueAmplis`) VALUES
(47, 25, 25, 'Cambridge Audio'),
(50, 1200, 364, 'Yamaha'),
(51, 175, 56, 'Onkyo ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amplis`
--
ALTER TABLE `amplis`
  ADD PRIMARY KEY (`idProduitAmplis`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amplis`
--
ALTER TABLE `amplis`
  MODIFY `idProduitAmplis` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amplis`
--
ALTER TABLE `amplis`
  ADD CONSTRAINT `amplis_ibfk_1` FOREIGN KEY (`idProduitAmplis`) REFERENCES `produits` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
