-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 22 mars 2019 à 16:13
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
(1, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Cure', NULL, 'Chanson française, rap', 'https://open.spotify.com/album/7ndyYB7UDPRSRCbb3AxHBZ', 2018, 1),
(4, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Brainwashed', NULL, 'Rock, pop rock, rock \'n\' roll, blues, musiques du monde', 'https://open.spotify.com/album/2VFLjY1S0D8nKml6nlU2MD', 2002, 3),
(5, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Live In Japan', NULL, 'Rock, pop rock, rock \'n\' roll, blues, musiques du monde', 'https://open.spotify.com/album/4S2ZR5njbJez1rV8DV5Vtl', 1992, 3),
(6, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Thirty Three &1/3', NULL, 'Rock, pop rock, rock \'n\' roll, blues, musiques du monde', 'https://open.spotify.com/album/7y9Fefugnr5b8fHHt9eE7X', 1976, 3);

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
(1, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Eddy de Pretto', 2016, 'France', 'https://open.spotify.com/artist/7rFugkk9ZvVB1zXHg8h0rj', NULL),
(2, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'Angèle', 2015, 'Belgique', 'https://open.spotify.com/artist/3QVolfxko2UyCOtexhVTli', NULL),
(3, '2019-03-22 00:00:00', '2019-03-22 00:00:00', 'George Harrison', 1958, 'Royaume-Uni', 'https://open.spotify.com/artist/7FIoB5PHdrMZVC3q2HE5MS', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
