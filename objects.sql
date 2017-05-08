-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Mai 2017 à 15:42
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `storyline`
--

-- --------------------------------------------------------

--
-- Structure de la table `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attackbonus` int(11) NOT NULL,
  `lifebonus` int(11) NOT NULL,
  `defensebonus` int(11) NOT NULL,
  `isUsable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `objects`
--

INSERT INTO `objects` (`id`, `name`, `description`, `attackbonus`, `lifebonus`, `defensebonus`, `isUsable`) VALUES
(1, 'Life Potion', 'You\'ll need this, trust me... (+5 HP)', 0, 5, 0, 1),
(4, 'Defense Potion', 'Hop, your defense if going up ! (+1 Defense)', 0, 0, 1, 1),
(5, 'Attack Potion', 'Hop, your attackif going up ! (+1 Attack)', 1, 0, 0, 1),
(6, 'Socks', 'Who doesn\'t like a good pair of socks ?', 0, 1, 0, 1),
(7, 'Crown of thorns', 'Do you really want to put that on your head ?!', 1, -2, 1, 1),
(8, 'Armour of Beowulf', 'Badass, if I may say ! ', 1, 1, 4, 1),
(9, 'Shield of Ajax', 'He used to fight with it. He died with it, too. But heh, that was a long time ago. No worries.', 0, 2, 3, 1),
(10, 'Sword of Laban', 'I don\'t know what this is doing here. He must have lost it.', 4, 0, 0, 1),
(11, 'Beagalltach', 'A short sword given to Diarmuid Ua Duibhne by his father Aengus, if wikipedia is to be trusted. I just like the name.', 6, 2, 1, 1),
(12, 'Clarent', 'A sword of peace, whatever that means. Cause, well, you won\'t get much peace here...', 4, 4, 2, 1),
(13, 'Excalibur', 'Yes, it means you\'re the legitimate king of Britain. You better get out of here, though, first.', 9, 3, 4, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
