-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 16 oct. 2018 à 17:03
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sb_cvportfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_competences`
--

CREATE TABLE `t_competences` (
  `id_competence` int(3) NOT NULL,
  `competence` varchar(150) NOT NULL,
  `niveau` int(3) NOT NULL,
  `categorie` enum('Front','Back','CMS','Frameworks') NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_competences`
--

INSERT INTO `t_competences` (`id_competence`, `competence`, `niveau`, `categorie`, `id_utilisateur`) VALUES
(1, 'HTML', 80, 'Front', 1),
(3, 'CSS', 80, 'Front', 1),
(4, 'Js', 60, 'Front', 1),
(5, 'Php 7', 60, 'Back', 1),
(6, 'WordPress', 80, 'CMS', 0),
(9, 'trotinette', 60, 'CMS', 1),
(10, 'jsqhvbjh', 125, 'Front', 0),
(11, 'mouh', 50, 'Back', 0),
(12, 'lili', 80, 'Back', 0),
(13, 'kjwdxbcjhwsdbcjhwsbcj', 70, 'Back', 0),
(14, 'dsvmksdnjko', 70, 'CMS', 0),
(15, ',hnjbjhvb', 54, 'Back', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_experiences`
--

CREATE TABLE `t_experiences` (
  `id_experience` int(3) NOT NULL,
  `titre_exp` varchar(150) NOT NULL,
  `stitre_exp` varchar(200) NOT NULL,
  `dates_exp` year(4) NOT NULL,
  `description_exp` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_experiences`
--

INSERT INTO `t_experiences` (`id_experience`, `titre_exp`, `stitre_exp`, `dates_exp`, `description_exp`, `id_utilisateur`) VALUES
(1, 'sqjhvcjh', 'fdgbvdbv', 0000, 'jhdbfsjdfskjhdcqsjhdlksqhjl', 0),
(2, 'hfgfgvjh', 'trjygn', 0000, 'dgsljvfnsdncklwxn&lt;nc,', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE `t_formations` (
  `id_formation` int(3) NOT NULL,
  `titre_form` varchar(150) NOT NULL,
  `stitre_form` varchar(150) NOT NULL,
  `dates_form` varchar(100) NOT NULL,
  `description_form` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_loisirs`
--

CREATE TABLE `t_loisirs` (
  `id_loisir` int(3) NOT NULL,
  `loisir` varchar(200) NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_loisirs`
--

INSERT INTO `t_loisirs` (`id_loisir`, `loisir`, `id_utilisateur`) VALUES
(4, 'Pâti', 1),
(7, 'tester', 1),
(8, 'fgbfdhj', 0),
(9, 'mouh', 0),
(10, 'rehe', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_messages`
--

CREATE TABLE `t_messages` (
  `id_message` int(3) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sujet` varchar(150) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_realisations`
--

CREATE TABLE `t_realisations` (
  `id_realisation` int(3) NOT NULL,
  `titre_real` varchar(150) NOT NULL,
  `stitre_real` varchar(150) NOT NULL,
  `dates-real` varchar(100) NOT NULL,
  `description_real` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_reseaux`
--

CREATE TABLE `t_reseaux` (
  `id_reseau` int(3) NOT NULL,
  `url` varchar(120) NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_titres`
--

CREATE TABLE `t_titres` (
  `id_titre` int(3) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `accroche` tinytext NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateurs`
--

CREATE TABLE `t_utilisateurs` (
  `id_utilisateur` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('M','Mme') NOT NULL,
  `ville` varchar(50) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `adresse` text NOT NULL,
  `tel` varchar(20) NOT NULL,
  `age` smallint(3) NOT NULL,
  `anniversaire` date NOT NULL,
  `genre` enum('F','H') NOT NULL,
  `pays` varchar(30) NOT NULL,
  `commentaire` text NOT NULL,
  `statut` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateurs`
--

INSERT INTO `t_utilisateurs` (`id_utilisateur`, `pseudo`, `mdp`, `prenom`, `nom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `tel`, `age`, `anniversaire`, `genre`, `pays`, `commentaire`, `statut`) VALUES
(1, 'Setti', '790910', 'Setti', 'Belkacem', 'settibelkacem313@gmail.com', 'Mme', 'Les Lilas', '93260', '96 Rue Romain Rolland', '', 39, '1979-03-30', 'F', 'france', 'Pas de commentaire', 1),
(2, 'mouh', 'mouh', 'mohammed', 'Yessad', 'mouh@gmail.com', 'M', 'Pré Saint Gervais', '93310', 'fuisdhgtiuqioszg', '0652369841', 33, '0000-00-00', 'H', 'France', 'hjerhgiehzrgioju&#039;omouha', 0),
(3, 'amin', 'Amine790910', 'amine', 'ouldkadi', 'ok.amino@gmail.com', 'M', 'paris', '75019', 'place des fêtes', '0756321489', 45, '0000-00-00', 'H', 'france', 'un ami pas comme les autres', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_competences`
--
ALTER TABLE `t_competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  ADD PRIMARY KEY (`id_loisir`);

--
-- Index pour la table `t_messages`
--
ALTER TABLE `t_messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- Index pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  ADD PRIMARY KEY (`id_reseau`);

--
-- Index pour la table `t_titres`
--
ALTER TABLE `t_titres`
  ADD PRIMARY KEY (`id_titre`);

--
-- Index pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_competences`
--
ALTER TABLE `t_competences`
  MODIFY `id_competence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  MODIFY `id_experience` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `id_formation` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  MODIFY `id_loisir` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `t_messages`
--
ALTER TABLE `t_messages`
  MODIFY `id_message` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  MODIFY `id_realisation` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  MODIFY `id_reseau` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_titres`
--
ALTER TABLE `t_titres`
  MODIFY `id_titre` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  MODIFY `id_utilisateur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
