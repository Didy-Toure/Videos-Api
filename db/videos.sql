-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2024 at 03:09 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `categories` json DEFAULT NULL,
  `auteur_nom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_utilisateur` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_verifie` tinyint(1) DEFAULT NULL,
  `auteur_courriel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_facebook` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_instagram` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_twitch` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_site_web` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `auteur_description` text COLLATE utf8mb4_general_ci,
  `date_publication` date DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `nombre_vues` int DEFAULT NULL,
  `score` int DEFAULT NULL,
  `sous_titres` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `nom`, `description`, `code`, `categories`, `auteur_nom`, `auteur_utilisateur`, `auteur_verifie`, `auteur_courriel`, `auteur_facebook`, `auteur_instagram`, `auteur_twitch`, `auteur_site_web`, `auteur_description`, `date_publication`, `duree`, `nombre_vues`, `score`, `sous_titres`) VALUES
(3, 'Vidéo 3', 'Description de la vidéo 3', 'ABC003', '[\"comédie\"]', 'Auteur 3', '@auteur3', 0, 'email3@example.com', 'facebook3', 'instagram3', 'twitch3', 'site_web3', 'Description de l\'auteur 3', '2023-03-01', 180, 1500, 1200, 'es'),
(4, 'Vidéo 4', 'Description de la vidéo 4', 'ABC004', '[\"documentaire\"]', 'Auteur 4', '@auteur4', 1, 'email4@example.com', 'facebook4', 'instagram4', 'twitch4', 'site_web4', 'Description de l\'auteur 4', '2023-04-01', 90, 800, 300, 'de'),
(5, 'Vidéo 5', 'Description de la vidéo 5', 'ABC005', '[\"science-fiction\"]', 'Auteur 5', '@auteur5', 0, 'email5@example.com', 'facebook5', 'instagram5', 'twitch5', 'site_web5', 'Description de l\'auteur 5', '2023-05-01', 200, 2000, 1500, 'it'),
(6, 'didy', 'Description de la vidéo 6', 'ABC006', '[\"documentaire\"]', 'Auteur 6', '@auteur6', 0, 'email6@example8.com', 'facebook6', 'insta6', 'twitch6', 'site_web6', 'Description auteur 6', '2023-08-30', 1000, 1500, 900, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
