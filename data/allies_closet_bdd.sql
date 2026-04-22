-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 22 avr. 2026 à 06:49
-- Version du serveur : 11.4.10-MariaDB
-- Version de PHP : 8.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `allies_closet`
--

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE`
--

CREATE TABLE `ARTICLE` (
  `id_article` int(11) NOT NULL,
  `article_image` varchar(200) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `date_of_creation` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_of_alteration` date DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'mode'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `COMMENTARY`
--

CREATE TABLE `COMMENTARY` (
  `id_comment` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(5000) NOT NULL,
  `date_of_sending` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `LIKE_`
--

CREATE TABLE `LIKE_` (
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `LIKING`
--

CREATE TABLE `LIKING` (
  `id_user` int(11) NOT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `id_message` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` varchar(5000) NOT NULL,
  `date_of_creation` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reply` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `SAVE_AS_FAVORITE`
--

CREATE TABLE `SAVE_AS_FAVORITE` (
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `USER_`
--

CREATE TABLE `USER_` (
  `id_user` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `profile_description` varchar(100) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `COMMENTARY`
--
ALTER TABLE `COMMENTARY`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `LIKE_`
--
ALTER TABLE `LIKE_`
  ADD PRIMARY KEY (`id_user`,`id_article`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `LIKING`
--
ALTER TABLE `LIKING`
  ADD PRIMARY KEY (`id_user`,`id_message`),
  ADD KEY `id_message` (`id_message`);

--
-- Index pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `SAVE_AS_FAVORITE`
--
ALTER TABLE `SAVE_AS_FAVORITE`
  ADD PRIMARY KEY (`id_user`,`id_article`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `USER_`
--
ALTER TABLE `USER_`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `COMMENTARY`
--
ALTER TABLE `COMMENTARY`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `USER_`
--
ALTER TABLE `USER_`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD CONSTRAINT `ARTICLE_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`);

--
-- Contraintes pour la table `COMMENTARY`
--
ALTER TABLE `COMMENTARY`
  ADD CONSTRAINT `COMMENTARY_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`),
  ADD CONSTRAINT `COMMENTARY_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`);

--
-- Contraintes pour la table `LIKE_`
--
ALTER TABLE `LIKE_`
  ADD CONSTRAINT `LIKE__ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`),
  ADD CONSTRAINT `LIKE__ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`);

--
-- Contraintes pour la table `LIKING`
--
ALTER TABLE `LIKING`
  ADD CONSTRAINT `LIKING_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`),
  ADD CONSTRAINT `LIKING_ibfk_2` FOREIGN KEY (`id_message`) REFERENCES `MESSAGE` (`id_message`);

--
-- Contraintes pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `MESSAGE_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`);

--
-- Contraintes pour la table `SAVE_AS_FAVORITE`
--
ALTER TABLE `SAVE_AS_FAVORITE`
  ADD CONSTRAINT `SAVE_AS_FAVORITE_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`),
  ADD CONSTRAINT `SAVE_AS_FAVORITE_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `ARTICLE` (`id_article`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
