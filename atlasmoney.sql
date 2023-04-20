-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 avr. 2023 à 12:32
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
('pagani', '0707071111', '2023-04-06 00:00:00', 'Money', 'want money');

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
(1, 'Administrator', 'administrator1@gmail.com', '0101010101', 1234, 27890),
(2, 'Meite', 'aboubacarmeite12@gmail.com', '0789777163', 5678, 1521711679),
(3, 'Guede', 'Guede12@gmail.com', '0102030205', 1234, 334125),
(5, 'christopher', 'christopher1@gmal.com', '0707071766', 1234, 1949350),
(7, 'pagani', 'azerty12@gmail.com', '0707071111', 1234, 0);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_number` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `sender` varchar(111) NOT NULL,
  `receiver` varchar(111) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` int(11) NOT NULL,
  `fees` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_number`, `sender`, `receiver`, `timestamp`, `amount`, `fees`) VALUES
(1, '642e9592bbbe1', '2', '4', '2023-04-06 09:49:06', 25000, '250.00'),
(2, '642e95a58a651', '2', '5', '2023-04-06 09:49:25', 65000, '650.00'),
(3, '642e95df100b9', '2', '3', '2023-04-06 09:50:23', 24600, '246.00'),
(4, '642e960b71fcd', '4', '2', '2023-04-06 09:51:07', 3500, '35.00'),
(5, '642e966e9ca7c', '4', '3', '2023-04-06 09:52:46', 55400, '554.00'),
(6, '642e969eb9abf', '5', '2', '2023-04-06 09:53:34', 25000, '250.00'),
(7, '642e9743b8fa1', '2', '5', '2023-04-06 09:56:19', 1500000, '15000.00'),
(8, '642ea0aae581b', '5', '2', '2023-04-06 10:36:26', 4500, '45.00');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
