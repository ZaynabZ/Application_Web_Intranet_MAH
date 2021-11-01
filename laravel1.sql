-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 oct. 2021 à 17:50
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel1`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidats`
--

CREATE TABLE `candidats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom_candidat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_candidat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emplacement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `justification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` enum('Rejetée','En Cours','Validée') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En Cours'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id`, `created_at`, `updated_at`, `user_id`, `service_id`, `date_debut`, `date_fin`, `justification`, `motif`, `etat`) VALUES
(17, '2021-10-29 12:34:14', '2021-10-29 13:00:15', 28, 12, '2021-10-30 08:00:00', '2021-10-30 13:00:00', 'o;op;i', 'Congé de naissance', 'Validée'),
(18, '2021-10-29 13:09:11', '2021-10-29 13:09:11', 27, 12, '2021-10-30 00:00:01', '2021-11-05 23:59:59', 'kjik,,', 'Circoncision', 'En Cours');

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_demande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `created_at`, `updated_at`, `type_demande`) VALUES
(1, '2021-11-03 17:51:34', '2021-11-06 09:20:08', 'Demande d\'attestation de travail'),
(4, '2021-11-06 08:56:39', '2021-11-06 08:56:39', 'Demande d\'attestation de paiement');

-- --------------------------------------------------------

--
-- Structure de la table `demande_user`
--

CREATE TABLE `demande_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `demande_id` int(10) UNSIGNED NOT NULL,
  `etat` enum('En cours','Réalisée') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En cours',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demande_user`
--

INSERT INTO `demande_user` (`id`, `user_id`, `demande_id`, `etat`, `created_at`, `updated_at`) VALUES
(1, 28, 1, 'Réalisée', '2021-10-29 12:36:38', '2021-10-29 12:59:20'),
(2, 27, 4, 'En cours', '2021-10-29 13:08:32', '2021-10-29 13:08:32'),
(3, 28, 1, 'En cours', '2021-10-29 13:15:43', '2021-10-29 13:15:43');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_20_121605_add_attributes_to_users_table', 2),
(8, '2014_10_12_000000_create_users_table', 3),
(9, '2014_10_12_100000_create_password_resets_table', 3),
(10, '2019_08_19_000000_create_failed_jobs_table', 3),
(11, '2021_09_21_085545_add_attributes_to_users_table', 4),
(12, '2021_09_21_085911_create_user_reservation_table', 5),
(13, '2021_09_21_090211_create_reservations_table', 6),
(14, '2021_09_21_090655_create_user_reservation_table', 7),
(15, '2021_09_21_135016_add_attribute_to_reservations_table', 8),
(16, '2021_09_21_135825_add_attribute_to_reservations_table', 9),
(17, '2021_09_21_144953_make_image_nullable_in_users_table', 10),
(18, '2021_09_22_111616_add_roles_to_users_table', 11),
(19, '2021_09_23_125151_change_role_typein_users_table', 12),
(20, '2021_09_23_134038_change_atribute_in_users_table', 13),
(21, '2021_09_23_143826_change_role_users_table', 14),
(22, '2021_09_23_145205_add_role_attribute_to_users', 15),
(25, '2021_09_24_134801_create_table_services', 16),
(27, '2021_10_06_090114_add_foreign_key_constraint_to_users_table', 17),
(28, '2021_10_06_165433_add_soft_deletes_field', 18),
(29, '2021_10_12_092221_alter_table_users_change_role', 19),
(30, '2021_10_12_163628_create_table_roles', 20),
(31, '2021_10_12_165722_drop_column_role', 21),
(32, '2021_10_13_084835_alter_table_users', 21),
(33, '2021_10_13_094319_adding_new_attributes_table_users', 22),
(35, '2021_11_01_142022_add_conge_type_to_conges_table', 23),
(36, '2021_11_01_152822_add_new_attribute_to_services', 24),
(37, '2021_11_03_110106_create_demandes_table', 25),
(38, '2021_11_03_122459_create_table_demandes_users', 26),
(39, '2021_11_03_124947_create_demande_user', 27),
(40, '2021_11_06_093124_create_candidats', 28),
(41, '2021_11_06_094228_create_candidats', 29),
(42, '2021_10_12_124619_create_notifications_table', 30),
(45, '2021_11_01_134212_create_conges_table', 31),
(47, '2021_10_28_155428_changes', 32),
(48, '2021_10_25_131007_update_candidats_table', 33);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0a6c509d-62cc-4815-ba97-cb34f2d29f5f', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 28, '{\"typ\":\"newfile\",\"first\":\"najib\",\"last\":\"najib\",\"date\":\"2021-10-29T15:08:05.025173Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-29.jpg\"}', NULL, '2021-10-29 13:08:05', '2021-10-29 13:08:05'),
('0aa70f00-83e8-4737-88b0-a47ec1454474', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 24, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-26T16:35:41.267770Z\"}', '2021-10-27 07:49:34', '2021-10-26 14:35:41', '2021-10-27 07:49:34'),
('1244685e-e679-452d-b58b-12f53a3d5e25', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 26, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-29T15:02:28.763597Z\",\"type\":\"png\",\"filename\":\"1631026192898 (1)-2021-10-29.png\"}', NULL, '2021-10-29 13:02:28', '2021-10-29 13:02:28'),
('1b1c9491-3e33-451f-8fbb-7de071c49cd2', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 1, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-27T09:49:25.388818Z\"}', NULL, '2021-10-27 07:49:25', '2021-10-27 07:49:25'),
('1d8b943c-f90c-4eef-a2a5-e565d5c93159', 'App\\Notifications\\DemandesNotification', 'App\\User', 26, '{\"first_name\":\"zineb\",\"last_name\":null,\"type_demande\":null,\"notification_time\":\"2021-10-29 14:36:38\"}', '2021-10-29 12:52:58', '2021-10-29 12:36:38', '2021-10-29 12:52:58'),
('21d7c9cf-c631-4ef0-ba47-185793501a49', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 12, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-27T08:22:16.801989Z\",\"type\":\"png\",\"filename\":\"SENTIMENT-1024X576-2021-10-27.png\"}', '2021-10-28 08:53:45', '2021-10-27 06:22:16', '2021-10-28 08:53:45'),
('22305d5f-2102-4db9-854c-b8a517a534d8', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 24, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-28T08:53:16.251306Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-28.jpg\"}', NULL, '2021-10-28 06:53:16', '2021-10-28 06:53:16'),
('2bf2b725-8b91-4df5-8190-347176408dcf', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 26, '{\"typ\":\"postleave\",\"first\":\"zineb\",\"last\":\"zineb\",\"date\":\"2021-10-29T14:34:16.489840Z\"}', '2021-10-29 12:59:24', '2021-10-29 12:34:16', '2021-10-29 12:59:24'),
('2e2e97ca-d597-4448-acfc-daa1ca40b9f1', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 24, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-26T16:43:44.742081Z\"}', '2021-10-27 06:41:13', '2021-10-26 14:43:44', '2021-10-27 06:41:13'),
('354a8810-b246-46f5-855c-348793ff25e3', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 12, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-28T08:53:16.118045Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-28.jpg\"}', '2021-10-28 07:01:20', '2021-10-28 06:53:16', '2021-10-28 07:01:20'),
('3dd54319-b3f7-4c29-8316-b94e9490f19e', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Ziani\",\"last\":\"Zaynab\",\"date\":\"2021-10-28T09:11:39.600433Z\"}', NULL, '2021-10-28 07:11:39', '2021-10-28 07:11:39'),
('3f4cbb43-c358-4205-a110-3ecd31722bd4', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 1, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T12:53:29.879878Z\"}', NULL, '2021-10-25 10:53:29', '2021-10-25 10:53:29'),
('4049de87-ece7-41dd-bb62-d03b84414388', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Ziani\",\"last\":\"Zainab\",\"date\":\"2021-10-28T09:03:17.396005Z\"}', NULL, '2021-10-28 07:03:17', '2021-10-28 07:03:17'),
('44d35f48-6f6f-4fdd-8829-74d8a927fca1', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 27, '{\"typ\":\"newfile\",\"first\":\"najib\",\"last\":\"najib\",\"date\":\"2021-10-29T15:08:04.923629Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-29.jpg\"}', NULL, '2021-10-29 13:08:04', '2021-10-29 13:08:04'),
('45eb6e5a-430f-40ce-a87e-f75a91693b13', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T13:10:21.665229Z\"}', '2021-10-26 14:15:13', '2021-10-25 11:10:21', '2021-10-26 14:15:13'),
('486f32ae-ca41-4907-a94a-34e57d973033', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T13:14:01.399913Z\"}', '2021-10-26 14:15:07', '2021-10-25 11:14:01', '2021-10-26 14:15:07'),
('4ca5f8c5-1c66-4611-af46-70538ffe1f1b', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 24, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-28T08:51:20.564761Z\"}', NULL, '2021-10-28 06:51:20', '2021-10-28 06:51:20'),
('4f466336-b153-4b78-8c48-d5c42c61ddd8', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T12:53:29.995273Z\"}', '2021-10-26 14:15:12', '2021-10-25 10:53:29', '2021-10-26 14:15:12'),
('6655c7d5-fdb7-44cc-ba6a-6544cac06227', 'App\\Notifications\\DemandesNotification', 'App\\User', 26, '{\"first_name\":\"najib\",\"last_name\":null,\"type_demande\":null,\"notification_time\":\"2021-10-29 15:08:32\"}', NULL, '2021-10-29 13:08:32', '2021-10-29 13:08:32'),
('6845ca61-abd1-4dae-a19c-9e6142f81c4c', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 24, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-26T16:42:15.091004Z\"}', '2021-10-27 14:32:11', '2021-10-26 14:42:15', '2021-10-27 14:32:11'),
('6bea7789-10b1-41d0-86ec-a41dc3e64a58', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 28, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-29T15:00:15.229527Z\"}', '2021-10-29 13:04:51', '2021-10-29 13:00:15', '2021-10-29 13:04:51'),
('6c5fa0b9-750f-45a7-866e-bc92ed317db4', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T13:08:41.243834Z\"}', '2021-10-26 14:15:09', '2021-10-25 11:08:41', '2021-10-26 14:15:09'),
('75c8a12c-26ff-4205-8bee-2df3273466c4', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 29, '{\"typ\":\"newfile\",\"first\":\"najib\",\"last\":\"najib\",\"date\":\"2021-10-29T15:08:05.112505Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-29.jpg\"}', NULL, '2021-10-29 13:08:05', '2021-10-29 13:08:05'),
('78861926-31fe-4e02-8e7b-63a7d463f70c', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 29, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-29T15:02:29.031875Z\",\"type\":\"png\",\"filename\":\"1631026192898 (1)-2021-10-29.png\"}', NULL, '2021-10-29 13:02:29', '2021-10-29 13:02:29'),
('7defef66-1f42-4c50-9848-efe9d688c8e0', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 1, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T13:10:21.621876Z\"}', NULL, '2021-10-25 11:10:21', '2021-10-25 11:10:21'),
('8f142b1c-a4bd-4df2-8f8a-c12607591687', 'App\\Notifications\\DemandesNotification', 'App\\User', 26, '{\"first_name\":\"zineb1\",\"last_name\":\"zineb\",\"type_demande\":null,\"notification_time\":\"2021-10-29 15:15:43\"}', NULL, '2021-10-29 13:15:43', '2021-10-29 13:15:43'),
('9bbc1b74-dd45-42ac-b5f7-6f0d719ea609', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 28, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-29T15:00:00.228182Z\"}', NULL, '2021-10-29 13:00:00', '2021-10-29 13:00:00'),
('a1b81a0b-0ed9-443c-aade-ce5c66c1a3e7', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 22, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-28T08:53:16.192833Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-28.jpg\"}', '2021-10-28 07:00:16', '2021-10-28 06:53:16', '2021-10-28 07:00:16'),
('ac84eaf6-6a79-42f9-bae0-581328235f7f', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 25, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-28T08:53:16.340060Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-28.jpg\"}', NULL, '2021-10-28 06:53:16', '2021-10-28 06:53:16'),
('add5d804-6c6a-42fc-9f4e-f436ef427c9d', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 26, '{\"typ\":\"postleave\",\"first\":\"najib\",\"last\":\"najib\",\"date\":\"2021-10-29T15:09:11.996749Z\"}', NULL, '2021-10-29 13:09:11', '2021-10-29 13:09:11'),
('af75f63a-3ce0-4a6e-b625-4f25318af0eb', 'App\\Notifications\\StatusDemandesNotification', 'App\\User', 28, '{\"demande\":\"Demande d\'attestation de travail\",\"notification_time\":\"2021-10-29 14:59:20\"}', '2021-10-29 13:04:57', '2021-10-29 12:59:20', '2021-10-29 13:04:57'),
('bbe3a612-e430-4bbf-b970-299019ba6b9a', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 27, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-29T15:02:28.830904Z\",\"type\":\"png\",\"filename\":\"1631026192898 (1)-2021-10-29.png\"}', NULL, '2021-10-29 13:02:28', '2021-10-29 13:02:28'),
('bcd1b380-6c73-4dde-9952-a8e3e885bee1', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 28, '{\"typ\":\"postleave\",\"first\":\"zineb\",\"last\":\"zineb\",\"date\":\"2021-10-29T14:34:16.398514Z\"}', '2021-10-29 13:04:24', '2021-10-29 12:34:16', '2021-10-29 13:04:24'),
('c1166b68-e009-435d-b20f-d604c8a4fa72', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 22, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-27T09:49:25.496926Z\"}', '2021-10-28 06:51:07', '2021-10-27 07:49:25', '2021-10-28 06:51:07'),
('cae6bb2b-9c59-4e3c-a6b9-6d0331eca3da', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 28, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-29T15:02:28.887852Z\",\"type\":\"png\",\"filename\":\"1631026192898 (1)-2021-10-29.png\"}', NULL, '2021-10-29 13:02:28', '2021-10-29 13:02:28'),
('d7a669d4-b46c-4de0-a86b-8c6830426a69', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 1, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T13:08:41.191050Z\"}', NULL, '2021-10-25 11:08:41', '2021-10-25 11:08:41'),
('d9c0ea19-4338-4513-b884-296c4c94e5f9', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 1, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-28T08:53:16.040393Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-28.jpg\"}', NULL, '2021-10-28 06:53:16', '2021-10-28 06:53:16'),
('e1a4ddb9-4fc6-4d77-8f44-64e1fac03b5a', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 1, '{\"typ\":\"postleave\",\"first\":\"Raihane\",\"last\":\"Najib\",\"date\":\"2021-10-25T13:14:01.336109Z\"}', NULL, '2021-10-25 11:14:01', '2021-10-25 11:14:01'),
('e568848e-98bd-49c4-abb9-5bdbca7b00d7', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 22, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-27T08:22:16.878673Z\",\"type\":\"png\",\"filename\":\"SENTIMENT-1024X576-2021-10-27.png\"}', NULL, '2021-10-27 06:22:16', '2021-10-27 06:22:16'),
('efea0bc5-38f4-4906-82c8-82cb5c45181f', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 26, '{\"typ\":\"newfile\",\"first\":\"najib\",\"last\":\"najib\",\"date\":\"2021-10-29T15:08:04.857153Z\",\"type\":\"jpg\",\"filename\":\"BHARATHI-KANNAN-RFL-THIRZDS-UNSPLASH-2021-10-29.jpg\"}', NULL, '2021-10-29 13:08:04', '2021-10-29 13:08:04'),
('f2764448-8221-46c8-8e07-ee7a75bb9688', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 24, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-26T16:42:57.834714Z\"}', '2021-10-27 06:41:16', '2021-10-26 14:42:57', '2021-10-27 06:41:16'),
('f5b41da5-75ed-4525-8ec6-6df8f1f17489', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 24, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-27T08:22:17.200381Z\",\"type\":\"png\",\"filename\":\"SENTIMENT-1024X576-2021-10-27.png\"}', '2021-10-27 06:22:50', '2021-10-27 06:22:17', '2021-10-27 06:22:50'),
('fb3c6a42-bf72-4001-aa20-b83ea4c73f54', 'App\\Notifications\\PostLeaveNotification', 'App\\User', 1, '{\"typ\":\"postleave\",\"first\":\"Ziani\",\"last\":\"Zaynab\",\"date\":\"2021-10-28T09:11:39.559370Z\"}', NULL, '2021-10-28 07:11:39', '2021-10-28 07:11:39'),
('fb93672b-8728-46ad-baf7-40f2ddf881df', 'App\\Notifications\\NewDocumentPosted', 'App\\User', 1, '{\"typ\":\"newfile\",\"first\":\"Chouiekh\",\"last\":\"Houda\",\"date\":\"2021-10-27T08:22:16.208303Z\",\"type\":\"png\",\"filename\":\"SENTIMENT-1024X576-2021-10-27.png\"}', NULL, '2021-10-27 06:22:16', '2021-10-27 06:22:16'),
('fe73c6f9-ebdf-4285-af7f-ea04542be6cd', 'App\\Notifications\\responseLeaveNotification', 'App\\User', 24, '{\"typ\":\" responseLeave\",\"date\":\"2021-10-26T16:43:38.426122Z\"}', '2021-10-27 07:49:32', '2021-10-26 14:43:38', '2021-10-27 07:49:32');

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
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `role_name`) VALUES
(1, NULL, NULL, 'SuperAdmin'),
(2, NULL, NULL, 'Admin'),
(3, NULL, NULL, 'Supervisor'),
(4, NULL, NULL, 'Agent');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `created_at`, `updated_at`, `name`) VALUES
(13, '2021-10-29 13:00:50', '2021-10-29 13:00:50', 'fbtgbtgb'),
(14, '2021-10-29 13:06:26', '2021-10-29 13:06:26', ',l.hhhhh');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 4,
  `matricule` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solde` decimal(5,2) NOT NULL,
  `date_embauche` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `first_name`, `last_name`, `username`, `gender`, `image`, `service_id`, `deleted_at`, `role_id`, `matricule`, `solde`, `date_embauche`) VALUES
(26, 'hchouiekh@myopla.com', NULL, '$2y$10$b5uGCjIAv4FoOhcf49Lex.V6ffJM9mF3UPuX9fintTFefnzKI7qta', NULL, '2021-10-28 14:18:56', '2021-10-28 14:18:56', 'Houda', 'Chouiekh', 'superadmin', 'F', NULL, NULL, NULL, 1, 'MAH-000', '0.00', NULL),
(27, 'najib@gmail.com', NULL, '$2y$10$7BGl6.eSk9DYRaCKR3pW3uuO6LOCtGbCScnzLiJk/lMf27VuXsYvC', NULL, '2021-10-28 14:22:38', '2021-10-28 14:41:20', 'najib', 'najib', 'najib', 'F', NULL, 12, NULL, 2, 'MAH-001', '2.00', NULL),
(28, 'zineb@zineb.com', NULL, '$2y$10$dPf5IK9rqoPrtw7KQWA9F.fovWieLvXzOr9Sew6f2Q2h0HA2b8EW.', NULL, '2021-10-28 14:42:17', '2021-10-29 13:06:49', 'zineb1', 'zineb', 'zineb', 'F', NULL, 13, NULL, 3, 'MAH-002', '5.00', '2021-10-16'),
(29, 'agent@gmail.com', NULL, '$2y$10$QzWMlc/flkA5rQ0Lfj0Rv.QnhjZIoP8wpJ0kvje7vBG6QTDpmLDGa', NULL, '2021-10-28 14:46:11', '2021-10-28 14:46:11', 'agent', 'agent', 'agent', 'F', NULL, 12, NULL, 4, 'MAH-003', '6.00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_reservation`
--

CREATE TABLE `user_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_reservation`
--

INSERT INTO `user_reservation` (`id`, `created_at`, `updated_at`, `user_id`, `reservation_time`) VALUES
(23, '2021-10-29 12:39:57', '2021-10-29 12:39:57', 28, '2021-10-30 18:00:00'),
(24, '2021-10-29 13:01:23', '2021-10-29 13:01:23', 26, '2021-10-31 13:00:00'),
(25, '2021-10-29 13:08:13', '2021-10-29 13:08:13', 27, '2021-10-30 13:00:00'),
(26, '2021-10-29 13:08:19', '2021-10-29 13:08:19', 27, '2021-10-31 13:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidats`
--
ALTER TABLE `candidats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conges_user_id_foreign` (`user_id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demande_user`
--
ALTER TABLE `demande_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_service_id_foreign` (`service_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Index pour la table `user_reservation`
--
ALTER TABLE `user_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_reservation_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidats`
--
ALTER TABLE `candidats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `demande_user`
--
ALTER TABLE `demande_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `user_reservation`
--
ALTER TABLE `user_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_reservation`
--
ALTER TABLE `user_reservation`
  ADD CONSTRAINT `user_reservation_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
