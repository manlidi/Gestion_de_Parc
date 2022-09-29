-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 sep. 2022 à 16:45
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
  `notif` tinyint(1) NOT NULL DEFAULT 0,
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `assurances`
--

INSERT INTO `assurances` (`id`, `societeAssurance`, `datedebA`, `datefinA`, `status`, `notif`, `voiture_id`, `created_at`, `updated_at`) VALUES
(1, 'Assurance 1', '2022-09-28', '2022-10-09', 1, 0, 1, '2022-09-27 06:06:51', '2022-09-27 06:06:51');

-- --------------------------------------------------------

--
-- Structure de la table `chauffeurs`
--

CREATE TABLE `chauffeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_cva` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_cva` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Disponible',
  `structure_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chauffeurs`
--

INSERT INTO `chauffeurs` (`id`, `nom_cva`, `prenom_cva`, `tel`, `adresse`, `disp`, `structure_id`, `created_at`, `updated_at`) VALUES
(1, 'AGOUDA', 'Espérance', 62745851, 'Menontin', 'Non Disponible', 1, '2022-09-27 06:10:38', '2022-09-27 06:10:38'),
(2, 'BOGNON', 'Modeste', 96476274, 'Cotonou', 'Non Disponible', 1, '2022-09-27 06:10:55', '2022-09-27 06:10:55'),
(3, 'Test', 'Test', 62745851, 'Test', 'Non Disponible', 1, '2022-09-28 17:23:24', '2022-09-28 17:23:24'),
(4, 'SOSSA', 'Robert', 97476274, 'Menontin', 'Non Disponible', 1, '2022-09-28 17:24:34', '2022-09-28 17:24:34');

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
(9, '2022_09_19_074420_create_chauffeurs_table', 1),
(10, '2022_09_20_092523_create_mission_users_table', 1),
(11, '2022_09_20_092662_create_mission_voitures_table', 1),
(12, '2022_09_20_132819_create_mission_chauffeurs_table', 1),
(13, '2022_09_20_151403_create_garages_table', 1),
(14, '2022_09_20_155234_create_pieces_table', 1),
(15, '2022_09_20_162151_create_reparers_table', 1),
(16, '2022_09_20_092524_create_mission_users_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

CREATE TABLE `missions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objetmission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedeb` date NOT NULL,
  `datefin` date NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non fait',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`id`, `objetmission`, `datedeb`, `datefin`, `etat`, `created_at`, `updated_at`) VALUES
(1, 'Aller représenter la DPAF a Porto-Novo', '2022-09-28', '2022-10-05', 'Fait', '2022-09-27 10:16:54', '2022-09-28 19:34:05'),
(2, 'Aller représenter la DPAF a Ouidah', '2022-09-30', '2022-10-09', 'Non fait', '2022-09-27 10:17:10', '2022-09-27 10:17:10');

-- --------------------------------------------------------

--
-- Structure de la table `mission_users`
--

CREATE TABLE `mission_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kmdeb` double NOT NULL DEFAULT 0,
  `kmfin` double NOT NULL DEFAULT 0,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `chauffeur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission_users`
--

INSERT INTO `mission_users` (`id`, `kmdeb`, `kmfin`, `mission_id`, `voiture_id`, `chauffeur_id`, `created_at`, `updated_at`) VALUES
(1, 0, 524, 1, 1, 4, '2022-09-27 10:16:54', '2022-09-28 19:34:05'),
(2, 0, 562, 1, 2, 3, '2022-09-27 10:16:54', '2022-09-28 19:34:05'),
(3, 0, 0, 2, 3, 1, '2022-09-27 10:17:10', '2022-09-27 10:17:10');

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
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reparers`
--

CREATE TABLE `reparers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `panne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datereparation` date NOT NULL,
  `garage_id` bigint(20) UNSIGNED NOT NULL,
  `voiture_id` bigint(20) UNSIGNED NOT NULL,
  `piece_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Structure 1', 'Menontin', '2022-09-26 20:29:37', '2022-09-26 20:29:37'),
(2, 'Structure 2', 'Cadjehoun', '2022-09-26 20:30:05', '2022-09-26 20:30:05');

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
(1, 'SANT-ANNA Marie-Didier', 'Administrateur', 'mariesantanna114@gmail.com', NULL, '$2y$10$8BzA.EcJfOy6q911/Wjrf.z.7wpunw.DSUAyWrftWfxOnacp7byc2', NULL, 1, '2022-09-26 19:30:54', '2022-09-26 19:30:54'),
(2, 'GBOYOU Charles', 'Utilisateur', 'gboyoucharles22@gmail.com', NULL, '$2y$10$tCl3ZSR5jRcYhKoiSbIgpujLDt/TYO5TWmagJHhM8sVr9LUj.zFK.', NULL, 1, '2022-09-26 19:31:18', '2022-09-26 19:31:18'),
(3, 'KPEKPASSI Martine', 'Utilisateur', 'martine123@gmail.com', NULL, '$2y$10$Zh97POFGwEGeFcJ3QnxaAuFu./IYAJDgXf3P1HS4PghT.a0K5MfqK', NULL, 2, '2022-09-26 19:31:37', '2022-09-26 19:31:37'),
(4, 'Paula EDIN', 'Utilisateur', 'achibelegancy@gmail.com', NULL, '$2y$10$V8gSSg7wLv498gwfGNAmBOplQ0Yvw86dE4C.brRUgaOVIDe7QvHlK', NULL, 2, '2022-09-26 19:31:58', '2022-09-26 19:31:58');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `capacite`, `immatriculation`, `datdebservice`, `dureeVie`, `numchassis`, `etat`, `kilmax`, `connsommation`, `coutaquisition`, `mouvement`, `dispo`, `created_at`, `updated_at`) VALUES
(1, 'Lexus', 5, 'PS 1245', '2022-09-29', 4, 415326, 'Utilisable', 1000, '700', 1000000, 'En mission', 'Non Disponible', '2022-09-27 06:05:31', '2022-09-28 19:34:05'),
(2, 'Mercedes', 6, 'BP 5478', '2022-09-20', 5, 4132578, 'Utilisable', 1000, '400', 2000000, 'En mission', 'Non Disponible', '2022-09-27 06:06:22', '2022-09-28 19:34:05'),
(3, 'KIA', 4, 'BF 4786', '2022-09-28', 6, 741258, 'Utilisable', 2000, '700', 1900000, 'En mission', 'Non Disponible', '2022-09-27 07:37:16', '2022-09-27 07:37:16'),
(4, 'RAV 4', 9, 'AB 1234', '2022-09-29', 6, 451236, 'Utilisable', 2000, '400', 1234564, 'Au parc', 'Disponible', '2022-09-27 11:11:00', '2022-09-27 11:11:00');

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
  ADD KEY `chauffeurs_structure_id_foreign` (`structure_id`);

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
  ADD KEY `mission_users_chauffeur_id_foreign` (`chauffeur_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `pieces_voiture_id_foreign` (`voiture_id`);

--
-- Index pour la table `reparers`
--
ALTER TABLE `reparers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reparers_garage_id_foreign` (`garage_id`),
  ADD KEY `reparers_voiture_id_foreign` (`voiture_id`),
  ADD KEY `reparers_piece_id_foreign` (`piece_id`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_structure_id_foreign` (`structure_id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voitures_immatriculation_unique` (`immatriculation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assurances`
--
ALTER TABLE `assurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `chauffeurs`
--
ALTER TABLE `chauffeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `garages`
--
ALTER TABLE `garages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `mission_users`
--
ALTER TABLE `mission_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pieces`
--
ALTER TABLE `pieces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reparers`
--
ALTER TABLE `reparers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `chauffeurs_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);

--
-- Contraintes pour la table `mission_users`
--
ALTER TABLE `mission_users`
  ADD CONSTRAINT `mission_users_chauffeur_id_foreign` FOREIGN KEY (`chauffeur_id`) REFERENCES `chauffeurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_users_mission_id_foreign` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mission_users_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pieces`
--
ALTER TABLE `pieces`
  ADD CONSTRAINT `pieces_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);

--
-- Contraintes pour la table `reparers`
--
ALTER TABLE `reparers`
  ADD CONSTRAINT `reparers_garage_id_foreign` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`),
  ADD CONSTRAINT `reparers_piece_id_foreign` FOREIGN KEY (`piece_id`) REFERENCES `pieces` (`id`),
  ADD CONSTRAINT `reparers_voiture_id_foreign` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_structure_id_foreign` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
