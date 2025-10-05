-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql303.infinityfree.com
-- Généré le :  Dim 05 oct. 2025 à 10:48
-- Version du serveur :  11.4.7-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_40096178_my_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Jordan');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `active`) VALUES
(1, 'Sneakers', NULL, 1),
(2, 'Hauts', NULL, 1),
(3, 'Ensembles', NULL, 1),
(4, 'Accessoires', NULL, 1),
(5, 'Ballons', NULL, 1),
(6, 'Chaussettes', NULL, 1),
(7, 'Bas', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `brand_id`, `image`, `active`) VALUES
(1, 'Air Jordan 1 Retro High OG', '160.00', 1, 0, 'jordan1.jpg', 1),
(2, 'Nike Dunk Low \"Panda\"', '120.00', 1, 0, 'dunk_panda.jpg', 1),
(3, 'Adidas Ultraboost', '140.00', 1, 0, 'ultraboost_femme.jpg', 1),
(4, 'Short Nike Dri-FIT', '35.00', 7, 0, 'short_nike_drifit.jpg', 1),
(5, 'T-shirt Jordan Flight', '30.00', 2, 0, 'tshirt_jordan_flight.jpg', 1),
(6, 'Ensemble Nike Tech Fleece', '150.00', 3, 0, 'ensemble_tech_fleece.jpg', 1),
(7, 'Sac à dos NBA Spalding', '50.00', 4, 0, 'sac_nba_spalding.jpg', 1),
(8, 'Chaussettes Nike Elite', '13.00', 6, 0, 'chaussettes_nike_elite.jpg', 1),
(9, 'Ballon Spalding TF-1000', '60.00', 5, 0, 'ballon_spalding_tf1000.jpg', 1),
(10, 'Air Jordan 1 Mid SE \"Light Smoke\"', '140.00', 1, 0, 'jordan1_mid_smoke.jpg', 1),
(11, 'Nike Dunk High \"University Red\"', '130.00', 1, 0, 'dunk_high_red.jpg', 1),
(12, 'Adidas Harden Vol.7', '150.00', 1, 0, 'harden_vol7.jpg', 1),
(13, 'Pantalon Jordan Essentials Fleece', '60.00', 7, 0, 'pantalon_jordan_fleece.jpg', 1),
(14, 'Sweat à capuche Nike NBA Warriors', '70.00', 2, 0, 'hoodie_nba_warriors.jpg', 1),
(15, 'Ensemble Jordan Jumpman Classics', '160.00', 3, 0, 'ensemble_jordan_classics.jpg', 1),
(16, 'Casquette Jordan Pro Jumpman', '30.00', 4, 0, 'casquette_jordan_pro.jpg', 1),
(18, 'Ballon Nike Elite Tournament', '65.00', 5, 0, 'ballon_nike_elite.jpg', 1),
(19, 'Sac de sport Nike Hoops Elite Pro', '60.00', 4, 0, 'sac_hoops_elite.jpg', 1),
(20, 'Air Jordan 4 Retro \"Fire Red\"', '190.00', 1, 0, 'jordan4_fire_red.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`, `active`) VALUES
(1, 'Black_Spiderman', '$2y$12$Woy7f1afbuU1iwHk2V6wAOzhsu3evoA6vbjcNCZGf/mENnq9wJyvK', 'miles.m@marvel.com', 0, 1),
(2, 'leo', '$2y$12$khZMycq563Q1.ut9VGD4x.aaTN1v6Jj04M.zOF99Qc3nXLREPfPP2', 'leo.leo@leo.com', 0, 1),
(5, 'BigBoss', '$2y$12$ijxnDWs1elV20b1SmP6uK.ppFHejdpxgh/ToQcaXAiuODXyGKcT3.', 'boss@site.com', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
