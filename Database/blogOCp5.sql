-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 03 mai 2022 à 11:44
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blogOCp5`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `image`, `content`, `author`) VALUES
(46, 'il ne fait pas beau', '', 'mais j\'ai tout de m&ecirc;me le moral !', 13),
(51, 'je teste ici', '', 'dqsgjogpdo sou&ugrave;qsdou&ugrave;o&ugrave; u pou&ugrave;qdsgo qdgoou &ugrave;', 13),
(81, 'nouvel article', '', 'je suis en forme aujourd\'hui', 13),
(82, 'sddfg', '', 'dfhsdhsfo&ugrave;jjkopjop poj pp &agrave;p``p&agrave; `p`p jp ', 13),
(83, 'il jkljkljl jl', '', 'mais j\'ai tout de m&ecirc;me le moral !', 13),
(84, 'sdgds', '', 'sdfhhjfghk jdgjg dghk kgdd k dg', 13),
(85, 'dfgdsh', '', 'sfghgfs  ^` sdfhpj`j `h`jsp`jp sf', 13),
(86, 'dsgdfh', 'chalets.png', 'dfhgfjghj sfh iojhoi iohyyio y yy!&ugrave; gqy&ugrave;!y !o&ugrave;', 13),
(87, 'qsgdg', '512Logo.png', 'dqfhildqhi hio &ugrave;o hihio&ugrave;&ugrave;o ih h&ugrave;&ugrave; h', 13);

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `userid`) VALUES
(2, 13),
(7, 13),
(12, 13),
(13, 13),
(15, 13),
(16, 13);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES
(13, 'nono@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$Mnl3YUluaTk4VXMvZTB6Wg$iVeops4mHDaR/ry/orbxuMcc5aLZW+yXu8whqu7hnTQ', 'nonoon', 'nono'),
(14, 'titi@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$c1V4MnV4ZS8yNVYuSGsuYg$77Eab+aJiISh+O2FAAG6rllMnBhk+fWXqjVxaZ2k6To', 'titi', 'titi'),
(15, 'papa@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$YldPeUs1QkxDSko3R3g3UA$p/4ouEX6UyR28eLLAz682s1FnuWb9epfRR8fP2mx/jQ', 'dgsqgds', 'sdfgqd'),
(16, 'popo@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$QW1EUmxmREZURER0Wkh5NQ$dPoMJrIyR6qsXq8ZL/YW9U1lcYKu3AxMymLx/WwnoSE', 'popo', 'popo'),
(17, 'momo@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$VG5TRWFNNkh2WTBUdTRFTQ$6BqLrgEnhzpl5+QKRn9SR3BVuVLuj1TnbQeCLV/fZ48', 'momo', 'momo'),
(18, 'lili@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$b2VMQlNFSmplY0VVSS5xMw$Wy6udzLbaTLFAqwVSqpXvTo2UIdH0cN1bKi/OBDVQNw', 'lili', 'lili'),
(19, 'dada@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$T29QUUswaWpwZ1ZKd25VQg$GjoW4BTooUu6sgRpgsjGU6tIakJ9ZFKp23UQBwPTkrE', 'dada', 'dada'),
(20, 'mama@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$NkNwbFdJeGtjcVZ1YzU4MA$IaZRTwDikO2BHC1CEyjYPm1UulkdLXTaCU5mgweOYFE', 'cvnw', 'cvb'),
(21, 'nana@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$RmVCWC5HQW9TdUt0NVJvSw$G6b2xO4asIa/91bx9k3XO2LI81suqzLuVLMRrdGkg5A', 'qdfqdfgqdfh', 'dfgqdfg'),
(22, 'zaza@email.fr', '$argon2i$v=19$m=65536,t=4,p=1$TFNxYkFMeUZYdXJJODh5Mg$Nro097UfECwUOhWJ2Wic8j8oqZBmngSjqHQOgY2tp9U', 'zaza', 'zaza'),
(23, 'azaz@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$QUR3QmtCZFkvbHN6VFZDVA$J/FEfGfVg0fRi9XOHU/uREiyyunXrl6+J1Y0tqIB7Z0', 'qsf', 'sqf'),
(24, 'vuvu@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$b2QzRE1PS2RrQzU1ekpYdw$jg3P/n2NgEzuDFiTr09xIc8Dc0EceasoYmBQJQKRmcA', 'vuvu', 'vuvu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_user_idx` (`author`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
