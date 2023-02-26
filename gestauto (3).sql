-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 jan. 2023 à 11:15
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestauto`
--

-- --------------------------------------------------------

--
-- Structure de la table `assurances`
--

CREATE TABLE `assurances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `societeAssurance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedebA` date NOT NULL,
  `datefinA` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `assurances`
--

INSERT INTO `assurances` (`id`, `societeAssurance`, `datedebA`, `datefinA`, `status`, `voiture_id`, `created_at`, `updated_at`) VALUES
(1, 'AA Assur', '2022-10-04', '2022-10-12', 1, 2, '2022-10-04 07:59:42', '2022-10-04 08:26:38'),
(4, 'AA Assur 2', '2022-10-04', '2022-09-20', 1, 1, '2022-10-04 08:26:38', '2022-10-04 08:26:38'),
(5, 'AA Assur', '2022-10-04', '2022-10-10', 0, 2, '2022-10-04 07:59:42', '2022-10-04 08:26:38');

-- --------------------------------------------------------

--
-- Structure de la table `chauffeurs`
--

CREATE TABLE `chauffeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `disp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Disponible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chauffeurs`
--

INSERT INTO `chauffeurs` (`id`, `tel`, `adresse`, `user_id`, `disp`, `created_at`, `updated_at`) VALUES
(6, '62869062', 'gboyouentreprise', 2, 'Non Disponible', '2022-12-08 22:08:39', '2022-12-28 08:18:43'),
(7, '62869063', 'gboyouentreprise', 3, 'Disponible', '2022-12-08 22:08:55', '2022-12-12 09:30:57');

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objetdemande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedeb` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `addchauffeur` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non Approuvée',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nbreVoiture` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `objetdemande`, `datedeb`, `datefin`, `addchauffeur`, `type`, `user_id`, `status`, `created_at`, `updated_at`, `nbreVoiture`, `description`, `etat`) VALUES
(5, 'Livrer Un Colis 1', '2022-12-09', '2022-12-17', 1, 'voiture', 1, 'Rendu', '2022-12-08 20:36:42', '2022-12-09 08:58:23', 3, 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu\'il est prêt ou que la mise en page est achevée. Généralement, on utilise un texte en faux latin, le Lorem ipsum ou Lipsum', 1),
(7, 'Livrer Un Colis 1', '2022-12-10', '2022-12-18', 1, 'voiture', 1, 'Rendu', '2022-12-09 09:48:08', '2022-12-10 14:58:31', 2, 'Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page.\r\n\r\nLe texte définitif venant remplacer le faux-texte dès qu\'il est prêt ou que la mise en page est achevée. Généralement, on utilise un texte en faux latin, le Lorem ipsum ou Lipsum.', 1),
(9, 'Livrer Un Colis 1', '2022-12-11', '2022-12-18', 0, 'voiture', 1, 'Rendu', '2022-12-10 15:01:47', '2022-12-10 21:08:28', 1, 'Pas de description', 1),
(11, 'Aller a une mission', '2022-12-18', '2023-01-01', 0, 'voiture', 1, 'Rendu', '2022-12-10 21:06:03', '2022-12-12 13:25:58', 2, 'Demande de voiture', 1),
(12, 'Aller a une mission', '2022-12-18', '2022-12-25', 1, 'voiture', 1, 'Rendu', '2022-12-11 19:53:13', '2022-12-12 13:25:01', 1, 'oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', 1),
(14, 'Aller a une mission a boha boha', '2022-12-12', '2023-01-01', 0, 'voiture', 1, 'Rendu', '2022-12-12 13:27:04', '2022-12-12 13:32:52', 2, 'Voilà une demande intéressante', 1),
(16, 'Aller a une mission', '2022-12-16', '2022-12-31', 0, 'voiture', 1, 'Rendu', '2022-12-15 07:20:41', '2022-12-15 07:26:04', 2, 'Aller a une mission a boha boha', 1),
(17, 'Réparation (TOYOTA/AB7665)', NULL, NULL, 0, 'reparation', 1, 'Rendu', '2022-12-15 07:22:50', '2022-12-15 07:24:01', NULL, 'Demande de Réparation', 0),
(19, 'Accessibilité à la connexion', '2022-12-16', '2023-01-08', 0, 'voiture', 3, 'Approuvée', '2022-12-15 07:34:15', '2022-12-16 07:44:14', 1, 'Mettre de la connexion a Espace Dina', 0),
(20, 'Mission de maintenance', '2022-12-27', '2023-01-08', 1, 'voiture', 3, 'Approuvée', '2022-12-28 08:14:05', '2022-12-28 08:18:44', 1, 'Nous permettra de réinstaller les pc et d\'installer antivirus', 0),
(21, 'ddddddddd', '2023-01-02', '2023-01-22', 0, 'voiture', 5, 'Non Approuvée', '2023-01-03 07:31:43', '2023-01-03 07:31:43', 1, 'oooooooooooooooooooooooooo', 0);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `garages`
--

CREATE TABLE `garages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomgarage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `garages`
--

INSERT INTO `garages` (`id`, `nomgarage`, `created_at`, `updated_at`) VALUES
(1, 'Garage 1', '2022-10-10 18:38:41', '2022-10-10 18:38:41');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_09_13_105010_create_missions_table', 1),
(5, '2022_09_14_000000_structures_table', 1),
(6, '2022_09_14_000001_create_users_table', 1),
(7, '2022_09_14_000002_create_voitures_table', 1),
(8, '2022_09_14_135636_create_assurances_table', 1),
(9, '2022_09_19_074423_create_chauffeurs_table', 1),
(10, '2022_09_20_092524_create_mission_users_table', 1),
(11, '2022_09_20_151403_create_garages_table', 1),
(12, '2022_09_20_155234_create_pieces_table', 1),
(13, '2022_09_29_145152_create_demandes_table', 1),
(14, '2022_10_02_231410_create_reparers_table', 1),
(15, '2022_10_04_001210_create_visite_table', 2),
(16, '2022_09_13_000001_structures_table', 3),
(17, '2022_09_20_155235_create_pieces_table', 3),
(18, '2022_08_14_000001_create_users_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

CREATE TABLE `missions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demande_id` int(11) NOT NULL,
  `affecter_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kmdeb` int(11) DEFAULT 0,
  `kmfin` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`id`, `demande_id`, `affecter_id`, `type`, `kmdeb`, `kmfin`, `status`, `created_at`, `updated_at`) VALUES
(15, 5, 1, 'voiture', 12, 21, 1, '2022-12-09 01:03:11', '2022-12-09 08:58:23'),
(16, 5, 2, 'voiture', 12, 23, 1, '2022-12-09 01:03:12', '2022-12-09 08:58:23'),
(17, 5, 2, 'chauffeur', 0, 0, 1, '2022-12-09 01:03:12', '2022-12-09 08:58:23'),
(22, 7, 1, 'voiture', 9, 53, 1, '2022-12-10 14:55:58', '2022-12-10 14:58:31'),
(23, 7, 2, 'voiture', 10, 24, 1, '2022-12-10 14:55:59', '2022-12-10 14:58:31'),
(24, 7, 2, 'chauffeur', 0, 0, 1, '2022-12-10 14:55:59', '2022-12-10 14:58:31'),
(25, 7, 3, 'chauffeur', 0, 0, 1, '2022-12-10 14:55:59', '2022-12-10 14:58:31'),
(26, 9, 1, 'voiture', 12, 1250, 1, '2022-12-10 15:02:10', '2022-12-10 21:08:28'),
(27, 11, 2, 'voiture', 50, 12000, 1, '2022-12-11 19:52:44', '2022-12-12 13:25:58'),
(30, 12, 1, 'voiture', 12, 12345, 1, '2022-12-12 09:31:14', '2022-12-12 13:25:01'),
(31, 12, 2, 'chauffeur', 0, 0, 1, '2022-12-12 09:31:14', '2022-12-12 13:25:01'),
(32, 14, 1, 'voiture', 12, 45, 1, '2022-12-12 13:27:22', '2022-12-12 13:32:52'),
(33, 14, 2, 'voiture', 15, 90, 1, '2022-12-12 13:27:22', '2022-12-12 13:32:52'),
(34, 16, 1, 'voiture', 30, 500, 1, '2022-12-15 07:21:15', '2022-12-15 07:26:04'),
(35, 16, 2, 'voiture', 50, 800, 1, '2022-12-15 07:21:15', '2022-12-15 07:26:04'),
(36, 19, 3, 'voiture', 0, 0, 0, '2022-12-16 07:44:14', '2022-12-16 07:44:14'),
(37, 20, 1, 'voiture', 0, 0, 0, '2022-12-28 08:18:43', '2022-12-28 08:18:43'),
(38, 20, 2, 'chauffeur', 0, 0, 0, '2022-12-28 08:18:44', '2022-12-28 08:18:44');

-- --------------------------------------------------------

--
-- Structure de la table `mission_users`
--

CREATE TABLE `mission_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kmdeb` double NOT NULL DEFAULT 0,
  `kmfin` double NOT NULL DEFAULT 0,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `voiture_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pieces`
--

CREATE TABLE `pieces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nompiece` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datefin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pieces`
--

INSERT INTO `pieces` (`id`, `nompiece`, `datefin`, `created_at`, `updated_at`) VALUES
(1, 'Moteur', '2023-01-11', '2022-11-26 15:30:40', '2022-11-26 15:30:40'),
(2, 'Echapement', '2023-01-11', '2022-11-26 15:30:55', '2022-11-26 15:30:55'),
(3, 'Pneu', '2023-01-11', '2022-11-26 15:31:08', '2022-11-26 15:31:08'),
(4, 'Frein', '2023-01-11', '2022-11-26 15:31:41', '2022-11-26 15:31:41');

-- --------------------------------------------------------

--
-- Structure de la table `reparers`
--

CREATE TABLE `reparers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `panne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datereparation` date DEFAULT NULL,
  `garage_id` bigint(20) UNSIGNED NOT NULL,
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `demande_id` bigint(20) UNSIGNED NOT NULL,
  `pieces` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reparers`
--

INSERT INTO `reparers` (`id`, `panne`, `datereparation`, `garage_id`, `voiture_id`, `user_id`, `demande_id`, `pieces`, `created_at`, `updated_at`) VALUES
(6, 'La batterie présente des défaillances et demande une recharge', NULL, 1, 1, 1, 17, 'a:1:{i:0;s:1:\"1\";}', '2022-12-15 07:22:50', '2022-12-15 07:22:50');

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomStructure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structures`
--

INSERT INTO `structures` (`id`, `nomStructure`, `localisation`, `created_at`, `updated_at`) VALUES
(1, 'DPAF', 'Cadjehoun', NULL, NULL),
(2, 'ODD', 'Parakou', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `structure_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `structure_id`, `created_at`, `updated_at`) VALUES
(1, 'User 1', 'Administrateur', 'user1@gmail.com', NULL, '$2y$10$SyYXcwWgmqg/RnrJJnt3FOpLZ3W/aJXFeW9uCx0gxx90fcfiC9BZa', NULL, 1, NULL, '2022-12-28 07:19:21'),
(2, 'Chauffeur 1', 'Chauffeur', 'chauffeur1@gmail.com', NULL, '$2y$10$SyYXcwWgmqg/RnrJJnt3FOpLZ3W/aJXFeW9uCx0gxx90fcfiC9BZa', NULL, 1, NULL, '2022-12-08 22:08:39'),
(3, 'Charles GBOYOU', 'Chauffeur', 'gboyoucharles22@gmail.com', NULL, '$2y$10$KdlxflkRnzZE0.SgGxN8Z.mmeI.oJoDtD5W0oxaVTdMuLZGe2DXEG', NULL, 1, '2022-11-27 16:55:10', '2022-12-08 22:08:55'),
(4, 'BellO', 'Utilisateur', 'bastoubello@gmail.com', NULL, '$2y$10$0ws70AhtMLrmOpQZoeYL5Or9Z.0xHOhL/7I/XnLieTcPHDTVCzLyy', NULL, 1, '2022-12-28 07:31:05', '2022-12-28 07:31:05'),
(5, 'SANT-ANNA Marie-Didier', 'Utilisateur', 'mariesantanna114@gmail.com', NULL, '$2y$10$sWwP3dbGqHFuVvx8.TW3eutApnElE6vDXLc.aOLuLeRh7VNEGeLNK', NULL, 1, '2022-12-28 07:41:26', '2023-01-03 07:13:49');

-- --------------------------------------------------------

--
-- Structure de la table `visites`
--

CREATE TABLE `visites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kmvidange` int(11) DEFAULT NULL,
  `datevisite` date DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `visites`
--

INSERT INTO `visites` (`id`, `kmvidange`, `datevisite`, `status`, `voiture_id`, `created_at`, `updated_at`) VALUES
(1, 20221004, '2022-11-17', 1, 1, '2022-10-03 23:20:19', '2022-11-17 00:20:09'),
(2, 20221004, '2022-11-17', 1, 2, '2022-10-03 23:20:19', '2022-11-17 00:20:09'),
(3, 20221010, '2022-11-17', 0, 1, '2022-10-10 18:40:15', '2022-10-10 18:46:52'),
(4, 20221010, '2022-11-17', 0, 2, '2022-10-10 18:40:15', '2022-10-10 18:40:15'),
(5, 20221101, '2022-11-17', 0, 1, '2022-11-01 20:53:12', '2022-11-01 20:53:12'),
(6, 1234, '2022-11-17', 0, 2, '2022-11-01 21:43:16', '2022-11-01 21:43:16'),
(7, 1234, '2022-11-17', 1, 3, '2022-11-01 21:44:48', '2022-11-17 00:20:09'),
(8, 1009, '2022-11-17', 0, 1, '2022-11-13 18:54:32', '2022-11-13 18:54:32'),
(9, 1009, '2022-11-17', 0, 1, '2022-11-13 19:01:25', '2022-11-13 19:01:25'),
(10, 207, '2022-11-17', 0, 2, '2022-11-13 19:01:26', '2022-11-13 19:01:26'),
(11, 1009, '2022-11-17', 0, 1, '2022-11-16 23:07:55', '2022-11-16 23:07:55'),
(12, 207, '2022-11-17', 0, 2, '2022-11-16 23:07:55', '2022-11-16 23:07:55'),
(13, NULL, '2022-11-17', 0, 3, '2022-11-16 23:08:18', '2022-11-16 23:08:18'),
(14, 0, '2022-11-17', 0, 1, '2022-11-16 23:27:12', '2022-11-16 23:27:12'),
(15, 0, '2022-11-17', 0, 2, '2022-11-16 23:27:12', '2022-11-16 23:27:12'),
(16, 0, '2022-11-17', 0, 1, '2022-11-17 00:06:42', '2022-11-17 00:06:42'),
(17, NULL, '2022-11-17', 0, 3, '2022-11-17 00:06:51', '2022-11-17 00:06:51'),
(18, NULL, '2022-11-17', 0, 1, '2022-11-17 00:13:52', '2022-11-17 00:13:52'),
(19, NULL, '2022-11-17', 0, 2, '2022-11-17 00:13:52', '2022-11-17 00:13:52');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacite` int(11) NOT NULL,
  `immatriculation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datdebservice` date NOT NULL,
  `dureeVie` int(11) NOT NULL,
  `numchassis` int(11) NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilmax` int(11) NOT NULL,
  `connsommation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coutaquisition` int(11) NOT NULL,
  `mouvement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Au parc',
  `dispo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Disponible',
  `kmvidange` int(11) DEFAULT 0,
  `date_next_visite` date NOT NULL DEFAULT current_timestamp(),
  `status_visite` tinyint(1) NOT NULL DEFAULT 0,
  `status_vidange` tinyint(1) NOT NULL DEFAULT 0,
  `structure_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `capacite`, `immatriculation`, `datdebservice`, `dureeVie`, `numchassis`, `etat`, `kilmax`, `connsommation`, `coutaquisition`, `mouvement`, `dispo`, `kmvidange`, `date_next_visite`, `status_visite`, `status_vidange`, `structure_id`, `created_at`, `updated_at`) VALUES
(1, 'TOYOTA', 7, 'AB7665', '2022-10-03', 10, 3456789, 'Utilisable', 123441349, '12345', 9876543, 'En mission', 'Non Disponible', 14253, '2023-01-11', 0, 0, 1, '2022-10-03 21:20:22', '2022-12-28 08:18:43'),
(2, 'LEXUS', 7, 'AB1234', '2022-10-03', 10, 3456789, 'Utilisable', 123443720, '12345', 9876543, 'Au parc', 'Disponible', 12814, '2023-01-11', 0, 0, 1, '2022-10-03 21:20:22', '2022-12-15 07:26:04'),
(3, 'AVALON', 4, 'AC4234', '2022-10-03', 10, 3456789, 'Utilisable', 123456558, '12345', 9876543, 'En mission', 'Non Disponible', 222, '2023-01-11', 0, 0, 1, '2022-10-03 21:20:22', '2022-12-16 07:44:14'),
(4, 'RAV4', 4, 'AD5234', '2022-10-03', 10, 3456789, 'Utilisable', 123456700, '12345', 9876543, 'Au parc', 'Disponible', 0, '2023-01-11', 0, 0, 1, '2022-10-03 21:20:22', '2022-12-09 10:13:53'),
(5, 'LEXUS 23', 123, 'QA7675', '2022-11-28', 1234, 123456, 'Utilisable', 1234567, '1234', 12345678, 'Au parc', 'Disponible', 0, '2023-01-11', 0, 0, 1, '2022-11-27 20:12:03', '2022-11-27 20:12:03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assurances`
--
ALTER TABLE `assurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assurances_voiture_id_foreign` (`voiture_id`);

--
-- Index pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chauffeurs_user_id_foreign` (`user_id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demandes_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `garages`
--
ALTER TABLE `garages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission_users`
--
ALTER TABLE `mission_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mission_users_mission_id_foreign` (`mission_id`),
  ADD KEY `mission_users_voiture_id_foreign` (`voiture_id`),
  ADD KEY `mission_users_user_id_foreign` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reparers`
--
ALTER TABLE `reparers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reparers_garage_id_foreign` (`garage_id`),
  ADD KEY `reparers_voiture_id_foreign` (`voiture_id`),
  ADD KEY `reparers_user_id_foreign` (`user_id`),
  ADD KEY `reparers_demande_id_foreign` (`demande_id`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `structures_nomstructure_unique` (`nomStructure`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_email_unique` (`name`,`email`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_structure_id_foreign` (`structure_id`);

--
-- Index pour la table `visites`
--
ALTER TABLE `visites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visites_voiture_id_foreign` (`voiture_id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voitures_immatriculation_unique` (`immatriculation`),
  ADD KEY `voitures_structure_id_foreign` (`structure_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assurances`
--
ALTER TABLE `assurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `garages`
--
ALTER TABLE `garages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `mission_users`
--
ALTER TABLE `mission_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pieces`
--
ALTER TABLE `pieces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reparers`
--
ALTER TABLE `reparers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `visites`
--
ALTER TABLE `visites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assurances`
--
ALTER TABLE `assurances`
  ADD CONSTRAINT `assurances_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);

--
-- Contraintes pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  ADD CONSTRAINT `chauffeurs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `demandes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mission_users`
--
ALTER TABLE `mission_users`
  ADD CONSTRAINT `mission_users_mission_id_foreign` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_users_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reparers`
--
ALTER TABLE `reparers`
  ADD CONSTRAINT `reparers_demande_id_foreign` FOREIGN KEY (`demande_id`) REFERENCES `demandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reparers_garage_id_foreign` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reparers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reparers_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);

--
-- Contraintes pour la table `visites`
--
ALTER TABLE `visites`
  ADD CONSTRAINT `visites_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voitures_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
