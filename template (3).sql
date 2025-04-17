-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2025 at 04:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `template`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `informasi_tambahan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_finance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_finance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_in` date NOT NULL,
  `gambar_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `nama_client`, `nama_brand`, `informasi_tambahan`, `alamat`, `email`, `nama_finance`, `telepon_finance`, `status_client`, `pegawai_id`, `pj`, `date_in`, `gambar_client`, `created_at`, `updated_at`) VALUES
(1, 2, 'Adammmmm', 'ASDASD', 'zsdasd', 'Jl. Summarecon Bandung, Magna Commercial, Rancabolang', 'naturalparfum.marketlab@gmail.com', 'ASDASD', '08986915745', '3', '1', 'Insan', '2025-01-07', 'client_images/nqzbdDA3Qnxzc92GePyIEXRsfnJZeh1OAGSndNjX.png', '2025-01-07 03:14:09', '2025-01-14 01:26:54'),
(2, 4, 'asdasd', 'adam', 'SDCSDCSDC', 'SCC SDCDSCSDC', 'KUKU@GMAIL.COM', 'asdasd', '9327423', '1', '1', 'Insan', '2025-01-17', 'client_images/XFiQdvHP6lGLtOKyVxgPwvpz1LOY97Cv4aBFztGC.png', '2025-01-09 03:11:43', '2025-01-14 01:27:19'),
(3, 5, 'adam', 'asdasd', 'asdasdasd', 'Jl. Summarecon Bandung, Magna Commercial, Rancabolang', 'naturalparfum.markb@gmail.com', 'sdasd', '08986915745', '1', '1', 'Insan', '2025-01-15', NULL, '2025-01-14 01:26:36', '2025-01-14 01:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `client_layanan`
--

CREATE TABLE `client_layanan` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `layanan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_layanan`
--

INSERT INTO `client_layanan` (`id`, `client_id`, `layanan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `google_ads`
--

CREATE TABLE `google_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `performa_harian_id` bigint UNSIGNED NOT NULL,
  `search` decimal(15,2) DEFAULT NULL,
  `gtm` decimal(15,2) DEFAULT NULL,
  `youtube` decimal(15,2) DEFAULT NULL,
  `performance_max` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_ads`
--

INSERT INTO `google_ads` (`id`, `performa_harian_id`, `search`, `gtm`, `youtube`, `performance_max`, `created_at`, `updated_at`) VALUES
(1, 1, '1110.00', '110.00', '110.00', '110.00', '2025-01-09 21:40:08', '2025-01-10 00:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `layanans`
--

CREATE TABLE `layanans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanans`
--

INSERT INTO `layanans` (`id`, `nama_layanan`, `created_at`, `updated_at`) VALUES
(1, 'Market Booster', '2025-01-07 03:13:50', '2025-01-07 03:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint UNSIGNED NOT NULL,
  `performance_bulanan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` date NOT NULL,
  `leads` int NOT NULL,
  `chat` int NOT NULL,
  `chat_respon` int NOT NULL,
  `chat_no_respon` int NOT NULL,
  `closing` int NOT NULL,
  `revenue` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `performance_bulanan_id`, `hari`, `leads`, `chat`, `chat_respon`, `chat_no_respon`, `closing`, `revenue`, `created_at`, `updated_at`) VALUES
(17, '1', '2025-01-01', 10, 10, 10, 10, 10, 10, '2025-01-13 02:44:41', '2025-01-14 02:51:15'),
(18, '1', '2025-01-13', 10000, 0, 0, 0, 0, 0, '2025-01-13 02:55:29', '2025-01-13 02:55:29'),
(19, '1', '2025-01-13', 0, 0, 0, 0, 0, 0, '2025-01-13 03:05:08', '2025-01-13 03:05:08'),
(26, '1', '2025-01-14', 0, 0, 0, 0, 0, 0, '2025-01-13 23:38:17', '2025-01-13 23:38:17'),
(27, '1', '2025-01-15', 0, 0, 0, 0, 0, 0, '2025-01-13 23:42:48', '2025-01-13 23:42:48'),
(28, '1', '2025-01-14', 0, 0, 0, 0, 0, 0, '2025-01-13 23:45:34', '2025-01-13 23:45:34'),
(29, '1', '2025-01-14', 0, 0, 0, 0, 0, 0, '2025-01-13 23:48:53', '2025-01-13 23:48:53'),
(32, '1', '2025-01-14', 0, 0, 0, 0, 0, 0, '2025-01-14 00:13:18', '2025-01-14 00:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `meta_ads`
--

CREATE TABLE `meta_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `performa_harian_id` bigint UNSIGNED NOT NULL,
  `regular` decimal(15,2) DEFAULT NULL,
  `cpas` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_ads`
--

INSERT INTO `meta_ads` (`id`, `performa_harian_id`, `regular`, `cpas`, `created_at`, `updated_at`) VALUES
(1, 1, '11110.00', '0.00', '2025-01-09 21:40:08', '2025-01-09 21:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_10_030614_create_user_roles_table', 1),
(6, '2024_09_10_040239_create_layanans_table', 1),
(7, '2024_09_10_040340_create_clients_table', 1),
(8, '2024_09_10_040507_create_client_layanan_table', 1),
(9, '2024_09_11_074544_create_performance_bulanans_table', 1),
(10, '2024_09_11_081142_create_pegawais_table', 1),
(11, '2024_09_17_075023_create_performa_harians_table', 1),
(12, '2024_09_18_073219_create_meta_ads_table', 1),
(13, '2024_09_18_073230_create_google_ads_table', 1),
(14, '2024_09_18_073239_create_shopee_ads_table', 1),
(15, '2024_09_18_073248_create_tokped_ads_table', 1),
(16, '2024_09_18_073310_create_tiktok_ads_table', 1),
(17, '2025_01_06_084725_create_leads_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'dadang', '2025-01-07 03:13:50', '2025-01-07 03:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `performance_bulanans`
--

CREATE TABLE `performance_bulanans` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `target_spent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_revenue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_roas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performance_bulanans`
--

INSERT INTO `performance_bulanans` (`id`, `client_id`, `target_spent`, `target_revenue`, `target_roas`, `report_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, '1000000', '1000000', '1.00', '2025-01', 'qweqwdwqd', '2025-01-07 03:14:31', '2025-01-07 03:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `performa_harians`
--

CREATE TABLE `performa_harians` (
  `id` bigint UNSIGNED NOT NULL,
  `performance_bulanan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` date NOT NULL,
  `omzet` decimal(15,2) NOT NULL,
  `roas` decimal(5,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `performa_harians`
--

INSERT INTO `performa_harians` (`id`, `performance_bulanan_id`, `hari`, `omzet`, `roas`, `total`, `created_at`, `updated_at`) VALUES
(1, '1', '2025-01-10', '1000000.00', '72.62', '13770.00', '2025-01-09 21:40:08', '2025-01-10 00:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopee_ads`
--

CREATE TABLE `shopee_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `performa_harian_id` bigint UNSIGNED NOT NULL,
  `manual` decimal(15,2) DEFAULT NULL,
  `auto_meta` decimal(15,2) DEFAULT NULL,
  `gmv` decimal(15,2) DEFAULT NULL,
  `toko` decimal(15,2) DEFAULT NULL,
  `live` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopee_ads`
--

INSERT INTO `shopee_ads` (`id`, `performa_harian_id`, `manual`, `auto_meta`, `gmv`, `toko`, `live`, `created_at`, `updated_at`) VALUES
(1, 1, '10.00', '110.00', '110.00', '110.00', '110.00', '2025-01-09 21:40:08', '2025-01-10 00:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `tiktok_ads`
--

CREATE TABLE `tiktok_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `performa_harian_id` bigint UNSIGNED NOT NULL,
  `live_shopping` decimal(15,2) DEFAULT NULL,
  `product_shopping` decimal(15,2) DEFAULT NULL,
  `video_shopping` decimal(15,2) DEFAULT NULL,
  `gmv_max` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tiktok_ads`
--

INSERT INTO `tiktok_ads` (`id`, `performa_harian_id`, `live_shopping`, `product_shopping`, `video_shopping`, `gmv_max`, `created_at`, `updated_at`) VALUES
(1, 1, '110.00', '110.00', '110.00', '110.00', '2025-01-09 21:40:08', '2025-01-10 00:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `tokped_ads`
--

CREATE TABLE `tokped_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `performa_harian_id` bigint UNSIGNED NOT NULL,
  `manual` decimal(15,2) DEFAULT NULL,
  `auto_meta` decimal(15,2) DEFAULT NULL,
  `toko` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokped_ads`
--

INSERT INTO `tokped_ads` (`id`, `performa_harian_id`, `manual`, `auto_meta`, `toko`, `created_at`, `updated_at`) VALUES
(1, 1, '110.00', '110.00', '110.00', '2025-01-09 21:40:08', '2025-01-10 00:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `logo`, `user_role_id`, `phone`, `location`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alec Thompson', 'admin@corporateui.com', '2025-01-07 03:13:50', '$2y$10$acPLnt1c8V2d4NPMXDPXj.QEiFvB8IHMpC1aAiM8AejwCEw7/7B2.', 'client_images/gkaETl8WHogR51gHDsvSSbl872WAoVSbDYCKbCRc.png', 1, NULL, NULL, 'Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).', 'RDsiMXN7eyMuE9P9goSa3eWvJcJL4giPnMdtMcwWXkIsKon00YD9shnMjUjJ', '2025-01-07 03:13:50', '2025-01-28 01:06:30'),
(2, 'ASDASD', 'naturalparfum.marketlab@gmail.com', NULL, '$2y$10$8ygIhwbIO7QJfm7luMAD8./fKcHnzF3gm0ENi.yMNI5IkLVayc83i', 'client_images/nqzbdDA3Qnxzc92GePyIEXRsfnJZeh1OAGSndNjX.png', 6, NULL, NULL, NULL, NULL, '2025-01-07 03:14:10', '2025-01-15 20:37:05'),
(3, 'Alec Thom', 'lolo@gmail.com', NULL, '$2y$10$96iHuXn9KEIeRThdHeq.ouC2O1uOz.8WvI0YijvA5SF2K81Q8eUyO', NULL, 6, NULL, NULL, NULL, NULL, '2025-01-09 03:11:07', '2025-01-10 00:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-01-07 03:13:50', '2025-01-07 03:13:50'),
(2, 'C-Level', '2025-01-07 03:13:50', '2025-01-07 03:13:50'),
(3, 'Marketing', '2025-01-07 03:13:50', '2025-01-07 03:13:50'),
(4, 'Head', '2025-01-07 03:13:50', '2025-01-07 03:13:50'),
(5, 'PIC', '2025-01-07 03:13:50', '2025-01-07 03:13:50'),
(6, 'Client', '2025-01-07 03:13:50', '2025-01-07 03:13:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_layanan`
--
ALTER TABLE `client_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_layanan_client_id_foreign` (`client_id`),
  ADD KEY `client_layanan_layanan_id_foreign` (`layanan_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `google_ads`
--
ALTER TABLE `google_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `google_ads_performa_harian_id_foreign` (`performa_harian_id`);

--
-- Indexes for table `layanans`
--
ALTER TABLE `layanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_ads`
--
ALTER TABLE `meta_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_ads_performa_harian_id_foreign` (`performa_harian_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_bulanans`
--
ALTER TABLE `performance_bulanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performance_bulanans_client_id_foreign` (`client_id`);

--
-- Indexes for table `performa_harians`
--
ALTER TABLE `performa_harians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `shopee_ads`
--
ALTER TABLE `shopee_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopee_ads_performa_harian_id_foreign` (`performa_harian_id`);

--
-- Indexes for table `tiktok_ads`
--
ALTER TABLE `tiktok_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tiktok_ads_performa_harian_id_foreign` (`performa_harian_id`);

--
-- Indexes for table `tokped_ads`
--
ALTER TABLE `tokped_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokped_ads_performa_harian_id_foreign` (`performa_harian_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_layanan`
--
ALTER TABLE `client_layanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `google_ads`
--
ALTER TABLE `google_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layanans`
--
ALTER TABLE `layanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `meta_ads`
--
ALTER TABLE `meta_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `performance_bulanans`
--
ALTER TABLE `performance_bulanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `performa_harians`
--
ALTER TABLE `performa_harians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopee_ads`
--
ALTER TABLE `shopee_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tiktok_ads`
--
ALTER TABLE `tiktok_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokped_ads`
--
ALTER TABLE `tokped_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_layanan`
--
ALTER TABLE `client_layanan`
  ADD CONSTRAINT `client_layanan_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_layanan_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `layanans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `google_ads`
--
ALTER TABLE `google_ads`
  ADD CONSTRAINT `google_ads_performa_harian_id_foreign` FOREIGN KEY (`performa_harian_id`) REFERENCES `performa_harians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meta_ads`
--
ALTER TABLE `meta_ads`
  ADD CONSTRAINT `meta_ads_performa_harian_id_foreign` FOREIGN KEY (`performa_harian_id`) REFERENCES `performa_harians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `performance_bulanans`
--
ALTER TABLE `performance_bulanans`
  ADD CONSTRAINT `performance_bulanans_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shopee_ads`
--
ALTER TABLE `shopee_ads`
  ADD CONSTRAINT `shopee_ads_performa_harian_id_foreign` FOREIGN KEY (`performa_harian_id`) REFERENCES `performa_harians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tiktok_ads`
--
ALTER TABLE `tiktok_ads`
  ADD CONSTRAINT `tiktok_ads_performa_harian_id_foreign` FOREIGN KEY (`performa_harian_id`) REFERENCES `performa_harians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tokped_ads`
--
ALTER TABLE `tokped_ads`
  ADD CONSTRAINT `tokped_ads_performa_harian_id_foreign` FOREIGN KEY (`performa_harian_id`) REFERENCES `performa_harians` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
