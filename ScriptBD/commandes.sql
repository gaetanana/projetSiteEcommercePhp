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
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `idcommande` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  `datecommande` datetime NOT NULL DEFAULT current_timestamp(),
  `infocommande` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idcommande`, `idclient`, `datecommande`, `infocommande`) VALUES
(1, 914, '2022-12-30 20:54:39', '28:25:1;29:20:1;'),
(2, 914, '2022-12-30 21:10:48', '28:25:1;29:20:1;'),
(3, 917, '2022-12-30 23:42:43', '46:222:1;'),
(4, 914, '2022-12-31 08:29:09', '27:34:1;'),
(5, 917, '2022-12-31 13:17:55', '44:120:1;42:114:1;28:25:1;'),
(8, 914, '2023-01-04 10:02:25', '35:30:1;'),
(9, 926, '2023-01-06 09:14:36', '43:217:1;'),
(11, 917, '2023-01-08 00:42:43', '45:120:1;29:20:1;27:34:1;');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idcommande`),
  ADD KEY `commandes_utilisateur_id_fk` (`idclient`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idcommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_utilisateur_id_fk` FOREIGN KEY (`idclient`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
