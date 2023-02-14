-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 14 fév. 2023 à 21:16
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
-- Structure de la table `platine`
--

CREATE TABLE `platine` (
  `idProduitPlatine` int(10) NOT NULL,
  `formatVinyle` int(10) NOT NULL,
  `bluetooth` varchar(10) NOT NULL,
  `marquePlatine` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `platine`
--

INSERT INTO `platine` (`idProduitPlatine`, `formatVinyle`, `bluetooth`, `marquePlatine`) VALUES
(41, 1, 'Oui', 'Audio-Technica'),
(42, 0, 'Non', 'AUNA'),
(43, 0, 'Oui', 'SHUMAN');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `platine`
--
ALTER TABLE `platine`
  ADD PRIMARY KEY (`idProduitPlatine`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `platine`
--
ALTER TABLE `platine`
  MODIFY `idProduitPlatine` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `platine`
--
ALTER TABLE `platine`
  ADD CONSTRAINT `platine_ibfk_1` FOREIGN KEY (`idProduitPlatine`) REFERENCES `produits` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
