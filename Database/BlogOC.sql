-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 27 juin 2022 à 15:14
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
-- Base de données : `BlogOC`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `chapo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `image`, `content`, `author`, `date`, `chapo`) VALUES
(59, 'Nouveaut&eacute; PHP 8', '46994PHP-8.webp', 'Cette nouvelle mise &agrave; jour majeure apporte tout un tas d&rsquo;optimisations et de puissantes fonctionnalit&eacute;s au langage.\r\nPHP 8 introduit deux moteurs de compilation JIT (juste &agrave; temps/compilation &agrave; la vol&eacute;e). Le Tracing JIT, le plus prometteur des deux, montre environ 3 fois plus de performances sur des benchmarks synth&eacute;tiques et 1,5-2 fois plus de performances sur certaines applications &agrave; longue dur&eacute;e d\'ex&eacute;cution.', 12, '2022-06-22 07:31:11', 'PHP 8 a &eacute;t&eacute; officiellement mis &agrave; la disposition du public le 26 novembre 2021 !'),
(60, 'La France dans le top 10 des meilleurs d&eacute;veloppeurs', '29809neuf-php8-fr.jpg', 'La France, 8e, distance les &Eacute;tats-Unis.\r\n\r\nCertes, les &Eacute;tats-Unis et l&rsquo;Inde abritent le plus grand nombre de d&eacute;veloppeurs inscrits sur HackerRank. Mais ce sont deux autres puissances &eacute;conomiques et d&eacute;mographiques, la Chine et la Russie, qui comptent les plus dou&eacute;s d&rsquo;entre eux. La France, de son c&ocirc;t&eacute;, figure dans le top 10 des meilleurs d&eacute;veloppeurs. C&rsquo;est ce qui ressort d&rsquo;une &eacute;tude d&eacute;voil&eacute;e par HackerRank. La plateforme propose des d&eacute;fis et des tests &agrave; plus de 1 million de d&eacute;veloppeurs dans le monde.', 12, '2022-06-22 10:53:22', 'Selon la plateforme de d&eacute;fis de programmation HackerRank, la Chine et la Russie comptent le plus grand nombre de d&eacute;veloppeurs dou&eacute;s. '),
(61, 'Qui est Grafikart ?', '76326shutterstock_331439570-684x513.jpg', ' Sur son temps libre, il anime le site internet grafikart.fr sur lequel il pr&eacute;sente un nombre impressionnant de formations. Il propose l&rsquo;acc&egrave;s &agrave; du contenu exclusif via un abonnement mensuel payant mais vous aurez d&eacute;j&agrave; fort &agrave; faire avec tout le contenu gratuit.\r\n\r\nSes formations portent sur :\r\n\r\n    Des langages de programmation : php, javascript, html, css, ruby, &hellip;\r\n    Des frameworks : Laravel, Symfony, Vuejs&hellip;\r\n    Des outils tels que git, wordpress, docker, &hellip;\r\n\r\nSur sa cha&icirc;ne Youtube, les limitations de la plateforme font qu&rsquo;elles sont pr&eacute;sent&eacute;es sous forme de playlists o&ugrave; il peut &ecirc;tre parfois compliqu&eacute; de savoir par o&ugrave; commencer quand on d&eacute;marre de z&eacute;ro. Mais sur son site internet, elles sont toutes organis&eacute;es en cursus. Il a litt&eacute;ralement cr&eacute;&eacute; un organigramme pour vous permettre de vous y retrouver et identifier quelle formation suivre pour d&eacute;marrer votre projet.', 12, '2022-06-22 10:59:17', 'Grafikart, de son vrai nom Jonathan Boyer est un d&eacute;veloppeur free lance full stack.'),
(62, 'Microsoft Build 2022 : les  annonces &agrave; retenir', '11521thumbnail_Microsoft-Build-684x513.jpg', 'Et les innovations ne manquent pas cette ann&eacute;e, avec des nouveaut&eacute;s touchant aux produits et solutions Windows, Azure, Power Platform ou encore Microsoft 365.\r\nMicrosoft rend Teams plus fun et facile &agrave; coder\r\n\r\nMicrosoft Teams a eu droit &agrave; son lot de nouveaut&eacute;s, et l&rsquo;une d&rsquo;entre elles pourrait particuli&egrave;rement retenir votre attention. La plateforme collaborative, qui compte plus de 270 millions d&rsquo;utilisateurs actifs mensuels et a su s&eacute;duire le grand public, accueille notamment Live Share.\r\n\r\nCe nouvel outil permettra aux participants d&rsquo;une r&eacute;union Teams d&rsquo;interagir (en annotant, modifiant, zoomant sur un contenu etc.) avec quelque 1 400 applications partag&eacute;es, d&eacute;passant ainsi le partage d&rsquo;&eacute;cran passif pour rendre les r&eacute;unions plus immersives, engageantes et participatives.\r\n\r\nLes d&eacute;veloppeurs ne sont pas en reste puisqu&rsquo;ils pourront utiliser de nouvelles extensions de pr&eacute;visualisation du SDK Teams, afin d&rsquo;&eacute;tendre les applications Teams existantes et de cr&eacute;er de nouvelles exp&eacute;riences de partage en direct dans les r&eacute;unions.\r\n\r\nLive Share reposera sur la puissance de la collection de biblioth&egrave;ques JavaScript open source Fluid Framework, qui soutient les capacit&eacute;s de collaboration en temps r&eacute;el de Live Share.', 12, '2022-06-22 10:59:59', 'Comme chaque ann&eacute;e, la conf&eacute;rence Build permet &agrave; de Microsoft de pr&eacute;senter &agrave; sa communaut&eacute; de d&eacute;veloppeurs ses nouveaux outils, projets et mises &agrave; jour. '),
(99, 'PHP 8 a &eacute;t&eacute; officiellement mis &agrave; la disposition du public le 26 novembre 2020 !', '', 'PHP 8 a &eacute;t&eacute; officiellement mis &agrave; la disposition du public le 26 novembre 2020 !', 12, '2022-06-19 14:05:08', 'PHP 8 a &eacute;t&eacute; officiellement mis &agrave; la disposition du public le 26 novembre 2020 !'),
(125, 'tester2', '', 'dfhfgfgjdjghghjkhjkhjk', 12, '2027-06-22 09:29:19', 'dfhsdfhdfh');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `date_commentaire` timestamp NOT NULL DEFAULT current_timestamp(),
  `commentaire` varchar(500) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `checked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_article`, `date_commentaire`, `commentaire`, `author`, `checked`) VALUES
(60, 59, '2022-06-22 17:07:11', 'j\'aime le php\r\n', 14, 1),
(65, 59, '2022-06-24 09:20:04', 'Moi aussi mais surtout avec Symfony !', 27, 1),
(66, 59, '2022-06-26 09:24:31', 'Moi je l\'aime mais avec Symfony\r\n', 14, 0),
(67, 62, '2022-06-27 11:47:49', 'Microsoft va de l\'avant!', 31, 1);

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
(5, 13),
(23, 15),
(30, 14),
(67, 14),
(76, 12),
(77, 12),
(78, 12),
(81, 12),
(82, 12),
(84, 12);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `admin`) VALUES
(12, 'admin@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$eU1JYWhtb0N6WDBVV3YvYw$zb0mvzWjrBMvnc0/nYV2p5x0M/GGH314CZ5wlLF45DY', 'admin', 'admin', 1),
(14, 'toto@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$djFTZmdqMUJjYTkuOWJTZQ$/mobApLvkH8WZpjwstmXageCpjmxZD/EotPfsHPZrT0', 'toto', 'toto', 0),
(15, 'lili@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$dmp2eTFFbjJLWk9uOHRNTg$KhlhXKncLiJNeeI6Iy5mfPB3227a77IIfCTsjbFaI9k', 'lili', 'lili', 0),
(16, 'lolo@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$OU1sSm1iRzZwQ0hVcVhVSw$+/a9hKXY4Wlq9+171JzDJ2M6MzCYqEA5R5F7n3W0ElA', 'lolo', 'lolo', 0),
(21, 'gigi@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$dGJVLldwU2RZWlV0R002Lw$d6DD6pWstsLwHZ4zOi53P6VUq+X7moTyryUNKlh6taY', 'ghis', 'gigi', 0),
(22, 'dada@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$c1ZKQWVSZkhnd2NhNzQxMA$wxpaQRA/ozb6XuvCg0AcmqAc0tLidcvJ16vLH8pBj+E', 'dada', 'dada', 0),
(23, 'pou@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$Tm12LkJWLmpPd05kZzVUdQ$EbB4QBEufqbk5nMHpvf3lyGoqToVJyx5xBiFt/E8p0A', 'poiu', 'pou', 0),
(24, 'louis@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$NHZWNGhxUjdNdUtYT20zeQ$K0gi2+Bag81CBoobyZkTOYtUfOcIEmx7QoC9gtwBt50', 'louis', 'lois', 0),
(25, 'mimi@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$ejBnMlhQYUZ6dDV0RDkxdQ$aR80thNg5s+ZLjbEOJJAgitQKbr4RBPm4DGNRLdz/pM', 'mimim', 'mimi', 0),
(27, 'david@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$eHVyZ2hTZGJMT3haL0VNeA$w0JpC6GZwX3kdmg+0xQDOwydn855Gsbki/Ue877tTYE', 'david', 'conrad', 0),
(28, 'marco@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$aWYuQ3lILjNSZk5ySlJDbg$ht47tGdlrfo7xWDgVWMxoUFVb2zmKzodKpwcK3FFuT8', 'marco', 'becker', 0),
(29, 'pan@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$MUNwSUZRaWtNNTlVT0JyUg$XABcy/ZIFiriceE9LBLAzAmv3ICUtrfpMhxoNBevHb4', 'pan', 'pan', 0),
(30, 'coco@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$cHZBU0QyRmZGLmoxSGl0eQ$1Q63gc4iIZLnLgyjzoS2mGMpTA2az4TgBRPdlYtFr3A', 'coco', 'coco', 0),
(31, 'jean@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$Q3BHaWZSMm1XZzFBQjllRQ$T+x5ElQgSPp43768wQR6io86sEsusRcQXqKzurhvjuY', 'jean', 'didier', 0),
(32, 'bibi@free.fr', '$argon2i$v=19$m=65536,t=4,p=1$bWVNTnVPMlVtc3ZVUi42cA$5If3itXY9pEqDzk5Tu0hRv6jpR9ZPa49/8MA2K9oKvg', 'bibi', 'bibi', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `author` (`author`),
  ADD KEY `sup-article` (`id_article`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `auteur` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `aut` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sup-article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
