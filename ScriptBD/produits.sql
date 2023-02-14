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
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `idProduit` int(10) NOT NULL,
  `nomProduit` varchar(50) NOT NULL,
  `prixProduit` int(10) NOT NULL,
  `descriptionProduit` varchar(1000) NOT NULL,
  `idImageProduit` int(10) NOT NULL,
  `stockProduit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `nomProduit`, `prixProduit`, `descriptionProduit`, `idImageProduit`, `stockProduit`) VALUES
(27, 'London Calling', 34, 'Réédition vinyl en 180 grammes avec les visuels d', 33, 0),
(28, 'Nevermind', 25, ',', 34, 7),
(29, 'Abbey Road', 20, '.', 35, 129),
(30, 'Rumors', 28, 'desc', 37, 16),
(31, 'Bohemian Rhapsody', 23, 'La bande orignale du film!', 38, 15),
(32, 'Thriller', 45, 'cc', 39, 0),
(33, 'Mercury', 36, 'coucou gaetan', 40, 13),
(34, 'Born to die', 27, 'oui', 41, 5),
(35, 'AM', 30, 'd', 42, 17),
(36, 'Feu', 29, 'je recommande', 43, 4),
(41, 'LP60XUSB', 150, 'PLATINE AUTOMATIQUE À ENTRAÎNEMENT PAR COURROIE (ANALOGUE & USB)', 48, 31),
(42, 'Pureness', 114, 'Platine Vinyle, Verre Acrylique, entraînement par Courroie, USB, tête de Lecture magnétique MC, arrêt Automatique, contrôle de la Vitesse, 33 1/3 et 45 t/MN - Transparent', 49, 40),
(43, 'Chaîne Stéréo en Bois 8 en 1', 217, 'Platine Vinyle, Lecteur CD,Lecteur MP3,sans Fil,Port USB,Tuner Radio FM,Radios Dab+,Enregistrement,Sortie Ligne RCA, avec Télécommande - Brun (MC250DBT)', 50, 7),
(44, 'R1280Ts', 120, 'Enceintes de Bibliothèque Amplifiées - Moniteurs de Champ Proche Actifs Stéréo 2.0-Enceinte de Moniteur de Studio-42 Watts RMS avec Sortie de Ligne de Caisson de Basses-Boîtier en Bois', 51, 10),
(45, 'SX-60', 120, 'Enceintes de Bibliothèque Amplifiées - Moniteurs de Champ Proche Actifs Stéréo 2.0-Enceinte de Moniteur de Studio-42 Watts RMS avec Sortie de Ligne de Caisson de Basses-Boîtier en Bois', 52, 45),
(46, 'Eva', 222, 'Enceintes de Bibliothèque Amplifiées - Moniteurs de Champ Proche Actifs Stéréo 2.0-Enceinte de Moniteur de Studio-42 Watts RMS avec Sortie de Ligne de Caisson de Basses-Boîtier en Bois', 53, 13),
(47, 'AXA25', 249, 'amplificateur Audio Maison Gris - Amplificateurs Audio (25 W, 0,015%, 82 DB, 32000 Ohm, 10-30000 Hz, Bornes à vis)', 54, 23),
(50, 'R-S202D', 299, 'Son Haute Qualité Yamaha, obtenu grâce à de nombreuses années d’expérience et de tradition de l’excellence. Avec 125 ans d’histoire en tant que fabricant d’instruments de musique, Yamaha est également réputé pour ses appareils Hi-Fi. Le R-S202D tire parti de cette riche expérience et expertise technologique. Il repose sur le concept « Natural Sound”, pour une reproduction fidèle de la musique, et a été conçu avec le plus grand soin, notamment pour optimiser le cheminement du signal. Le rendu est de qualité et le son riche, même pour un modèle d’entrée de gamme.', 57, 101),
(51, 'TX-NR696(B)', 955, 'Récepteur AV 7.2 Canaux (THX Cinema Sound, Dolby/DTS : X, Wifi, Bluetooth, Streaming, Applications Musicales, Spotify, Deezer, Radio, Multiroom, 175 W/Canaux), Noir', 58, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `idImageProduit` (`idImageProduit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `idProduit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`idImageProduit`) REFERENCES `imagessite` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
