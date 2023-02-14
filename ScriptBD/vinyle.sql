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
-- Structure de la table `vinyle`
--

CREATE TABLE `vinyle` (
  `idProduitVinyle` int(10) NOT NULL,
  `tailleVinyle` int(10) NOT NULL,
  `artisteVinyle` varchar(300) NOT NULL,
  `genreVinyle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vinyle`
--

INSERT INTO `vinyle` (`idProduitVinyle`, `tailleVinyle`, `artisteVinyle`, `genreVinyle`) VALUES
(27, 33, 'The Clash', 'Punk'),
(28, 33, 'Nirvana', 'Grunge, Hard Rock, Alternatif'),
(29, 33, 'The Beatles', 'Rock, Folk'),
(30, 33, 'Fleetwood Mac', 'Rock'),
(31, 33, 'Queen', 'Rock'),
(32, 33, 'Michael Jackson', 'Pop, Rock'),
(33, 33, 'Imagine Dragons', 'Pop, Rock, Electro'),
(34, 33, 'Lana Del Rey', 'Rock indé'),
(35, 33, 'Arctic Monkeys', 'Alternatif, Rock indé'),
(36, 33, 'Nekfeu', 'Rap Français, Hip-Hop');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `vinyle`
--
ALTER TABLE `vinyle`
  ADD KEY `idProduitVinyle` (`idProduitVinyle`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vinyle`
--
ALTER TABLE `vinyle`
  ADD CONSTRAINT `vinyle_ibfk_1` FOREIGN KEY (`idProduitVinyle`) REFERENCES `produits` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
