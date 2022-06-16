-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 16 juin 2022 à 13:42
-- Version du serveur : 10.3.31-MariaDB-0+deb10u1
-- Version de PHP : 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `debut1689100`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `id` int(10) NOT NULL,
  `id_client` int(10) NOT NULL,
  `type_sport` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `payer` decimal(10,0) NOT NULL,
  `reste` decimal(10,0) NOT NULL,
  `date_abonnement` datetime DEFAULT NULL,
  `date_renew` date DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `lastPayement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `id_client`, `type_sport`, `total`, `payer`, `reste`, `date_abonnement`, `date_renew`, `date_debut`, `date_fin`, `status`, `lastPayement`) VALUES
(322, 246, 'BOX', '160', '100', '60', '2022-06-06 17:17:31', NULL, '2022-06-06', '2022-07-06', 1, '2022-06-06');

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE `activity` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `activity`
--

INSERT INTO `activity` (`id`, `name`, `prix`) VALUES
(214, 'BOX', '60'),
(215, 'MUSCULATION', '100'),
(216, 'BREAKDANCE', '200');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `badge` varchar(20) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `cin` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) NOT NULL DEFAULT 'najib'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `badge`, `firstName`, `lastName`, `birth`, `genre`, `cin`, `tel`, `adresse`, `date`, `photo`, `create_by`) VALUES
(246, '102030', 'flata', 'najib', '1982-11-09', 'Homme', 'ee102030', '0674176588', '106 impasse de la cerisaie', '2022-06-06', '246.jpg', 'najib flata');

-- --------------------------------------------------------

--
-- Structure de la table `controlle`
--

CREATE TABLE `controlle` (
  `id` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_abonnement` int(10) DEFAULT NULL,
  `id_user` varchar(255) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `controlle`
--

INSERT INTO `controlle` (`id`, `date`, `id_abonnement`, `id_user`) VALUES
(252, '2022-06-05 17:19:55', NULL, '2'),
(253, '2022-06-05 17:19:57', NULL, '2'),
(254, '2022-06-05 17:20:12', NULL, '2'),
(255, '2022-06-05 17:20:30', NULL, '2'),
(256, '2022-06-05 17:20:42', NULL, '2'),
(257, '2022-06-05 17:21:04', NULL, '2'),
(258, '2022-06-05 17:27:48', NULL, '2'),
(259, '2022-06-05 17:29:20', NULL, '2'),
(260, '2022-06-05 17:30:48', NULL, '2'),
(261, '2022-06-05 17:34:28', NULL, '2'),
(262, '2022-06-05 17:37:46', NULL, '2'),
(263, '2022-06-05 17:37:55', NULL, '2'),
(264, '2022-06-05 17:38:57', NULL, '2'),
(265, '2022-06-05 18:05:46', NULL, '2'),
(266, '2022-06-05 18:06:36', NULL, '2'),
(267, '2022-06-05 18:06:41', NULL, '2'),
(268, '2022-06-05 18:11:24', NULL, '2'),
(269, '2022-06-05 18:13:33', NULL, '2'),
(270, '2022-06-05 18:18:21', NULL, '2'),
(271, '2022-06-05 18:18:25', NULL, '2'),
(272, '2022-06-05 18:18:46', NULL, '2'),
(273, '2022-06-05 18:18:51', NULL, '2'),
(274, '2022-06-05 18:20:58', NULL, '2'),
(275, '2022-06-05 18:21:03', NULL, '2'),
(276, '2022-06-05 18:21:53', NULL, '2'),
(277, '2022-06-05 18:22:07', NULL, '2'),
(278, '2022-06-05 18:22:11', NULL, '2'),
(279, '2022-06-05 18:22:16', NULL, '2'),
(280, '2022-06-05 18:22:20', NULL, '2'),
(281, '2022-06-05 18:24:00', NULL, '2'),
(282, '2022-06-05 18:24:02', NULL, '2'),
(285, '2022-06-05 18:30:23', NULL, '2'),
(286, '2022-06-05 18:30:26', NULL, '2'),
(331, '2022-06-06 17:22:54', 322, 'najib flata');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Editeur'),
(3, 'Controlleur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date_inscription` date NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `id_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `date_inscription`, `pseudo`, `id_type`) VALUES
(2, 'najib flata', '123sat', '2022-05-28', 'super_admin', 1),
(26, 'yassine flata', '10203040', '2022-05-28', 'ssine_rock10', 2),
(27, 'chakib flata', '10203040', '2022-05-28', 'lilchak', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `controlle`
--
ALTER TABLE `controlle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_abonnement` (`id_abonnement`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT pour la table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT pour la table `controlle`
--
ALTER TABLE `controlle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `controlle`
--
ALTER TABLE `controlle`
  ADD CONSTRAINT `controlle_ibfk_1` FOREIGN KEY (`id_abonnement`) REFERENCES `abonnement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
