-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 23 mars 2023 à 11:39
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `atlasmoney`
--

-- --------------------------------------------------------

--
-- Structure de la table `assistance`
--

CREATE TABLE `assistance` (
  `name` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `issue` mediumtext NOT NULL,
  `expectation` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `assistance`
--

INSERT INTO `assistance` (`name`, `phone`, `date`, `issue`, `expectation`) VALUES
('Paul', '0789777164', '2023-02-27 00:00:00', 'very low ', 'i want it to be fast'),
('christoph', '01010202', '2023-03-02 00:00:00', 'JE VEUX LARGENT', 'JE VEUX LARGENT'),
('lee', '0789817777', '2023-03-07 00:00:00', 'je suis pauvre', 'je veux largent');

-- --------------------------------------------------------

--
-- Structure de la table `atlasin`
--

CREATE TABLE `atlasin` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` int(4) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `atlasin`
--

INSERT INTO `atlasin` (`id`, `name`, `email`, `phone`, `password`, `balance`) VALUES
(2, 'Meite', 'aboubacarmeite12@gmail.com', '0789777163', 1234, 15299800),
(3, 'Paul', 'aboubacarmeite11@gmail.com', '0789777164', 1234, 1650000),
(4, 'Mohamed', 'Mohamed12@gmail.com', '0707071766', 1234, 60200),
(7, 'christopher', 'christopher1@gmal.com', '0101020203', 1234, 885000),
(8, 'lydie', 'lydie12@gmail.com', '0707793612', 1234, 215000);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `sender` varchar(111) NOT NULL,
  `receiver` varchar(111) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `sender`, `receiver`, `timestamp`, `amount`) VALUES
(1, '2', '3', '2023-02-25 16:58:03', 1000),
(2, '2', '3', '2023-02-25 17:07:52', 2000),
(3, '2', '3', '2023-02-25 17:07:59', 2000),
(4, '3', '2', '2023-02-25 17:08:58', 1000),
(5, '3', '2', '2023-02-25 17:09:12', 3000),
(6, '3', '2', '2023-02-25 17:13:44', 1000),
(7, '3', '2', '2023-02-25 17:14:14', 1000),
(8, '3', '2', '2023-02-25 17:14:50', 1000),
(9, '3', '2', '2023-02-27 15:50:35', 2000),
(10, '3', '2', '2023-02-27 18:48:27', 1500),
(11, '2', '4', '2023-02-28 12:34:02', 2500),
(12, '2', '5', '2023-03-02 15:27:58', 5000),
(13, '5', '3', '2023-03-02 15:29:14', 2000),
(14, '5', '4', '2023-03-02 15:36:01', 35000),
(15, '5', '3', '2023-03-02 15:36:08', 15000),
(16, '2', '6', '2023-03-07 11:33:18', 100000),
(17, '2', '5', '2023-03-07 11:34:12', 5000),
(18, '6', '2', '2023-03-07 11:36:30', 100000),
(19, '5', '2', '2023-03-07 11:37:36', 10000),
(20, '2', '7', '2023-03-07 11:45:41', 250000),
(21, '2', '7', '2023-03-07 11:45:58', 500000),
(22, '7', '3', '2023-03-07 11:46:33', 150000),
(23, '7', '8', '2023-03-07 11:47:45', 215000),
(24, '2', '2', '2023-03-21 21:54:58', 200),
(25, '2', '4', '2023-03-21 21:56:13', 200),
(26, '4', '4', '2023-03-21 21:57:35', 200);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `atlasin`
--
ALTER TABLE `atlasin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `atlasin`
--
ALTER TABLE `atlasin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
