-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 28 Juillet 2016 à 16:39
-- Version du serveur :  10.0.25-MariaDB-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `common-database`
--

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id_follower` int(11) NOT NULL,
  `id_following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `follow`
--

INSERT INTO `follow` (`id_follower`, `id_following`) VALUES
(2, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_like` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `date_like`) VALUES
(1, 1, '2016-07-26 20:33:01');

-- --------------------------------------------------------

--
-- Structure de la table `private_messages`
--

CREATE TABLE `private_messages` (
  `content` varchar(140) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_send` int(11) NOT NULL,
  `id_user_receive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE `profiles` (
  `id_profile` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `color_hexa` char(6) NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `header_photo_url` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `profiles`
--

INSERT INTO `profiles` (`id_profile`, `name`, `color_hexa`, `avatar_url`, `header_photo_url`, `description`) VALUES
(1, 'Roteo21', '005aff', NULL, NULL, ''),
(2, 'SwagMaster', '000000', NULL, NULL, NULL),
(3, 'root', 'E5F2F7', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `retweets`
--

CREATE TABLE `retweets` (
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `id_retweet` int(11) DEFAULT NULL,
  `date_retweet` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `retweets`
--

INSERT INTO `retweets` (`id_user`, `id_tweet`, `id_retweet`, `date_retweet`) VALUES
(1, 13, NULL, '2016-07-22 09:55:59'),
(1, 2, NULL, '2016-07-27 20:31:14');

-- --------------------------------------------------------

--
-- Structure de la table `tweets`
--

CREATE TABLE `tweets` (
  `id_tweet` int(11) NOT NULL,
  `content` varchar(140) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tweets`
--

INSERT INTO `tweets` (`id_tweet`, `content`, `created`, `id_user`) VALUES
(1, '@Roteo21 Coucou', '2016-07-19 12:51:10', 1),
(2, '@SwagMaster Test', '2016-07-19 20:56:43', 2),
(15, '#test', '2016-07-25 11:23:41', 2),
(17, 'test', '2016-07-27 09:11:16', 2),
(18, '@Swag\r\n', '2016-07-28 12:23:33', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id_infos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `login`, `mail`, `password`, `admin`, `id_profile`, `id_infos`) VALUES
(1, 'Roteo21', 'robin.couet@epitech.eu', 'a92f4a404232d014e6f861a9bc47a062049b860a', 1, 1, 1),
(2, 'SwagMaster', 'paul.roos@epitech.eu', 'c29b8490eee6df0cf4ab069eeba42e87ed9b70c5', 0, 2, 2),
(3, 'root', 'nounours44120@hotmail.fr', 'c9e86182dd5190898cc0276034429fc08fb594cd', 0, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user_infos`
--

CREATE TABLE `user_infos` (
  `id_user` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `sex` enum('MALE','FEMALE','OTHER') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_infos`
--

INSERT INTO `user_infos` (`id_user`, `name`, `firstname`, `sex`, `birthdate`, `place`, `phone_number`) VALUES
(1, 'Robin', 'Couet', 'MALE', '1997-08-21', '46 rue de chateaudun', '0683238653'),
(2, 'Roos', 'Paul', 'OTHER', '2121-02-21', '1 rue pizza five', '0696969696'),
(3, 'Root', 'Root', 'OTHER', '1997-08-21', '2 Impasse De La Herpiniere', '0683238653');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD KEY `id_follower` (`id_follower`),
  ADD KEY `id_following` (`id_following`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_like` (`id_like`);

--
-- Index pour la table `private_messages`
--
ALTER TABLE `private_messages`
  ADD KEY `id_user_send` (`id_user_send`),
  ADD KEY `id_user_receive` (`id_user_receive`);

--
-- Index pour la table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_profile`);

--
-- Index pour la table `retweets`
--
ALTER TABLE `retweets`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_retweet` (`id_retweet`);

--
-- Index pour la table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id_tweet`),
  ADD UNIQUE KEY `id_tweet` (`id_tweet`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `id_profile` (`id_profile`),
  ADD KEY `id_infos` (`id_infos`);

--
-- Index pour la table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`id_follower`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`id_following`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `user_like_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_like_ibfk_2` FOREIGN KEY (`id_like`) REFERENCES `tweets` (`id_tweet`);

--
-- Contraintes pour la table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `private_message_ibfk_1` FOREIGN KEY (`id_user_send`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `private_message_ibfk_2` FOREIGN KEY (`id_user_receive`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `retweets`
--
ALTER TABLE `retweets`
  ADD CONSTRAINT `reteweet_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reteweet_ibfk_2` FOREIGN KEY (`id_retweet`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `id_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`id_profile`) REFERENCES `profiles` (`id_profile`),
  ADD CONSTRAINT `userinfos_ibfk_1` FOREIGN KEY (`id_infos`) REFERENCES `user_infos` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
