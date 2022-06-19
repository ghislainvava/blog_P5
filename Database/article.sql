-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 19 juin 2022 à 15:10
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
(59, 'Nouveaut&eacute; PHP 8', '46994PHP-8.webp', 'Cette nouvelle mise &agrave; jour majeure apporte tout un tas d&rsquo;optimisations et de puissantes fonctionnalit&eacute;s au langage.\r\nPHP 8 introduit deux moteurs de compilation JIT (juste &agrave; temps/compilation &agrave; la vol&eacute;e). Le Tracing JIT, le plus prometteur des deux, montre environ 3 fois plus de performances sur des benchmarks synth&eacute;tiques et 1,5-2 fois plus de performances sur certaines applications &agrave; longue dur&eacute;e d\'ex&eacute;cution.', 12, '2009-06-22 10:52:32', 'PHP 8 a &eacute;t&eacute; officiellement mis &agrave; la disposition du public le 26 novembre 2020 !'),
(60, 'La France dans le top 10 des meilleurs d&eacute;veloppeurs', '29809neuf-php8-fr.jpg', 'La France, 8e, distance les &Eacute;tats-Unis.\r\n\r\nCertes, les &Eacute;tats-Unis et l&rsquo;Inde abritent le plus grand nombre de d&eacute;veloppeurs inscrits sur HackerRank. Mais ce sont deux autres puissances &eacute;conomiques et d&eacute;mographiques, la Chine et la Russie, qui comptent les plus dou&eacute;s d&rsquo;entre eux. La France, de son c&ocirc;t&eacute;, figure dans le top 10 des meilleurs d&eacute;veloppeurs. C&rsquo;est ce qui ressort d&rsquo;une &eacute;tude d&eacute;voil&eacute;e par HackerRank. La plateforme propose des d&eacute;fis et des tests &agrave; plus de 1 million de d&eacute;veloppeurs dans le monde.', 12, '2009-06-22 10:53:22', 'Selon la plateforme de d&eacute;fis de programmation HackerRank, la Chine et la Russie comptent le plus grand nombre de d&eacute;veloppeurs dou&eacute;s. '),
(61, 'Qui est Grafikart ?', '76326shutterstock_331439570-684x513.jpg', ' Sur son temps libre, il anime le site internet grafikart.fr sur lequel il pr&eacute;sente un nombre impressionnant de formations. Il propose l&rsquo;acc&egrave;s &agrave; du contenu exclusif via un abonnement mensuel payant mais vous aurez d&eacute;j&agrave; fort &agrave; faire avec tout le contenu gratuit.\r\n\r\nSes formations portent sur :\r\n\r\n    Des langages de programmation : php, javascript, html, css, ruby, &hellip;\r\n    Des frameworks : Laravel, Symfony, Vuejs&hellip;\r\n    Des outils tels que git, wordpress, docker, &hellip;\r\n\r\nSur sa cha&icirc;ne Youtube, les limitations de la plateforme font qu&rsquo;elles sont pr&eacute;sent&eacute;es sous forme de playlists o&ugrave; il peut &ecirc;tre parfois compliqu&eacute; de savoir par o&ugrave; commencer quand on d&eacute;marre de z&eacute;ro. Mais sur son site internet, elles sont toutes organis&eacute;es en cursus. Il a litt&eacute;ralement cr&eacute;&eacute; un organigramme pour vous permettre de vous y retrouver et identifier quelle formation suivre pour d&eacute;marrer votre projet.', 12, '2009-06-22 10:59:17', 'Grafikart, de son vrai nom Jonathan Boyer est un d&eacute;veloppeur free lance full stack.'),
(62, 'Microsoft Build 2022 : les  annonces &agrave; retenir', '11521thumbnail_Microsoft-Build-684x513.jpg', 'Et les innovations ne manquent pas cette ann&eacute;e, avec des nouveaut&eacute;s touchant aux produits et solutions Windows, Azure, Power Platform ou encore Microsoft 365.\r\nMicrosoft rend Teams plus fun et facile &agrave; coder\r\n\r\nMicrosoft Teams a eu droit &agrave; son lot de nouveaut&eacute;s, et l&rsquo;une d&rsquo;entre elles pourrait particuli&egrave;rement retenir votre attention. La plateforme collaborative, qui compte plus de 270 millions d&rsquo;utilisateurs actifs mensuels et a su s&eacute;duire le grand public, accueille notamment Live Share.\r\n\r\nCe nouvel outil permettra aux participants d&rsquo;une r&eacute;union Teams d&rsquo;interagir (en annotant, modifiant, zoomant sur un contenu etc.) avec quelque 1 400 applications partag&eacute;es, d&eacute;passant ainsi le partage d&rsquo;&eacute;cran passif pour rendre les r&eacute;unions plus immersives, engageantes et participatives.\r\n\r\nLes d&eacute;veloppeurs ne sont pas en reste puisqu&rsquo;ils pourront utiliser de nouvelles extensions de pr&eacute;visualisation du SDK Teams, afin d&rsquo;&eacute;tendre les applications Teams existantes et de cr&eacute;er de nouvelles exp&eacute;riences de partage en direct dans les r&eacute;unions.\r\n\r\nLive Share reposera sur la puissance de la collection de biblioth&egrave;ques JavaScript open source Fluid Framework, qui soutient les capacit&eacute;s de collaboration en temps r&eacute;el de Live Share.', 12, '2009-06-22 10:59:59', 'Comme chaque ann&eacute;e, la conf&eacute;rence Build permet &agrave; de Microsoft de pr&eacute;senter &agrave; sa communaut&eacute; de d&eacute;veloppeurs ses nouveaux outils, projets et mises &agrave; jour. '),
(66, 'dqsdklnlknqdgs', '481964Capture d’écran 2022-06-07 à 17.40.39.png', 'sdjmsdjopgojpqdfgjopgdfqjpjp o', 22, '2022-06-13 17:59:24', 'sdfjojosdfjosqdjo'),
(90, 'fhsgfgsghjhjg', '481964Capture d’écran 2022-06-07 à 17.40.39.png', 'fsghfgjhghjghdjghhjkjklkjlmklmklmklmlm&ugrave;lmk&ugrave;klm', 12, '2022-06-17 12:50:51', 'gfhfshgfghs'),
(96, 'encore un ', '3051621Cantons de l\'est Estrie.png', 'dsqdffgjghjhjkhjghjghjghjghjghjgjhhgjkhjljklyrddrfghghjghjgjhgjhjgh', 14, '2022-06-17 14:51:10', 'sdsdgdfgfd');

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
