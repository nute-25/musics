-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 03 avr. 2019 à 20:05
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `musics`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `cover` varchar(50) DEFAULT NULL,
  `style` varchar(100) DEFAULT NULL,
  `spotify` varchar(300) DEFAULT NULL,
  `releaseyear` smallint(6) DEFAULT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `created`, `modified`, `title`, `cover`, `style`, `spotify`, `releaseyear`, `artist_id`) VALUES
(4, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Brainwashed', NULL, 'Rock, pop rock, rock \'n\' roll, blues, musiques du monde', 'https://open.spotify.com/album/2VFLjY1S0D8nKml6nlU2MD', 2002, 3),
(5, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Live In Japan', NULL, 'Rock, pop rock, rock \'n\' roll, blues, musiques du monde', 'https://open.spotify.com/album/4S2ZR5njbJez1rV8DV5Vtl', 1992, 3),
(6, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Thirty Three &1/3', NULL, 'Rock, pop rock, rock \'n\' roll, blues, musiques du monde', 'https://open.spotify.com/album/7y9Fefugnr5b8fHHt9eE7X', 1976, 3),
(7, '2019-03-28 09:48:14', '2019-03-28 09:48:14', 'Yellow Submarine Songtrack', 'a-2305-1553766494.jpeg', 'Pop, rock', 'https://open.spotify.com/album/0XRZpF083HqgygM0v1hQyE', 2014, 4),
(8, '2019-03-28 10:00:12', '2019-03-28 12:47:49', 'Let it be...Naked', 'a-1196-1553767212.jpeg', 'Pop, rock', 'https://open.spotify.com/album/4KYcffwC5HgjJLdpQU9SjC', 2014, 4),
(10, '2019-03-28 13:29:13', '2019-03-28 13:30:19', 'Brol', 'a-674-1553779819.jpeg', 'Pop', 'https://open.spotify.com/album/6KSvWFf4g4PrIldtchJsTC', 2018, 2),
(11, '2019-04-03 17:30:36', '2019-04-03 17:30:36', 'The Resistance', 'a-1750-1554312636.jpeg', 'Alternative rock, progressive rock, hard rock, art rock, space rock, electronica', 'https://open.spotify.com/album/0eFHYz8NmK75zSplL5qlfM', 2009, 7);

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `pseudonym` varchar(100) NOT NULL,
  `debut` smallint(6) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `spotify` varchar(300) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `created`, `modified`, `pseudonym`, `debut`, `country`, `spotify`, `picture`) VALUES
(2, '2019-03-22 00:00:00', '2019-03-28 13:30:42', 'Angèle', 2015, 'Belgique', 'https://open.spotify.com/artist/3QVolfxko2UyCOtexhVTli', 'a-2446-1553779842.jpeg'),
(3, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'George Harrison', 1958, 'Royaume-Uni', 'https://open.spotify.com/artist/7FIoB5PHdrMZVC3q2HE5MS', NULL),
(4, '2019-03-28 08:38:15', '2019-03-28 13:24:56', 'The Beatles', 1960, 'Royaume-Unis', 'https://open.spotify.com/artist/3WrFJ7ztbogyGnTHbHJFl2', 'a-2505-1553779496.jpeg'),
(6, '2019-03-31 21:39:03', '2019-03-31 21:39:03', 'Jessie Reyez', 2014, 'Canada', 'https://open.spotify.com/artist/3KedxarmBCyFBevnqQHy3P', 'a-1674-1554068343.jpeg'),
(7, '2019-04-03 17:28:05', '2019-04-03 17:28:05', 'Muse', 1994, 'Angleterre', 'https://open.spotify.com/artist/12Chz98pHFMPJEknJQMWvI', 'a-1557-1554312485.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `created`, `modified`, `user_id`, `artist_id`) VALUES
(1, '2019-03-29 09:05:24', '2019-03-29 09:05:24', 1, 3),
(7, '2019-03-29 11:03:24', '2019-03-29 11:03:24', 1, 2),
(8, '2019-04-03 19:13:30', '2019-04-03 19:13:30', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `artistname` varchar(100) DEFAULT NULL,
  `albumtitle` varchar(100) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `requests`
--

INSERT INTO `requests` (`id`, `created`, `modified`, `user_id`, `artistname`, `albumtitle`, `status`) VALUES
(1, '2019-03-31 18:52:40', '2019-03-31 21:33:51', 1, 'Jessie Reyez', '', 'accept'),
(2, '2019-03-31 21:41:05', '2019-03-31 21:47:38', 1, 'Angèle', 'Brol', 'accept'),
(3, '2019-03-31 21:42:38', '2019-03-31 21:43:03', 1, 'George Harrison', 'Live In Japan', 'accept'),
(4, '2019-03-31 21:48:05', '2019-03-31 21:48:42', 1, '', '', 'decline'),
(5, '2019-03-31 21:48:27', '2019-03-31 21:48:44', 1, 'Bidule', '', 'decline'),
(6, '2019-04-03 19:22:25', '2019-04-03 19:34:08', 3, 'Truc', '', 'decline');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `created`, `modified`, `pseudo`, `password`, `status`) VALUES
(1, '2019-03-28 14:25:13', '2019-03-28 14:25:13', 'Nolwenn', '$2y$10$Ehks2rsyZ06mzMBn.Gscfel7T8eOMz.mBNpGDtFo1L1n/r270vd2m', 'user'),
(2, '2019-03-28 15:36:19', '2019-03-28 15:36:19', 'admin', '$2y$10$NFJVLg4GY6EjecGrmIQcHOlts9WMCToRxfMA3w2Kcuu.HIYyvQWea', 'admin'),
(3, '2019-04-03 19:21:05', '2019-04-03 19:21:05', 'Nicolas', '$2y$10$X6vqxL1bIzCAaiD0zlKMau.U4CZNpcpamPLnol3CI.xwxM6L0zctC', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
