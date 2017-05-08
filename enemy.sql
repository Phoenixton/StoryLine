-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Mai 2017 à 15:44
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
-- Structure de la table `enemy`
--

CREATE TABLE `enemy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `life` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `enemy`
--

INSERT INTO `enemy` (`id`, `name`, `description`, `attack`, `defense`, `life`) VALUES
(4, 'Worm', 'Whar are you doing here, little one ?', 2, 1, 2),
(5, 'Chicken', 'It\'s...A chicken ?', 2, 1, 4),
(6, 'Nekker', 'A horrendous looking creature, not too frightening though.', 5, 4, 10),
(7, 'Gobelin', 'It\'s small and it\'s trying to kill you. ', 5, 2, 14),
(8, 'Harpies', 'A flying monster, be careful.', 7, 5, 15),
(9, 'Ghoul', 'Dead corpses excite this one too much.', 9, 10, 15),
(10, 'Griffin', 'A griffin is... Wait, who cares ? Kill it.', 10, 9, 20),
(11, 'Minotaur', 'It used to watch over a maze. Now it\'s here, because mazes are so not cool, these days.', 13, 12, 40),
(12, 'Gorgon', 'You should google what this is. It\'s not especially good looking. Just saying.', 14, 14, 50),
(13, 'Ogre', 'IT\'S BIG ! UNE MASSUE ! ', 17, 15, 50),
(14, 'Werewolf', 'A poor used-to-be-human creature. The best thing left to do for it is to die. Be careful, though. It won\'t go down so easily...', 20, 14, 60),
(15, 'Vampire', 'Werewolves are no longer human. But vampires... They retain this humanity which makes them so much more dangerous...', 23, 17, 45),
(16, 'Sphinx', 'You see, there was a time when a Sphinx would ask you a question before devouring you. Now... Nah, you won\'t even get that. ', 23, 18, 80),
(17, 'Leviathan', 'No, not the pokemon. You\'re still dead, though.', 26, 20, 100),
(18, 'Dragon', 'THE BOOOOOOOOOOOOOOOOOOOOOOOSS !', 35, 25, 150);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `enemy`
--
ALTER TABLE `enemy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `enemy`
--
ALTER TABLE `enemy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
