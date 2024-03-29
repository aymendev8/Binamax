-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 04 déc. 2022 à 13:32
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `binamax`
--

-- --------------------------------------------------------

--
-- Structure de la table `les_matchs`
--

CREATE TABLE `les_matchs` (
  `ID` int(11) NOT NULL,
  `equipe1` varchar(30) DEFAULT NULL,
  `equipe2` varchar(30) DEFAULT NULL,
  `score1` int(11) DEFAULT '0',
  `score2` int(11) DEFAULT '0',
  `la_date` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `cote_equipe1` double DEFAULT NULL,
  `cote_equipe2` double DEFAULT NULL,
  `cote_nul` double DEFAULT NULL,
  `vainqueur` varchar(30) DEFAULT NULL,
  `status_match` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `les_matchs`
--

INSERT INTO `les_matchs` (`ID`, `equipe1`, `equipe2`, `score1`, `score2`, `la_date`, `heure`, `cote_equipe1`, `cote_equipe2`, `cote_nul`, `vainqueur`, `status_match`) VALUES
(1, 'Maroc', 'Croatie', 1, 0, '2022-11-23', '11:00:00', 4.3, 2.18, 3.2, 'Maroc', 2),
(2, 'Belgique', 'Maroc', 0, 2, '2022-11-27', '14:00:00', 1.55, 5.65, 4, 'Maroc', 2),
(3, 'Maroc', 'Canada', 3, 0, '2022-12-01', '16:00:00', 2.4, 2.9, 3.2, 'Maroc', 2),
(4, 'France', 'Pologne', 3, 1, '2022-12-04', '16:00:00', 1.27, 10.5, 5.3, 'Match nul', 2);

-- --------------------------------------------------------

--
-- Structure de la table `les_paris`
--

CREATE TABLE `les_paris` (
  `ID` int(11) NOT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL,
  `ID_match` int(11) DEFAULT NULL,
  `equipe` varchar(30) DEFAULT NULL,
  `mise` float DEFAULT NULL,
  `la_cote` double DEFAULT NULL,
  `gain` double DEFAULT NULL,
  `est_payer` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `les_paris`
--

INSERT INTO `les_paris` (`ID`, `ID_utilisateur`, `ID_match`, `equipe`, `mise`, `la_cote`, `gain`, `est_payer`) VALUES
(18, 3, 1, 'Maroc', 7, 4.3, 30.1, 1),
(19, 3, 2, 'Maroc', 100, 5.65, 565, 1),
(20, 3, 3, 'Maroc', 100, 2.4, 240, 1),
(21, 3, 1, 'Maroc', 1000, 4.3, 4300, 1),
(22, 3, 4, 'Pologne', 1000, 10.5, 10500, 0),
(23, 3, 3, 'Maroc', 4378, 2.4, 10507.2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `administrateur` tinyint(1) DEFAULT NULL,
  `argent` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `username`, `prenom`, `nom`, `mail`, `mot_de_passe`, `administrateur`, `argent`) VALUES
(1, 'Aymenn8', 'Aymen', 'Kadri', 'aymenkadri798@gmail.com', '882baf28143fb700b388a87ef561a6e5', NULL, 10),
(3, 'admin', 'admin', 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1, 10747.5),
(4, 'Rouissimo03', 'Mohamed', 'Rouissi', 'mohamedrouissi@gmail.com', '7463502acdddabd3faa829c197c4f8ec', NULL, 110);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `les_matchs`
--
ALTER TABLE `les_matchs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `les_paris`
--
ALTER TABLE `les_paris`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`),
  ADD KEY `ID_match` (`ID_match`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `les_matchs`
--
ALTER TABLE `les_matchs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `les_paris`
--
ALTER TABLE `les_paris`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `les_paris`
--
ALTER TABLE `les_paris`
  ADD CONSTRAINT `les_paris_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateurs` (`ID`),
  ADD CONSTRAINT `les_paris_ibfk_2` FOREIGN KEY (`ID_match`) REFERENCES `les_matchs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
